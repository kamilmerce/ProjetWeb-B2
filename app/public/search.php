<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();
    $user = $page->session->get('user');
    $page->session->add('user',$user);

    //Verifier si le formulaire de tri a ete envoye
    if ($_SERVER["REQUEST_METHOD"]== "GET" && isset($_GET["tri"])){
        $tri = $_GET["tri"];
        switch($tri){
            case "id_intervention_asc": 
                $trier=$page->getInterventionAsc();
                break;
            case "id_intervention_desc":
                $trier=$page->getInterventionDesc();
                break;
            case "id_client_asc":
                $trier= $page->getClientsAsc();
                break;
            case "id_client_desc":
                $trier=$page->getClientsDesc();
                break;
            case "name_client_asc":
                $trier=$page->getClientsNameAsc();
                break;
            case "name_client_desc":
                $trier=$page->getClientNameDesc();
                break;
            case "id_intervenant_asc":
                $trier=$page->getIntervenantAsc();
                break;
            case "id_intervenant_desc":
                $trier=$page->getIntervenantDesc();
                break;
            case "name_intervenant_asc":
                $trier=$page->getIntervenantNameAsc();
                break;
            case "name_intervenant_desc":
                $trier=$page->getIntervenantNameDesc();
            case "id_standardiste_asc":
                $trier=$page->getStandardisteAsc();
                break;
            case "id_standardiste_desc":
                $trier=$page->getStandardisteDesc();
                break;
            case "name_standardiste_asc":
                $trier=$page->getStandardisteNameAsc();
                break;
            case "name_standardiste_desc":
                $trier=$page->getStandardisteNameDesc();
                break;
            case "id_newclient_asc":
                $trier=$page->getNewClientAsc();
                break;
            case "id_newclient_desc":
                $trier=$page->getNewClientDesc();
                break;
            case "name_newclient_asc":
                $trier=$page->getNewClientNameAsc();
                break;
            case "name_newclient_desc":
                $trier=$page->getNewClientNameDesc();
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