<?php
    try {
        session_start();
        require_once("fonctions.php");
        if (isset($_POST['connexion']) && (isset($_POST['identifiant']) && isset($_POST['motDePasse']))) {
            $identifiant = $_POST['identifiant'];
            $motDePasse = $_POST['motDePasse'];
        }

    } catch (PDOException $e) {
        echo "Page inaccessible";
    }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <form method="post">
        <div class="container">
            <!--Header-->
            <div class="row header">
                <div class = "col-6">
                    <img src = "images/Logo.jpg">
                </div>
                <div class = "col text">
                    <h1>Ma Banque en ligne <br> IUT BANK ONLINE</h1>
                </div>
            </div>
            <!--Presentation-->
            <div class="row frame text">
                <h1>-- Bienvenue sur le site de IUT BANK --</h1>
                <h2>Vous pourrez grâce à cette interface voir le détail de vos comptes et faire toutes vos opérations à distance</h2>
            </div>
            <!--Formulaire-->
            <div class="row frame text">
                <div class="col-6">
                    Identifiant :
                    <br>
                    <input class="form-control" type="text" placeholder="Tapez votre numéro de compte" name="identifiant">
                </div>
                <div class="col-6">
                    Mot de passe :
                    <br>
                    <input class="form-control" type="text" placeholder="Tapez votre mot de passe" name="motDePasse">
                </div>
                <button type="submit" name="connexion" class="btn btn-primary">
                    <a class="btn btn-primary">Me connecter</a>
                </button>
                    <?php
                        if (isset($_POST['connexion'])) {
                            if (isset($identifiant) && isset($motDePasse) && verifUtilisateur($identifiant, $motDePasse)) {
                                header('Location: comptes/Compte1.php');
                                exit();
                            }
                        }
                    ?>
            </div>
            <!--Contact-->
            <div class="row frame">
                <div class="col-2">
                    <br>
                    <a href="contact.html" class="btn btn-primary button">Nous contacter</a>
                </div>
                <div class="col-8"></div>
                <div class="col-2">
                    <span class="text texteNoir">Réalisé par</span>
                    <br>
                    <img src = "images/LogoIut.png" id ="logoIut">
                </div>
            </div>
        </div>
    </form>
</body>
</html>