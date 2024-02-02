<?php

    require_once '../vendor/autoload.php';

    use App\Page;
    
    $page = new Page();
    $msg = false;
    $user = null; 


    if(isset($_POST['send'])){
        var_dump($_POST);
        
        $page->getUserByEmail([
            'email'=> $_POST['email']
        ]);
        var_dump($user);
        $msg = "Envoi de mail avec un code de confirmation pour mettre à jour le mot de passe"
        if (!$user){
            $msg="Email introuvable !";
        } else {
            // On va vers la page de confirmation de code recu par mail et on cree un nouveau mot de passe

        }
    }

    echo $page->render('forgotpassword.html.twig', [
        'msg'=>$msg
    ]);