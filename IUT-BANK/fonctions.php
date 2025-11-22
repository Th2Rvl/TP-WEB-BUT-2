<?php
    function verifUtilisateur($nom, $mdp) {
        try {
            $cheminFichier = "fichierDonnees/Logins.csv";
            if (!file_exists($cheminFichier)) {
                throw new Exception("Fichier :" . $cheminFichier . " non trouver");
            }
            $donnees = file($cheminFichier, FILE_IGNORE_NEW_LINES);
            $_SESSION['maSession'] = session_id();
            for ($i = 1; $i < count($donnees); $i++) {
                $ligne = explode(";", $donnees[$i]);
                $login = $ligne[0];
                $password = $ligne[1];
                if ($nom == $login && $mdp == $password) {
                    $_SESSION['identifiant'] = $nom;
                    $_SESSION['nomClient'] = $ligne[2];
                    return true;
                }
            }
            return false;
        } catch (Exception $e) {}
    }

    function verifierSession() {
        session_start();
        if (!isset($_SESSION['identifiant']) || $_SESSION['maSession'] != session_id()) {
            header('Location: ../index.php');
            exit();
        }
    }

//    function deconnecter() {
//        session_destroy();
//        header('Location: ../index.php');
//        exit();
//    }

?>