<?php
    require_once '../vendor/autoload.php';
    
    use App\Page;

    require_once '../vendor/swiftmailer/swiftmailer/lib/swift_required.php'; // Inclure les fichiers Swift Mailer

    $page = new Page();
    $msg = false;


    if(isset($_POST['send'])){
        var_dump($_POST);
        $user = $page->getUserByEmail([
            'email'=> $_POST['email']
        ]);
        
        var_dump($user);
        if (!$user){
            $msg="Email introuvable !";
        } 
        else {
            /*$msg = "Envoi de mail avec un code de confirmation pour mettre à jour le mot de passe";
            // On va vers la page de confirmation de code recu par mail et on cree un nouveau mot de passe 
            */
            $newPassword = $page->generateRandomPassword();

            $page->updateUserPassword($user['email'], $newPassword);

            // Envoyer un e-mail avec le nouveau mot de passe
        $smtpServer = 'smtp.gmail.com';
        $smtpPort = 587;
        $smtpUsername = 'kerchaouimaissa@gmail.com'; // Adresse e-mail utilisée pour l'envoi
        $smtpPassword = 'mAissa12'; // Mot de passe associé à votre adresse e-mail

        $to = $user['email'];
        $subject = 'Réinitialisation de votre mot de passe';
        $message = "Votre nouveau mot de passe est : $newPassword";
        
        $transport = (new Swift_SmtpTransport($smtpServer, $smtpPort))
            ->setUsername($smtpUsername)
            ->setPassword($smtpPassword);

        $mailer = new Swift_Mailer($transport);

        $email = (new Swift_Message($subject))
            ->setFrom([$smtpUsername => 'Maissa Kerchaoui'])
            ->setTo([$to])
            ->setBody($message);

        $result = $mailer->send($email);

        if ($result) {
            $msg = "Un nouveau mot de passe a été envoyé à votre adresse e-mail.";
        } else {
            $msg = "Erreur lors de l'envoi de l'email. Veuillez réessayer plus tard.";
        }
    }
}

echo $page->render('forgotpassword.html.twig', [
    'msg'=>$msg
]);