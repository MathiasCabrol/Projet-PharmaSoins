<?php
if(!empty($_POST) && count($errorlist) == 0){



$db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');

$newPatientQuery = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `mail`, `phone`) VALUES (:lastname, :firstname, :birthdate, :email, :phone)';
$patientSending = $db->prepare($newPatientQuery);
$patientSending->bindParam(':lastname', $patientLastname);
$patientSending->bindParam(':firstname', $patientFirstname);
$patientSending->bindParam(':birthdate', $patientBirthdate);
$patientSending->bindParam(':email', $patientMail);
$patientSending->bindParam(':phone', $patientPhone);
$patientSending->execute();
$patientSending->errorInfo();
// header ('Location: patientsList.php');
//exit;
}
?>