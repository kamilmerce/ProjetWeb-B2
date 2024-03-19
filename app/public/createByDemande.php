<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);

// Récupérer la liste des standardistes et des intervenants
$standardistes = $page->getAllStandardiste();
$intervenants = $page->getAllIntervenent();
$clients = $page->getAllCustomers();

// Récupérer l'ID de la demande depuis les paramètres GET
$demande_id = $_POST['demande_id'] ?? null;
// Vérifier si l'ID de la demande est valide
if ($demande_id) {
    // Récupérer les informations de la demande
    $demande = $page->getDemandeById($demande_id);
    // Afficher le formulaire de création d'intervention avec les informations de la demande
    echo $page->render('createByDemande.html.twig', [
        'user' => $user,
        'standardistes' => $standardistes,
        'intervenants' => $intervenants,
        'clients' => $clients,
        'demande' => $demande
    ]);
} 

