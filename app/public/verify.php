<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);

if (!isset($_GET['id'])) {
    echo "Erreur: ID de client manquant.";
    exit;
}

// Récupérez l'ID du nouveau client à partir de l'URL
$id = $_GET['id'];

// Récupérez les détails du nouveau client à partir de l'ID
$newCustomer = $page->getUserByID($id);

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez si les données du formulaire sont valides
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
        // Mettez à jour le rôle du nouveau client dans la base de données
        $success = $page->updateUserRole($id, $role);
        // Mettez à jour la colonne vérifiée dans la base de données
        if ($success) {
            $page->setUserVerified($id);
            header('Location: profile.php');
            exit;
        } else {
            // Affichez un message d'erreur si la mise à jour a échoué
            echo "Erreur lors de la mise à jour du rôle.";
        }
    }
}
// Rendre la page verify.html.twig avec les détails du nouveau client
echo $page->render('verify.html.twig', [
    'newCustomer' => $newCustomer[0]
]);