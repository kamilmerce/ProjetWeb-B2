<?php
    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $error_message = '';


    if(isset($_POST['send'])){
        $user = $page->getUserByEmail([
            'email'=> $_POST['email']
        ]);
        if (!$user){
        } else {
            if (!password_verify($_POST['password'], $user['password'])){
                $error_message = "Mot de passe ou email incorrect !";
                echo '<script>alert("Mot de passe ou email incorrect !"); window.location.href = "index.php";</script>';
            } else {
                $page->session->add('user',$user);
                header('Location: profile.php');

            }

        }
    }

    echo $page->render('index.html.twig',['error_message'=>$error_message]);

