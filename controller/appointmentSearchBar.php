<?php
require 'modele/PatientsClass.php';
require 'modele/Appointments.php';
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

require 'controller/searchBar.php';

//Si le bouton d'ajout de rendez-vous est cliquée, affiche les informations du patient
// En initialisant la variable patientId
if(isset($_POST['patient'])){
    $patients->setId($_POST['patient']);
    $appointmentForm = $patients->displaySelectedAppointmentForm();
}


