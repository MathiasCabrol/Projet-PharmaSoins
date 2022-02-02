<?php require '../modele/Appointments.php';
$appointments = new Appointments;
$appointmentsList = $appointments->displayAppointmentsList();

if(isset($_POST['delete'])) {
    $appointments->setId(htmlspecialchars($_POST['delete']));
    $appointments->deleteAppointment();
    header('location: appointmentsList.php');
    exit;
}
