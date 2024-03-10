<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);

$interventionId = $_GET['id'];

$intervention = $page->getInterventionsByID($interventionId);

$intervenants=  $page->getIntervenantByIntervention($interventionId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les champs du formulaire sont définis
    if (isset($_POST['status'])) {
        // Mettre à jour le statut et le degré d'urgence de l'intervention
        $status = $_POST['status'];
    }else {
        $status=$intervention['status_suivi'];
    }
    $page->updateStatusIntervention($interventionId, $status);
    if (isset($_POST['urgence'])){
        $urgence = $_POST['urgence'];
    
    }else{
        $urgence=$intervention['degre_urgence'];
    }
    $page->updateUrgenceIntervention($interventionId,$urgence);

    // Rediriger vers la page de détails de l'intervention mise à jour
    header('Location: profile.php');
    exit();
}

// Afficher la page d'édition de l'intervention
echo $page->render('edit_intervention.html.twig', [
    'user' => $user,
    'intervention' => $intervention,
    'intervenants' => $intervenants
]);
