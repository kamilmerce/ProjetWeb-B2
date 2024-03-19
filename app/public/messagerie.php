<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user');
$page->session->add('user', $user);

$demandes=$page->getDemandeByStandardiste($user['user_id']);

echo $page->render('messagerie.html.twig',['user'=>$user,'demandes'=>$demandes]);