<?php
    /** Vérification que l'utilisateur est bien connecté*/
    session_start();
    if (!isset($_SESSION['identifiant']) || !isset($_SESSION['motDePasse']) || $_SESSION['maSession'] != session_id()) {
        header('Location: ../index.php');
        exit();
    }

    /** Récupération du nom du client */
    $nomClient = "";
    $loginPwd = file("../fichierDonnees/Logins.csv", FILE_IGNORE_NEW_LINES);
    for ($i = 1; $i < count($loginPwd); $i++) {
        $ligne = explode(";", $loginPwd[$i]);
        if ($ligne[0] == $_SESSION['identifiant']) {
            $nomClient = $ligne[2];
            break;
        }
    }

    /** Calcul du solde du compte */
    $soldePrecedent = 0;
    function calculeSolde($index) {
        global $soldePrecedent, $donnees;
        $ligne = explode(";", $donnees[$index]);
        $debit = $ligne[3] == "" ? 0 : $ligne[3];
        $credit = $ligne[4] == "" ? 0 : $ligne[4];
        $solde = $soldePrecedent - $debit + $credit;
        $soldePrecedent = $solde;
        return number_format($solde, 2);
    }
    $arret = false;

    /** Déconnexion de l'utilisateur */
    if (isset($_POST['deconnexion'])) {
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<form method="post">
    <div class="container">
        <!--Header-->
        <div class="row header">
            <div class = "col-6">
                <img src = "../images/Logo.jpg">
            </div>
            <div class = "col text">
                <h1>Ma Banque en ligne <br> IUT BANK ONLINE</h1>
            </div>
        </div>
        <!--Presentation-->
        <div class="row frame text">
            <h1>-- Bienvenue <?php echo $nomClient ?>  --</h1>
            <h2>Vous pourrez grâce à cette interface voir le détail de vos comptes et faire toutes vos opérations à distance</h2>
        </div>
        <!--Infos compte-->
        <div class="row frame text">
            <div class="col-3">
                <img src = "../images/CompteCourant.jpg">
            </div>
            <div class="col-9">
                <br><br><br>
                <h3 class = "text">Compte No 123456789ABC - Type : Compte courant</h3>
            </div>
        </div>
        <!--Tableau-->
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                    <tr>
                        <?php
                            try {
                                /** Lecture des fichiers de données */
                                $cheminFichier = "../fichierDonnees/Ecritures.csv";
                                $cheminTypeEcritures = "../fichierDonnees/TypeEcritures.csv";
                                if (!file_exists($cheminFichier)) {
                                    throw new Exception("Fichier :" . $cheminFichier . " non trouver");;
                                }
                                if (!file_exists($cheminTypeEcritures)) {
                                    throw new Exception("Fichier :" . $cheminTypeEcritures . " non trouver");;
                                }

                                $donneesTypeEcritures = file($cheminTypeEcritures, FILE_IGNORE_NEW_LINES);
                                $donnees = file($cheminFichier, FILE_IGNORE_NEW_LINES);
                                $ligne = explode(";", $donnees[0]);

                                $typeFiltre = isset($_POST['typeEcriture']) ? $_POST['typeEcriture'] : "";
                                $filtreDate = isset($_POST['filtreDate']) ? $_POST['filtreDate'] : "";

                                /** Affichage du titre des colonnes */
                                for ($i = 0; $i < count($ligne); $i++) {

                                    if ($i == 0) {
                                        echo "<th scope='col'>Date";
                                        echo "<br><input type='date' name='date'>";
                                        $selected = isset($_POST['filtreDate']) && $_POST['filtreDate'] == $filtreDate ? "selected" : "";
                                        echo "<button type='submit' class='btn btn-primary' name='filtreDate' $selected>Filtrer</button>";
                                        echo "</th>";
                                    } elseif ($i == 1) {
                                        echo "<th scope='col'>$ligne[$i]";
                                        echo "<br><select name='typeEcriture'>";
                                            echo "<option value='tous'>Tous</option>";

                                            /** Affichage de la liste déroulante */
                                            for ($j = 1; $j < count($donneesTypeEcritures); $j++) {
                                                $ligneTypeEcriture = explode(";", $donneesTypeEcritures[$j]);
                                                /** Récupération de type sélectionner dans la liste déroulante */
                                                $selected = isset($_POST['typeEcriture']) && $_POST['typeEcriture'] == $ligneTypeEcriture[0] ? "selected" : "";
                                                echo "<option value='$ligneTypeEcriture[0]' $selected>$ligneTypeEcriture[1]</option>";
                                            }
                                        echo "</select>";
                                        echo "<button type='submit' class='btn btn-primary' name='filter'>Filtrer</button>";
                                        echo "</th>";
                                    } else {
                                        echo "<th scope='col'>$ligne[$i]</th>";
                                        if ($i == 4 && $typeFiltre == 'tous') {
                                            echo "<th scope='col'>Solde</th>";
                                        }
                                    }
                                }
                            } catch (Exception $e) {
                                echo "<h1>Impossible d'accéder au détail du compte bancaire !</h1>";
                                $arret = true;
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <?php
                            if (!$arret) {
                                try {
                                    /** Affichage de du contenus des colonnes */
                                    for ($i = 1; $i < count($donnees); $i++) {
                                        $ligne = explode(";", $donnees[$i]);
                                        if ($typeFiltre != "" && $ligne[1] != $typeFiltre && $typeFiltre != "tous") {
                                            continue;
                                            /** Saute la ligne si le type de l'écriture ne correspond pas au filtre */
                                        }
                                        if ($filtreDate != "" && $ligne[0] != $filtreDate) {
                                            continue;
                                        }
                                        echo "<tr>";
                                        for ($j = 0; $j < count($ligne); $j++) {
                                            $classeCss1 = $j == 3 ? "texteRouge" : "";
                                            $classeCss2 = $j >= 4 ? "texteVert" : "";
                                            if ($j == 1) {
                                                /** Affichage du type complet */
                                                for ($k = 1; $k < count($donneesTypeEcritures); $k++) {
                                                    $ligneTypeEcriture = explode(";", $donneesTypeEcritures[$k]);
                                                    if ($ligne[$j] == $ligneTypeEcriture[0]) {
                                                        echo "<td><span class='$classeCss1 $classeCss2'>$ligneTypeEcriture[1]</span></td>";
                                                    }
                                                }
                                            } elseif ($j < 3) {
                                                echo "<td><span class='$classeCss1 $classeCss2'>$ligne[$j]</span></td>";
                                            } elseif ($j == 3 || $j == 4) {
                                                $nombre = $ligne[$j] == "" ? "" : number_format($ligne[$j], 2);
                                                echo "<td><span class='$classeCss1 $classeCss2'>$nombre</span></td>";
                                            }
                                        }

                                        /** Affichage du solde */
                                        if ($typeFiltre == 'tous') {
                                            $solde = calculeSolde($i);
                                            echo "<td><span class='" . ($solde < 0 ? 'texteRouge' : 'texteVert') . "'>$solde</span></td>";
                                            echo "</tr>";
                                        }

                                    }
                                } catch (Exception $e) {
                                    echo "";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!--Contact-->
        <div class="row frame">
            <!--Bouton contact-->
            <div class="col-2">
                <br>
                <a href="../contact.html" class="btn btn-primary button">Nous contacter </a>
            </div>
            <!--Bouton retour-->
            <div class="col-1"></div>
            <div class="col-2">
                <br>
                <a href="listeComptes.html" class="btn btn-primary">Retour à la liste des comptes</a>
            </div>
            <!--Bouton deconnexion-->
            <div class="col-1"></div>
            <div class="col-2">
                <br>
                <button type="submit" class="btn btn-danger button" name="deconnexion">
                    Déconnexion
                </button>
            </div>
            <!--Logo footer-->
            <div class="col-2"></div>
            <div class="col-2">
                <span class="text texteNoir">Réalisé par</span>
                <br>
                <img src = "../images/LogoIut.png" id ="logoIut">
            </div>
        </div>
    </div>
</form>
</body>
</html>