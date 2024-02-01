<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if (isset($_POST['send'])){
        var_dump($_POST);

        $page->insert('users',[
            'surname'  => $_POST['surname'],
            'name'    => $_POST['name'],
            'email'     => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);
    }

    echo $page->render('register.html.twig', []);