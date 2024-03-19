<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    
    if ($type === 'client' || $type === 'intervenant') {
        $userInfo = ($type === 'client') ? $page->getUserByID($id) : $page->getUserByID($id);
        $interventionbyclient = $page->getInterventionsByClient($id);
        $interventionbyintervenant = $page->getInterventionsByIntervenantId($id);
        echo $page->render('viewmore.html.twig', [
            'user'=>$user,
            'interventionbyintervenant'=>$interventionbyintervenant,
            'interventionclient' => $interventionbyclient,
            'type' => $type,
            'userInfo' => $userInfo[0] 
        ]);
    } else if ($type === 'intervention'){
        $interventionInfo = ($type=='intervention')?$page->getInterventionsByID($id)  : false ;
        $commentaires = $page->getCommentByIntervention($id);
        echo $page->render('viewmore.html.twig', [
            'user'=>$user,
            'type'=>$type,
            'id'=>$id,
            'interventionInfo'=>$interventionInfo,
            'commentaires'=>$commentaires
        ]);
    } else if ($type === 'standardiste'){
        $userInfo = ($type=='standardiste')?$page->getUserByID($id)  : false ;
        $interventionbystandardiste = $page->getInterventionByStandardiste($id);

        echo $page->render('viewmore.html.twig', [
            'user'=>$user,
            'interventionbystandardiste'=>$interventionbystandardiste,
            'type'=>$type,
            'userInfo'=>$userInfo[0]
        ]);
    } 
} else {
    echo "Erreur: Type ou ID manquant.";
}
