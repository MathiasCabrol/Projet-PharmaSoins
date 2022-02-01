<?php require '../modele/Appointments.php';
$appointments = new Appointments;
$appointmentsList = $appointments->displayAppointmentsList();
