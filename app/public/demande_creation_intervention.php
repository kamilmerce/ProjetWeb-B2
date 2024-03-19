<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);


// Get the intervention request data from the AJAX request
$infos = $_POST['infos'];
$start_date = $_POST['start_date'];
$degre_urgence = $_POST['degre_urgence'];
$standardiste_id=kkkk

// Save the intervention request to the database with a pending status
//$page->insertNewDemande($user['user_id'],$standardiste_id,$start_date,$infos,$degre_urgence);

// Select a random standardist from the database
// ...

// Send a notification to the selected standardist
// ...

// Return a JSON response to the AJAX request
//echo json_encode(['success' => true]);


echo $page->render('demande_intervention.html.twig',['user'=>$user]);