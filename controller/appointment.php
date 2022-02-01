<?php require '../modele/Appointments.php';

$appointments = new Appointments;

$selectedAppointment = $appointments->displayAppointment($_GET['appointment']);
