<?php
    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();

    if(isset($_POST['send'])){

        $user = $page->getUserByEmail([
            'email'=> $_POST['email']
        ]);
        if (!$user){
        } else {
            if (!password_verify($_POST['password'], $user['password'])){
            } else {
                $page->session->add('user',$user);
                header('Location: profile.php');

            }

        }
    }

    echo $page->render('index.html.twig');

