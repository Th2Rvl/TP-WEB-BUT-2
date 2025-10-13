<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Tp2 web</title>
	</head>
	<body>
        <?php
            // Exercice 1
            $laChaine = 'Bonjour tout le monde';
            $chaineCouleur = 'Une lettre sur deux en rouge';
            echo $laChaine . '<br>'; 

            // Exercice 2
            for($i=strlen($laChaine) - 1; $i >= 0 ; $i--) {
                echo mb_substr($laChaine, $i, 1);
            }
            echo '<br>';

            // Exercice 3
            for($i=0; $i < strlen($chaineCouleur); $i++) {
                if($i % 2 == 0) {
                    echo '<span style="color:red">' . mb_substr($chaineCouleur, $i, 1) . '</span>';
                } else {
                    echo mb_substr($chaineCouleur, $i, 1);
                }
            }

            // Exercice 4

        ?>
    </body>
</html>
