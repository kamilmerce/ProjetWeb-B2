<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);
$error_message = '';


$interventionId = $_GET['id'];

$intervention = $page->getInterventionsByID($interventionId);

$intervenants=  $page->getIntervenantByIntervention($interventionId);

$commentaires= $page->getCommentByIntervention($interventionId);



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
    if (isset($_POST['commentaire'])) {
        $commentaire = $_POST['commentaire'];
        $data = [
            'commentaire' => $commentaire,
            'intervention_id'=>$interventionId,
            'user_id'=>$user['user_id']
        ]; 
    }
    $page->addCommentaire($data);
    $error_message = "Demande envoyée !";
    echo '<script>alert("Intervention modifiée avec succés !"); window.location.href = "profile.php";</script>';
    exit();
}

// Afficher la page d'édition de l'intervention
echo $page->render('edit_intervention.html.twig', [
    'user' => $user,
    'intervention' => $intervention,
    'intervenants' => $intervenants,
    'commentaires'=>$commentaires,
    'error_message'=>$error_message
]);
