<?php
    $donnees = array();
    try {
        /** Lecture des fichiers de données */
        $cheminFichier = "fichierDonnees/Logins.csv";
        if (!file_exists($cheminFichier)) {
            throw new Exception("Fichier :" . $cheminFichier . " non trouver");
        }
        $donnees = file($cheminFichier, FILE_IGNORE_NEW_LINES);
    } catch (Exception $e) {
        $erreurServeur = true;
    }
    function verifUtilisateur($nom, $mdp) {
        global $donnees;
        $_SESSION['maSession'] = session_id();
        for ($i = 1; $i < count($donnees); $i++) {
            $ligne = explode(";", $donnees[$i]);
            $login = $ligne[0];
            $password = $ligne[1];
            if ($nom == $login && $mdp == $password) {
                $_SESSION['identifiant'] = $nom;
                $_SESSION['motDePasse'] = $password;
                return true;
            }
        }
        return false;
    }
?>