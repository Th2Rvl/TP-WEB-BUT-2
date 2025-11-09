<?php
try {
    /** Connexion a la base de données */
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

    /** Initialisation des variables */
    $css = "";
    $toutOk = true; /* True si tout les champs sont remplis de manière correcte */
    global $codeClient, $nomMagasin, $responsable, $adresse1, $adresse2, $cdp, $ville, $categorie, $noTel, $mail;
    if (isset($_POST['envoie'])) {
        $codeClient = isset($_POST['codeClient']) ? $_POST['codeClient'] : "";
        $nomMagasin = isset($_POST['nomMagasin']) ? $_POST['nomMagasin'] : "";
        $responsable = isset($_POST['responsable']) ? $_POST['responsable'] : "";
        $adresse1 = isset($_POST['adresse1']) ? $_POST['adresse1'] : "";
        $adresse2 = isset($_POST['adresse2']) ? $_POST['adresse2'] : "";
        $cdp = isset($_POST['cdp']) ? $_POST['cdp'] : "";
        $ville = isset($_POST['ville']) ? $_POST['ville'] : "";
        $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : "";
        $noTel = isset($_POST['noTel']) ? $_POST['noTel'] : "";
        $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
    }

    function insererClients() {
        global $toutOk, $pdo, $codeClient, $nomMagasin, $responsable, $adresse1, $adresse2, $cdp, $ville, $categorie, $noTel, $mail;
        if (isset($_POST['envoie']) && $toutOk == true) {
            $requetteInsertion = $pdo->prepare("SELECT insertionClient(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $requetteInsertion->execute([$codeClient, $nomMagasin, $responsable, $adresse1, $adresse2, $cdp, $ville, $categorie, $noTel, $mail]);
            echo "<h1 style='color: green;'>Client inséré avec succès !</h1>";
        } else {
            echo "<h1>Veuillez remplir tous les champs</h1>";
            $toutOk = false;
        }
    }
} catch (PDOException $e) {
    echo "<h1>Erreur interne</h1>";
}
?>
<!DOCTYPE html>
<html lang="fr">
	  <head>
		<meta charset="utf-8">
		<title>TP 5 SQL dans un langage de programmation PDO</title>
		
		<!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- Lien vers mon CSS -->
		<link href="TP5-PDO.css" rel="stylesheet">					
   </head>

	<body>
		<div class="container">
			<div class="col-12  cadre">
			<h1>Formulaire d'inscription</h1><br>
				<form method="post">
					<div class="form-row">
						<div class="form-group col-md-6">
                            <?php
                                if (isset($_POST['envoie'])) {
                                    if ($codeClient == "" || strlen($codeClient) > 15) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="codeClient">Code Client : </label>';
                            ?>
                            <input type="text" name="codeClient" placeholder="Code client (maximum 15 caractères)" class="form-control"
                                   value="<?php echo $codeClient; ?>"> <!-- Affichage de la saisie si le formulaire n'est pas envoyé pour éviter de retaper -->
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-12">
                            <?php
                                if (isset($_POST['envoie'])) {
                                    if ($nomMagasin == "" || strlen($nomMagasin) > 35) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="nomMagasin">Nom magasin : </label>';
                            ?>
							<input type="text" name="nomMagasin" placeholder="Nom du magasin (maximum 35 caractères)" class="form-control"
                                   value="<?php echo $nomMagasin; ?>"> <!-- value=" echo !$toutOk ? $nomMagasin : "";"> -->
						</div>
						<div class="form-group col-md-12">
                            <?php
                                if (isset($_POST['envoie'])) {
                                    if ($responsable == "" || strlen($responsable) > 35) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="responsable">Nom du Responsable : </label>';
                            ?>
							<input type="text" name="responsable" placeholder="Nom du responsable (maximum 35 caractères)" class="form-control"
                                   value="<?php echo $responsable; ?>">
						</div>
						<div class="form-group col-md-12">
							<?php
                                if (isset($_POST['envoie'])) {
                                    if ($adresse1 == "" || strlen($adresse1) > 35) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="adresse1">Adresse ligne 1 : </label>';
                            ?>
							<input type="text" name="adresse1" placeholder="Ligne d'adresse 1 (maximum 35 caractères)" class="form-control"
                                   value="<?php echo $adresse1; ?>">
						</div>
						<div class="form-group col-md-12">
							<?php
                                if (isset($_POST['envoie'])) {
                                    if ($adresse2 == "" || strlen($adresse2) > 35) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="adresse2">Adresse ligne 2 : </label>';
                            ?>
							<input type="text" name="adresse2" placeholder="Ligne d'adresse 2 (maximum 35 caractères)" class="form-control"
                                   value="<?php echo $adresse2; ?>">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-2">
                            <?php
                                if (isset($_POST['envoie'])) {
                                    if ($cdp == "" || !preg_match("/^(?:0[1-9]|[1-8]\d|9[0-8])\d{3}$/", $cdp)) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="cdp">Code postal : </label>';
                            ?>
						  <input type="text" name="cdp" placeholder="5 chiffres (Obligatoire)" class="form-control"
                                 value="<?php echo $cdp;?>">
						</div>
						<div class="form-group col-md-10">
							<?php
                                if (isset($_POST['envoie'])) {
                                    if ($ville == "" || strlen($ville) > 35) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label class="'. $css .'"for="ville">Ville : </label>';
                            ?>
							<input type="text" name="ville" placeholder="Taper votre bureau distributeur (maximum 35 caractères)" class="form-control"
                                   value="<?php echo $ville;?>">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-6">
                            <?php
                                if (isset($_POST['envoie']) && $categorie == "") {
                                    $css = "enRouge";
                                    $toutOk = false;
                                }
                                echo '<label class = "'. $css .'"for="categorie">Categorie : </label>';
                            ?>
							<select name="categorie"  class="form-control">
                                <?php
                                    try {
                                        $requetteCtype = $pdo->query("SELECT CODE_TYPE, DESIGNATION FROM c_types ORDER BY CODE_TYPE ASC");
                                        echo '<option disabled selected>Selectionner dans la liste</option>';
                                        while ($donnees = $requetteCtype->fetch()) {
                                            echo "<option value='" . $donnees['DESIGNATION'] . "'>" . $donnees['DESIGNATION'] . "</option>";
                                        }
                                    } catch (PDOException $e) {
                                        echo "<h1>Page inaccessible</h1>";
                                    }
                                ?>
							</select>
						</div>
						<div class="form-group col-md-3">
                            <?php
                                if (isset($_POST['envoie'])){
                                    if  ($noTel == "" || !preg_match("/^[0-9]{10}$/", $noTel)) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label for="noTel" class="'. $css .'">Numéro de téléphone : </label>';
                            ?>
						    <input type="text" name="noTel" placeholder="Format 0565656565" class="form-control"
                                   value="<?php echo $noTel;?>">
						</div>
						<div class="form-group col-md-3">
							<?php
                                if (isset($_POST['envoie'])) {
                                    if  ($mail == "" || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                                        $css = "enRouge";
                                        $toutOk = false;
                                    }
                                }
                                echo '<label for="mail" class="'. $css .'">Adresse Mail : </label>';
                            ?>
							<input type="text" name="mail" placeholder="Taper votre adresse E-mail" class="form-control"
                                   value="<?php echo $mail;?>">
						</div>
					</div>

					<button type="submit" class="btn btn-primary btn-block" name="envoie">Valider le formulaire</button>
                    <?php
                        if (isset($_POST['envoie'])) {
                            insererClients();
                        }
                    ?>
					<br>
				</form>
			</div>
		</div>
	</body>
</html>