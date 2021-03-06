<?php

$datetimeRegex = '/^(19||20)[0-9][0-9]-(0[0-9]||1[0-2])-(0[1-9]||[1-2][0-9]||3[0-1])T([0-1][0-9]||2[0-4]):[0-5][0-9]$/';

if(isset($_POST['patient'])){
    $_SESSION['patient'] = $_POST['patient'];
}

//Si la date et l'heure du rendez-vous sont validés
if(isset($_POST['addAppointment'])){
    $errorlist = [];
    if(isset($_POST['dateHour'])){
        if(preg_match($datetimeRegex, $_POST['dateHour'])){
            $appointmentDateHour = htmlspecialchars($_POST['dateHour']);
            $errorlist = [];
        } else {
            $errorlist['dateHour'] = 'Veuillez entrer une date et heure valides.';
        }
    } else {
        $errorlist['dateHour'] = 'Merci d\'entrer une date et une heure.';
    }

    if (count($errorlist) == 0) {
        $appointment = new Appointments;
        $appointment->setDateHour(date("Y-m-d H:i:s",strtotime(htmlspecialchars($appointmentDateHour))));
        $result = $appointment->checkAppointmentIfExists();
        if ($result->number == 0) {
            $appointment->setPatientId($_SESSION['patient']);
            $appointment->addAppointment();
            header('location: index.php?action=appointmentsList');
            exit;
        }else{
            $errorlist['addPatient'] = 'Ce patient existe déjà';
        }
    }
}
