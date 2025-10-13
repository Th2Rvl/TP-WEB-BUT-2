<?php
require_once("tableauPhrases.php");
if (isset($_POST['envoie'])) {
    $contenu[1] = $_POST['var1'] ?? '';
    $contenu[2] = $_POST['var2'] ?? '';
    $contenu[3] = $_POST['var3'] ?? '';
    $contenu[4] = $_POST['var4'] ?? '';
    $contenu[5] = $_POST['var5'] ?? '';
    $contenu[6] = $_POST['var6'] ?? '';
    $contenu[7] = $_POST['var7'] ?? '';
    $contenu[8] = $_POST['var8'] ?? '';
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Les excuses du lundi matin</title>

    <link href="css/monStyle.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<form method="post">
    <div class="container-fluid">
        <div class="row cadre ">
            <div class="col-12">
                <?php
                if (!isset($_POST['envoie'])) {
                    echo '<h1>Tous les lundis, une excuse différente ! </h1>
                          Générez votre excuse du lundi matin en selectionnant les différents champs.<br/>';
                } else {
                    echo '<h1>Mon excuse :</h1><br>';
                    foreach ($contenu as $phrase) {
                        echo "$phrase" ." ";
                    }
                }
                ?>
            </div>
        </div>

        <div class="row cadre ">
            <div class="col-12">
                <?php
                foreach ($tabExGen as $index => $tableau) {
                    echo '<select name="var' . $index . '">';
                    foreach ($tableau as $phrase) {
                        echo "<option value='$phrase'>$phrase</option>";
                    }
                    echo '</select><br>';
                }

                ?>
                <br><button name="envoie">Générer l'excuse</button>
            </div>
        </div>
    </div>
</form>
</body>
</html>