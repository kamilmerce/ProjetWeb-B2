<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();
    $user = $page->session->get('user');
    $page->session->add('user',$user);

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

        var_dump($results);

        echo $page->render('resultsearch.html.twig',['results'=>$results, 'query' => $query, 'type' => $type]);

        
    }