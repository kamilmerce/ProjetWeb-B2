<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); // Récupérer l'utilisateur depuis la session
$page->session->add('user', $user);

// Vérifier si les paramètres de requête existent
if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    
    // Vérifier si le type est valide
    if ($type === 'client' || $type === 'intervenant') {
        // Appeler la fonction correspondante pour récupérer les informations de l'utilisateur
        $userInfo = ($type === 'client') ? $page->getUserByID($id) : $page->getUserByID($id);

        // Vérifier si l'utilisateur existe
        if ($userInfo) {
            // Afficher les informations de l'utilisateur
            var_dump($userInfo);
            echo $page->render('viewmore.html.twig', [
                'type'=>$type,
                'userInfo'=>$userInfo
            ]);
        } else {
            // Afficher un message si l'utilisateur n'existe pas
            echo "Utilisateur introuvable.";
        }
    } else if ($type === 'intervention'){
        $interventionInfo = ($type=='intervention')?$page->getInterventionById($id)  : false ;

        var_dump($interventionInfo);
        echo $page->render('viewmore.html.twig', [
            'type'=>$type,
            'id'=>$id,
            'interventionInfo'=>$interventionInfo
        ]);
    } 
} else {
    // Afficher un message d'erreur si les paramètres de requête ne sont pas définis
    echo "Erreur: Type ou ID manquant.";
}
