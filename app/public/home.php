<?php
session_start();

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = "connexion réussi";
    $user_email = $_SESSION['user_email'];





    
    echo $page->render('home.html.twig', [
        'msg' => $msg,
        'user_email' => $user_email  // Ajoutez cette ligne pour transmettre user_email au modèle Twig
    ]);
