<?php

$patient = $_GET['patient'];

try
{
	$db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$patientProfileQuery = 'SELECT `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `mail`, `phone` FROM `patients` WHERE `lastname` = :patient';
$clientProfile = $db->prepare($patientProfileQuery);
$clientProfile->bindParam('patient', $patient);
$clientProfile->execute();
$clientProfileInfos = $clientProfile->fetchAll(PDO::FETCH_OBJ);

?>