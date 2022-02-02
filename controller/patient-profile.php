<?php

require '../modele/PatientsClass.php';
require '../modele/Appointments.php';

require 'form-verif.php';

if (isset($_GET['patient'])) {
    $patients = new Patients;
    $patients->setId(htmlspecialchars($_GET['patient']));
    $checkIfIdExist = $patients->displayPatientProfile();
    $appointments = new Appointments;
    $appointments->setPatientId(htmlspecialchars($_GET['patient']));
    $appointmentsList = $appointments->selectPatientAppointments();
}
