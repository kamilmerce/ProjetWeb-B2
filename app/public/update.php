<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user');
$error_message = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier quel champ a été modifié et effectuer la mise à jour correspondante
    if (isset($_POST["user_firstname"])) {
        $newFirstName = $_POST["user_firstname"];
        $page->updateUserName($user['user_id'], $newFirstName);
        header("Location: index.php");
        exit();
    }
    if (isset($_POST["user_lastname"])) {
        $newLastName = $_POST["user_lastname"];
        $page->updateUserSurname($user['user_id'], $newLastName);
        header("Location: index.php");
        exit();
    }
    if (isset($_POST["user_email"])) {
        $newEmail = $_POST["user_email"];
        $page->updateUserEmail($user['user_id'], $newEmail);
        header("Location: index.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["old_password"]) && isset($_POST["new_password"])) {
        $oldPassword = $_POST["old_password"];
        $newPassword = $_POST["new_password"];
    
        // Vérifier si l'ancien mot de passe correspond au mot de passe actuel de l'utilisateur
        if (password_verify($oldPassword, $user['password'])) {
            // Hasher le nouveau mot de passe avant de le stocker
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $page->updatePassword($user['user_id'], $hashedPassword);
    
            header("Location: index.php");
            exit();
        } else {
            // Ancien mot de passe incorrect
            $error_message = "Ancien mot de passe incorrect.";

        }  
    }

    // Afficher la page avec le message d'erreur
    echo $page->render("myaccount.html.twig", ['user'=>$user,'error_message' => $error_message]);
    exit();

}
