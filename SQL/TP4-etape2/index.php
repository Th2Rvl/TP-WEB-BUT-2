<?php
    $host = "localhost";
    $db = "mezabi3";
    $user = "root";
    $password = "root";
    $charset = "utf8mb4";
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $option = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>TP4 SQL</title>

    <link href="../TP4/monStyle.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <h1>Etape 2</h1>
        <?php
        try {
            $pdo = new PDO($dsn, $user, $password, $option);
            $requette = $pdo->query("SELECT ID_CLIENT, CODE_CLIENT, NOM_MAGASIN, ADRESSE_1, ADRESSE_2, CODE_POSTAL, TELEPHONE, EMAIL FROM clients");
            while ($donnees = $requette->fetch()) {
                echo "<div class='cadre'>";
                echo "ID : " . $donnees['ID_CLIENT'];
                echo "<br>Code client : " . $donnees['CODE_CLIENT'];
                echo "<br>Nom magasin : " . $donnees['NOM_MAGASIN'];
                echo "<br>Adresse 1 : " . $donnees['ADRESSE_1'];
                echo "<br>Adresse 2 : " . $donnees['ADRESSE_2'];
                echo "<br>Code postal / Ville : " . $donnees['CODE_POSTAL'];
                echo "<br>Telephone : " . $donnees['TELEPHONE'];
                echo "<br>Email : " . $donnees['EMAIL'];
                echo "</div>";
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
        ?>
    </table>


</body>
</html>
