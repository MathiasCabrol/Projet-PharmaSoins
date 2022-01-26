<?php

try
{
	$db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$ClientsListQuery = 'SELECT `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `mail`, `phone` FROM `patients`';
$ClientsTable = $db->query($ClientsListQuery);
$ClientsTableList = $ClientsTable->fetchAll(PDO::FETCH_OBJ);

?>