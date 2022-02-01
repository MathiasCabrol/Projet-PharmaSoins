<?php
require '../modele/PatientsClass.php';
require '../modele/Appointments.php';
$patients = new Patients;


//Si le formulaire est validé, insérer les informations dans la session
if(isset($_POST['searchFirstName'])){
    $_SESSION['searchFirstName'] = $_POST['searchFirstName'];
}
if(isset($_POST['searchLastName'])){
    $_SESSION['searchLastName'] = $_POST['searchLastName'];
}


//Si la session est renseignée, la variable en prends la valeur, si la session est vide, 
//l'utilisateur a renseigné un seul champ donc la valeur est nulle.


if (!empty($_SESSION['searchLastName'])){
    $lastname = $_SESSION['searchLastName'];
} else {
    $lastname = null;
}
if (!empty($_SESSION['searchFirstName'])){
    $firstname = $_SESSION['searchFirstName'];
} else {
    $firstname = null;
}

//Création des variables pour affichage dans la vue
$searchResults = $patients->searchPatient($lastname, $firstname);
$countResults = $patients->countSearchedPatient($lastname, $firstname);

//Si le bouton d'ajout de rendez-vous est cliquée, affiche les informations du patient
// En initialisant la variable patientId
if(isset($_GET['patient'])){
    $patientId = $_GET['patient'];
    $appointmentForm = $patients->displaySelectedAppointmentForm($patientId);
}

$datetimeRegex = '/^(19||20)[0-9][0-9]-(0[0-9]||1[0-2])-(0[1-9]||[1-2][0-9]||3[0-1])T([0-1][0-9]||2[0-4]):[0-5][0-9]$/';

//Si la date et l'heure du rendez-vous sont validés
if(isset($_POST['dateHour'])){
    $errorlist = [];
        if(preg_match($datetimeRegex, $_POST['dateHour'])){
            $appointmentDateHour = htmlspecialchars($_POST['dateHour']);
        } else {
            $errorlist['dateHour'] = 'Veuillez entrer une date et heure valides.';
        }
    } else {
        $errorlist['dateHour'] = 'Merci d\'entrer une date et une heure.';
    }

    

    if (count($errorlist) == 0) {
        $appointment = new Appointments;
        $appointment->setDateHour(date("Y-m-d H:i:s",strtotime(htmlspecialchars($appointmentDateHour))));
        $result = $appointment->checkAppointmentIfExists();
        if ($result->number == 0) {
            $appointment->addAppointment($_GET['patient']);
            exit;
        }else{
            $errorlist['addPatient'] = 'Ce patient existe déjà';
        }
    }

