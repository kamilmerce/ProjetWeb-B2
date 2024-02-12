<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();
    $user = $page->session->get('user'); // Récupérer l'utilisateur depuis la session
    // Vérifier le rôle de l'utilisateur
    if ($user) {
        $role = $user['role'];

        // Afficher une page d'accueil différente en fonction du rôle de l'utilisateur
        switch ($role) {
            case 'client':
                
                // Afficher la page d'accueil du client
                echo $page->render('home_client.html.twig');
                break;
            case 'intervenant':
                // Afficher la page d'accueil de l'intervenant
                //echo $page->render('home_intervenant.html.twig');
                break;
            case 'standardiste':
                // Afficher la page d'accueil du standardiste
                //echo $page->render('home_standardiste.html.twig');
                break;
            case 'admin':
                // Afficher la page d'accueil de l'administrateur
                //echo $page->render('home_admin.html.twig');
                break;
            default:
                // Cas par défaut : afficher une page d'accueil générique
                //echo $page->render('home_generic.html.twig');
                break;
        }
    } else {
        // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
        header('Location: login.php');
        exit(); // Arrêter l'exécution du script après la redirection
    }
    ?>

        
            