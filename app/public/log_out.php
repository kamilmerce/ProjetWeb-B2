<?php

    // Vérifier si la session est active
if(session_status() === PHP_SESSION_ACTIVE) {
    // Détruire toutes les données de la session
    session_unset();
    session_destroy();
}

// Rediriger l'utilisateur vers la page de connexion ou toute autre page souhaitée
header("Location: index.php");
exit();

