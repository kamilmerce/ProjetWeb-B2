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
                //header('Location: profile.php');
                break;
            case 'intervenant':
                // Afficher la page d'accueil de l'intervenant
                //header('Location: profile.php');
                break;
            case 'standardiste':
                // Afficher la page d'accueil du standardiste
                //header('Location: profile.php');
                break;
            case 'admin':
                // Afficher la page d'accueil de l'administrateur
                header('Location: home_admin.php');
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

        
            