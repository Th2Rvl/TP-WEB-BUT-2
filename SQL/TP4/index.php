<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>TP4 SQL</title>

    <link href="monStyle.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
    <h1>Etape 1</h1>
    <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Code Client</th>
            <th>Nom du magasin</th>
            <th>Adresse 1</th>
            <th>Adresse 2</th>
            <th>Code postal / Ville</th>
            <th>Téléphone</th>
            <th>Adresse Mail</th>
        </tr>
        <?php
        try {
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

            $pdo = new PDO($dsn, $user, $password, $option);
            $requette = $pdo->query("SELECT ID_CLIENT, CODE_CLIENT, NOM_MAGASIN, ADRESSE_1, ADRESSE_2, CODE_POSTAL, TELEPHONE, EMAIL FROM clients");
            while ($donnees = $requette->fetch()) {
                echo "<div class='row'>";
                    echo "<div class='col-12'>";
                        echo "<tr>";
                            echo "<td>" . $donnees['ID_CLIENT'] . "</td>";
                            echo "<td>" . $donnees['CODE_CLIENT'] . "</td>";
                            echo "<td>" . $donnees['NOM_MAGASIN'] . "</td>";
                            echo "<td>" . $donnees['ADRESSE_1'] . "</td>";
                            echo "<td>" . $donnees['ADRESSE_2'] . "</td>";
                            echo "<td>" . $donnees['CODE_POSTAL'] . "</td>";
                            echo "<td>" . $donnees['TELEPHONE'] . "</td>";
                            echo "<td>" . $donnees['EMAIL'] . "</td>";
                        echo "</tr>";
                    echo "</div>";
                echo "</div>";
            }
        } catch (PDOException $e) {
            echo 'Page inaccessible';
        }
        ?>
    </table>

        <h1>Etape 2</h1>
        <div class="row">
            <?php
            try {
                $pdo = new PDO($dsn, $user, $password, $option);
                $requette = $pdo->query("SELECT ID_CLIENT, CODE_CLIENT, NOM_MAGASIN, ADRESSE_1, ADRESSE_2, CODE_POSTAL, TELEPHONE, EMAIL FROM clients ORDER BY (ID_CLIENT = 4) DESC, ID_CLIENT ASC");
                while ($donnees = $requette->fetch()) {
                    echo "<div class='col-lg-4 col-sm-6 col-xs-12'>";
                    echo "<div class='cadre'>";
                    echo "<br>ID : " . $donnees['ID_CLIENT'];
                    echo "<br>Code client : " . $donnees['CODE_CLIENT'];
                    echo "<br>Nom magasin : " . $donnees['NOM_MAGASIN'];
                    echo "<br>Adresse 1 : " . $donnees['ADRESSE_1'];
                    echo "<br>Adresse 2 : " . $donnees['ADRESSE_2'];
                    echo "<br>Code postal / Ville : " . $donnees['CODE_POSTAL'];
                    echo "<br>Telephone : " . $donnees['TELEPHONE'];
                    echo "<br>Email : " . $donnees['EMAIL'];
                    echo "</div>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo 'Page inaccessible';
            }
            ?>
        </div>
    </div>
</body>
</html>