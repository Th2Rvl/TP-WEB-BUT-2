<?php
$nbChamps = 0;

$nom = "";
if (isset($_POST["nom"])) {
    if (!empty($_POST["nom"])) {
        $nom = $_POST["nom"];
        $nbChamps += 1;
    }
}

$prenom = "";
if (isset($_POST["prenom"])) {
    if (!empty($_POST["prenom"])) {
        $prenom = $_POST["prenom"];
        $nbChamps += 1;
    }
}

$diplome = "";
if (isset($_POST["diplome"])) {
    if (!empty($_POST["diplome"])) {
        $diplome = $_POST["diplome"];
        $nbChamps += 1;
    }
}

$question = "";
if (isset($_POST["question"])) {
    if (!empty($_POST["question"])) {
        $question = $_POST["question"];
        $nbChamps += 1;
    }
}

$complet = ($nbChamps == 4);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Tp3.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
          crossorigin="anonymous">
    <title>Tp3 PHP</title>
</head>
<body>
<form method="post">
    <div class="container">
        <?php
        if (!$complet) {
            echo '<h1 class="col-12">Formulaire</h1>';
        }
        ?>

        <div class="row">
            <div class="col-4">
                <?php
                if (!$complet) {
                    echo '<span class="' .(empty($nom) ? 'erreur' : 'ok'). '">Nom : </span>
                                  <br><input type="text" class="saisie" name="nom" value="'. $nom .'"/>';
                } else {
                    echo '<p class="ok">Votre nom : ' . $nom . '</p>';
                }
                ?>
            </div>
            <div class="col-4">
                <?php
                if (!$complet) {
                    echo '<span class="' .(empty($prenom) ? 'erreur' : 'ok'). '">Prénom : </span>
                                  <br><input type="text" class="saisie" name="prenom" value="'. $prenom .'"/>';
                } else {
                    echo '<p class="ok">Votre prénom : ' . $prenom . '</p>';
                }
                ?>
            </div>
            <div class="col-4">
                <?php
                if (!$complet) {
                    echo '<span class="' .(empty($diplome) ? 'erreur' : 'ok'). '">Diplôme préparé : </span>
                                  <br><select name="diplome">
                                        <option value="" ' . ($diplome == "" ? "selected" : "") . '>Sélectionner dans la liste</option>
                                        <option value="BUT Informatique" ' . ($diplome == "BUT Informatique" ? "selected" : "") . '>BUT Informatique</option>
                                        <option value="BUT QLIO" ' . ($diplome == "BUT QLIO" ? "selected" : "") . '>BUT QLIO</option>
                                        <option value="BUT CJ" ' . ($diplome == "BUT CJ" ? "selected" : "") . '>BUT CJ</option>
                                        <option value="BUT InfoCom" ' . ($diplome == "BUT InfoCom" ? "selected" : "") . '>BUT InfoCom</option>
                                   </select>';
                } else {
                    echo '<p class="ok">Votre diplôme : ' . $diplome . '</p>';
                }
                ?>
            </div>
        </div>
        <div class="col-12">
            <?php
            if (!$complet) {
                echo '<span class="' .(empty($question) ? 'erreur' : 'ok'). '">Votre question : </span>
                              <br><textarea rows="4" cols="110" name="question">'. $question .'</textarea>';
            } else {
                echo '<p class="ok">Votre question : ' . $question . '</p>';
            }
            ?>
        </div>

        <?php
        if (!$complet) {
            echo '<button class="col-12" name="envoie">
                              <div class="bouton">Envoyer le formulaire</div>
                          </button>';
        }
        ?>
    </div>
</form>
</body>
</html>
