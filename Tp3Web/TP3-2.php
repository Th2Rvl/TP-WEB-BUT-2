<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="Tp3.css" />
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
                      rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
                      crossorigin="anonymous">
		<title>Tp3 web</title>
	</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <?php
                        if(isset($_GET['nom']) && $_GET['nom'] != '') {
                            echo '<span class="ok">Votre nom : ' .$_GET['nom'] .'</span>';
                        } else {
                            echo '<span class="erreur">Merci de rentrer votre nom</span>';
                        }
                    ?>
                </div>
                <div class="col-4">
                    <?php
                        if(isset($_GET['prenom']) && $_GET['prenom'] != '') {
                            echo '<span class="ok">Votre prénom : ' .$_GET['prenom'] .'</span>';
                        } else {
                            echo '<span class="erreur">Merci de rentrer votre prénom</span>';
                        }
                    ?>
                </div>
                <div class="col-4">
                    <?php
                        if(isset($_GET['diplome'])) {
                            echo '<span class="ok">Votre diplôme : ' .$_GET['diplome'] .'</span>';;
                        } else {
                            echo '<span class="erreur">Merci de rentrer votre diplôme</span>';
                        }
                    ?>
                </div>
                <div class="col-12">
                    <?php
                        if(isset($_GET['question']) && $_GET['question'] != '') {
                            echo '<span class="ok">Votre question : ' .$_GET['question'] .'</span>';;
                        } else {
                            echo '<span class="erreur">Merci de rentrer votre question</span>';
                        }
                    ?>
                </div>
            </div>
        </div>
    <body>
</html>