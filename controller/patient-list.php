<?php
require 'modele/PatientsClass.php';
$patients = new Patients;
if(!isset($_GET['page'])){
    $patientsList = $patients->displayPagePatients(1);
} else {
    $patientsList = $patients->displayPagePatients(htmlspecialchars($_GET['page']));
}

if(isset($_POST['delete'])){
    $patients->setId(htmlspecialchars($_POST['delete']));
    $patients->deletePatient();
    header('Location: index.php?action=patientsList');
    exit;
}
