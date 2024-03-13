<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();
    $user = $page->session->get('user');
    $page->session->add('user',$user);

    //Verifier si le formulaire de tri a ete envoye
   // Vérifier si le formulaire de tri a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["tri"])) {
        $tri = $_GET["tri"];
        switch ($tri) {
            case "id_intervention_asc":
                $interventions = $page->getInterventionAsc();
                $standardistes=$page->getAllStandardiste();
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
                break;
            case "id_intervention_desc":
                $interventions = $page->getInterventionDesc();
                $standardistes=$page->getAllStandardiste();
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
                break;
            case "id_client_asc":
                $customers = $page->getClientsAsc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $newCustomers = $page->getAllNewCustormers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "id_client_desc":
                $customers = $page->getClientsDesc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $newCustomers = $page->getAllNewCustormers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "name_client_asc":
                $customers = $page->getClientsNameAsc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $newCustomers = $page->getAllNewCustormers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "name_client_desc":
                $customers = $page->getClientNameDesc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $newCustomers = $page->getAllNewCustormers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "id_intervenant_asc":
                $intervenants = $page->getIntervenantAsc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
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
                break;
            case "id_intervenant_desc":
                $intervenants = $page->getIntervenantDesc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
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
                break;
            case "name_intervenant_asc":
                $intervenants = $page->getIntervenantNameAsc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
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
                break;
            case "name_intervenant_desc":
                $intervenants = $page->getIntervenantNameDesc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
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
                break;
            case "id_standardiste_asc":
                $standardistes = $page->getStandardisteAsc();
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
                break;
            case "id_standardiste_desc":
                $standardistes = $page->getStandardisteDesc();
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
                break;
            case "name_standardiste_asc":
                $standardistes = $page->getStandardisteNameAsc();
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
                break;
            case "name_standardiste_desc":
                $standardistes = $page->getStandardisteNameDesc();
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
                break;
            case "id_newclient_asc":
                $newCustomers = $page->getNewClientAsc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $customers = $page->getAllCustomers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "id_newclient_desc":
                $newCustomers = $page->getNewClientDesc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $customers = $page->getAllCustomers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "name_newclient_asc":
                $newCustomers = $page->getNewClientNameAsc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $customers = $page->getAllCustomers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            case "name_newclient_desc":
                $newCustomers = $page->getNewClientNameDesc();
                $standardistes=$page->getAllStandardiste();
                $interventions = $page->getAllInterventions();
                $intervenants = $page->getAllIntervenent();
                $customers = $page->getAllCustomers();
                echo $page->render('home_admin.html.twig', 
                    ['newCustomers'=>$newCustomers,
                    'user'=>$user,
                    'standardistes'=>$standardistes,
                    'interventions'=>$interventions,
                    'intervenants'=>$intervenants,
                    'customers'=>$customers]
                );
                break;
            default:
                break;
        }
    }


    // Vérifier si le formulaire de recherche a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["query"]) && isset($_GET["type"])) {
        // Récupérer les données du formulaire
        $query = $_GET["query"];
        $type = $_GET["type"];

        // Effectuer la recherche en fonction du type sélectionné
        switch ($type) {
            case 'intervention':
                // Effectuer la recherche dans la table des interventions
                $results = $page->searchInterventions($query);
                break;
            case 'client':
                // Effectuer la recherche dans la table des clients
                $results = $page->searchClients($query);
                break;
            case 'intervenant':
                // Effectuer la recherche dans la table des intervenants
                $results = $page->searchIntervenants($query);
                break;
            case 'standardiste':
                // Effectuer la recherche dans la table des standardistes
                $results = $page->searchStandardistes($query);
                break;
            default:
                break;
        }
        echo $page->render('resultsearch.html.twig',['user'=>$user,'results'=>$results, 'query' => $query, 'type' => $type]);

    }