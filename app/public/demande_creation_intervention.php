<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user');
$page->session->add('user', $user);
$error_message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les champs du formulaire sont définis
    if (isset($_POST['start_date']) && isset($_POST['infos']) && isset($_POST['degre_urgence'])) {
        // Récupérer les données du formulaire
        $degre_urgence = $_POST['degre_urgence'];
        $start_date = $_POST['start_date'];
        $client_id = $user['user_id'];
        $infos = $_POST['infos'];
        $standardiste=$page->getRandomStandardiste();

        $data = [
            'client_id' => $user['user_id'],
            'standardiste_id' => $standardiste['user_id'],
            'start_date' => $start_date,
            'infos' => $infos,
            'degre_urgence' => $degre_urgence
        ];
        $page->insertNewDemande($data);

        $error_message = "Demande envoyée !";
        echo '<script>alert("Demande envoyée !"); window.location.href = "profile.php";</script>';
        exit();
    } 


}

echo $page->render('demande_intervention.html.twig', ['user' => $user, 'error_message'=>$error_message
]);