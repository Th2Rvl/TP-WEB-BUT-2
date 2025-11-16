<?php
    /** Vérification que l'utilisateur est bien connecté*/
    require_once("../fonctions.php");
    verifierSession();

    $nomClient = nomUtilisateur();

    if (isset($_POST['deconnexion'])) {
        deconnecter();
    }

    if (isset($_POST['detailCompte'])) {
        header('Location: Compte1.php');
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
                <h1>-- Bienvenue <?php echo $nomClient ?> --</h1>
                <h2>Vous pourrez grâce à cette interface voir le détail de vos comptes et faire toutes vos opérations à distance</h2>
            </div>
            <!--Compte 1-->
            <div class="row frame text">
                <div class="col-3">
                    <img src="../images/CompteCourant.jpg">
                </div>
                <div class="col-6">
                    <br><br><br>
                    <span class="text">Compte No 1234566789ABC - Type :<br> Compte courant.</span>
                    <br>
                    <button type="submit" class="btn btn-primary" name="detailCompte">
                        Détail du compte
                    </button>
                </div>
            </div>
            <!--Compte 2-->
            <div class="row frame text">
                <div class="col-3">
                    <img src="../images/LivretA.jpg">
                </div>
                <div class="col-6">
                    <br><br><br>
                    <span class="text">Compte No 48657894RR - Type : Livret A.</span>
                </div>
            </div>
            <!--Compte 3-->
            <div class="row frame text">
                <div class="col-3">
                    <img src="../images/LDD.jpg">
                </div>
                <div class="col-6">
                    <br><br><br>
                    <span class="text">Compte No 67345673TRV - Type : LDD.</span>
                </div>
            </div>

            <!--Contact-->
            <div class="row frame">
                <!--Bouton contact-->
                <div class="col-5">
                    <br>
                    <a href="../contact.html" class="btn btn-primary button">Nous contacter ඞ</a>
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