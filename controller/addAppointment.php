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
if(isset($_GET['patientId'])){
    $patientId = $_GET['patientId'];
    $appointmentForm = $patients->displaySelectedAppointmentForm($patientId);
}

//Si la date et l'heure du rendez-vous sont validés
if(isset($_POST['dateHour'])){
    //récupération des données du $_POST
    $dateSubmited = $_POST['dateHour'];
    //Formatage en format DATE_TIME de mysql
    $dateToInsert = date("Y-m-d H:i:s",strtotime($dateSubmited));
    //Transformation de la string du $_GET en integer
    $intPatientId = (int) $_GET['patientId'];
    //Nouvelle instance de Appointments
    $appointments = new Appointments;
    //Utilisation de la méthode de la classe avec en paramètre la date et 
    //heure formatées ainsi que l'id correspondant au patient
    $appointments->addAppointment($dateToInsert, $intPatientId);
    exit;
}
