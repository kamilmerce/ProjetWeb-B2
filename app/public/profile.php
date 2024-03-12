<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();
    $user = $page->session->get('user');
    $page->session->add('user',$user);

    if ($user) {
        $role = $user['role'];
        switch ($role) {
            case 'client':
                $interventions_in_progress = $page->getInterventionInProgressByClient($user['user_id']);
                $allcommentaires = $page->getALLComment();
                echo $page->render('home_client.html.twig',['commentaires'=>$allcommentaires,'user'=>$user,'interventions_in_progress'=>$interventions_in_progress]);
            case 'intervenant':
                $interventions= $page->getInterventionsByIntervenantId($user['user_id']);
                echo $page->render('home_intervenant.html.twig',[
                    'user'=>$user,
                    'interventions'=>$interventions
                ]);
            case 'standardiste':
                $interventions=$page->getAllInterventions();
                echo $page->render('home_standardiste.html.twig',[
                    'user'=>$user,
                    'interventions'=>$interventions
                ]);
            case 'admin':
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $newCustomers = $page->getAllNewCustormers();
                $customers = $page->getAllCustomers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );

            default:
                // Cas par défaut : afficher une page d'accueil générique
                //echo $page->render('home_generic.html.twig');
                break;
        }
    } else {
        // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
        header('Location: index.php');
        exit(); // Arrêter l'exécution du script après la redirection
    }
    ?>

        
            