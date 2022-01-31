<?php

require '../modele/PatientsClass.php';

require 'form-verif.php';

$patients = new Patients;
$patientProfile = $patients->displayPatientProfile($_GET['patient']);

