<?php
require '../modele/PatientsClass.php';
$patients = new Patients;
$patientsList = $patients->displayPatient();