<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $error_message = '';


    if (isset($_POST['send'])) {
        if (isset($_POST['surname']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            $page->insert('users', [
                'surname' => $_POST['surname'],
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ]);


            $error_message = "Inscription réussie !";

            echo '<script>alert("Inscription réussie !"); window.location.href = "index.php";</script>';
            exit();
        }


    }
    
    echo $page->render('register.html.twig', ['error_message'=>$error_message ]);
