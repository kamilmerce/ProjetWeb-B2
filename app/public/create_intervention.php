<?php
require_once '../vendor/autoload.php';

use App\Page;

$page = new Page();
$user = $page->session->get('user'); 
$page->session->add('user', $user);
$error_message = '';


// Récupérer la liste des standardistes et des intervenants
$standardistes = $page->getAllStandardiste();
$intervenants = $page->getAllIntervenent();
$clients = $page->getAllCustomers();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier si les champs du formulaire sont définis
    if (isset($_POST['start_date']) && isset($_POST['client_id']) && isset($_POST['infos']) && isset($_POST['standardiste']) && isset($_POST['degre_urgence'])) {
        // Récupérer les données du formulaire
        $degre_urgence = $_POST['degre_urgence'];
        $standardiste = $_POST['standardiste'];
        $start_date = $_POST['start_date'];
        $client_id = $_POST['client_id']; // Assurez-vous que le champ client_id est bien nommé
        $infos = $_POST['infos'];

        // Insérer une nouvelle intervention dans la base de données
        $data = [
            'start_date' => $start_date,
            'client_id' => $client_id,
            'degre_urgence' => $degre_urgence,
            'standardiste_id' => $standardiste, // Assurez-vous que le champ standardiste est bien nommé
            'infos' => $infos
        ];

        // Insérer l'intervention et récupérer son ID
        $newInterventionId = $page->insertIntervention($data);
    
        // Insérer les relations intervenant-intervention pour chaque intervenant coché
        if (isset($_POST['intervenants'])) {
            $intervenants = $_POST['intervenants'];
            foreach ($intervenants as $intervenantId) {
                // Insérer une nouvelle ligne dans la table intervenant_intervention
                $page->insertIntervenantIntervention($intervenantId, $newInterventionId);
            }
        }

        if (isset($_POST['demande_id'])) {
            $demande_id = $_POST['demande_id'];
            $page->updateDemandeVerified($demande_id, false);
        }

       
        $error_message = "Intervention crée !";
    
        echo '<script>alert("Intervention crée !"); window.location.href = "profile.php";</script>';
        exit();
        
    }

    


}

// Afficher le formulaire de création d'intervention
echo $page->render('create_intervention.html.twig', [
    'user' => $user,
    'standardistes' => $standardistes,
    'intervenants' => $intervenants,
    'clients' => $clients,
    'error_message'=>$error_message

]);
?>
