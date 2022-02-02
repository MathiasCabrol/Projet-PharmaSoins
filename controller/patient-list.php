<?php
require '../modele/PatientsClass.php';
$patients = new Patients;
$patientsList = $patients->displayPatient();

if(isset($_POST['delete'])){
    $patients->setId(htmlspecialchars($_POST['delete']));
    $patients->deletePatient();
    header('Location: patientsList.php');
    exit;
}