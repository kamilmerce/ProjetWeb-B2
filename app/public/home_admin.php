<?php

require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); // Récupérer l'utilisateur depuis la session

// Passer $link en tant que paramètre aux fonctions
function getAllCustomers($link){
    $sql ="SELECT name FROM users WHERE role='client' and verif='1'";
    $sth = $link->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(); 
}

function getAllInterventions($link){
    $sql ="SELECT id FROM interventions";
    $sth = $link->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(); 
}

function getAllIntervenent($link){
    $sql ="SELECT name FROM users WHERE role='intervenant'";
    $sth = $link->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(); 
}

function getAllNewCustormers($link){
    $sql ="SELECT name FROM users WHERE role='client' and verif='0'";
    $sth = $link->prepare($sql);
    $sth->execute();
    return $sth->fetchAll(); 
}

// Passer $page->link à chaque appel de fonction
$data = [
    "customers" => getAllCustomers($page->link),
    "interventions" => getAllInterventions($page->link),
    "intervenants" => getAllIntervenent($page->link),
    "new_customers" => getAllNewCustormers($page->link)
];

// Renvoyer les données encodées en JSON
echo json_encode($data);
