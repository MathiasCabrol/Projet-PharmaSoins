<?php require '../modele/Appointments.php';

$appointments = new Appointments;

$appointments->setId($_GET['appointment']);
$selectedAppointment = $appointments->displayAppointment();
