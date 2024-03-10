<?php

    require_once '../vendor/autoload.php';

    use App\Page;

    $page = new Page();
    $user = $page->session->get('user');
    $page->session->add('user',$user);

    $interventions_completed = $page->getInterventionCompletedByClient($user['user_id']);
    echo $page->render('home_client_intervention_completed.html.twig',['user'=>$user,'interventions_completed'=>$interventions_completed]);