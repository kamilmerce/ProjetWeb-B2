<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user');
$error_message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        // Récupérer le nom du fichier téléchargé et le chemin temporaire
        $file_name = $_FILES['profile_photo']['name'];
        $file_tmp = $_FILES['profile_photo']['tmp_name'];
        // Déplacer le fichier vers le dossier des images avec un nom unique
        $upload_dir = getcwd() . "/img/";
        $new_file_name = uniqid('profile_photo_') . '_' . $file_name;
        $i="/img/";
        $photo_chemin = $i . $new_file_name;
        $destination = $upload_dir . $new_file_name;
        if (move_uploaded_file($file_tmp, $destination)) {
            // Mettre à jour le chemin de la photo de profil dans la base de données
            $page->updateUserProfilePhoto($user['user_id'], $photo_chemin);
            header("Location: index.php");
        } else {
            // Gérer les erreurs lors du téléchargement du fichier
            $error_message = "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    }
    
    // Afficher la page avec le message d'erreur
    echo $page->render("myaccount.html.twig", ['user'=>$user,'error_message' => $error_message]);
    exit();
}
?>
