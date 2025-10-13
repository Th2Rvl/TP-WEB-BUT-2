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


        <?php
            $afficherFormulaire = true;
            $classeErreur = 'erreur';
            $classeStyle;
            $classeOk = 'ok';
            $nom = trim($_GET['nom'] ?? ''); // attribution d'une chaine vide si le champ est vide
            $prenom = trim($_GET['prenom'] ?? '');
            $diplome = trim($_GET['diplome'] ?? '');
            $question = trim($_GET['question'] ?? '');


            if ($afficherFormulaire && !isset($_GET['envoie'])) {
                echo '
                    <body>
                            <form method="get">
                                <div class="container">
                                    <h1 class="col-12">Formulaire</h1>
                                    <div class="row">
                                        <div class="col-4">
                                            Nom :
                                            <br><input type="text" class="saisie" name="nom"/>
                                        </div>
                                        <div class="col-4">
                                            Prénom :
                                            <br><input type="text" class="saisie" name="prenom"/>
                                        </div>
                                        <div class="col-4">
                                            Diplôme préparé :
                                            <select name="diplome">
                                                <option value="" disabled selected>Sélectionner dans la liste</option>
                                                <option>BUT GEA</option>
                                                <option>BUT Informatique</option>
                                                <option>BUT QLIO</option>
                                                <option>BUT CJ</option>
                                                <option>BUT InfoCom</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        Votre question :
                                        <br><textarea rows="4" cols="110" name="question"></textarea>
                                    </div>
                                    <button class="col-12" type="submit" name="envoie">
                                        <div class="bouton">Envoyer le formulaire</div>
                                    </button>
                                </div>
                            </form>
                    </body>
                ';
            }
            $texte;
            if (isset($_GET['envoie'])) {
                echo '
                    <div class="container">
                        <div class="row">
                            <div class="col-4 '. ($nom === '' ? 'erreur' : 'ok')      .'"> '. ($nom === '' ? 'Merci de rentrer votre nom' : 'Votre nom : ' .$nom) .'</div>
                            <div class="col-4 '. ($prenom === '' ? 'erreur' : 'ok')   .'"> '. ($prenom === '' ? 'Merci de rentrer votre prénom' : 'Votre prenom : ' .$prenom) .'</div>
                            <div class="col-4 '. ($diplome === '' ? 'erreur' : 'ok')  .'"> '. ($diplome === '' ? 'Merci de rentrer votre diplôme' : 'Votre diplôme : ' .$diplome) .'</div>
                            <div class="col-12 '.($question === '' ? 'erreur' : 'ok') .'"> '. ($question === '' ? 'Merci de rentrer votre question' : 'Votre question : ' .$question) .'</div>
                        </div>
                    </div>
                ';
            }
        ?>

</html>