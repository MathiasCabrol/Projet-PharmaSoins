<?php

//Si le formualaire est soumis et que le controller ne reconnait aucune erreur de saisie.
if(!empty($_POST['addPatient']) && count($errorlist) == 0){

    try
    {
        $db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

/**
 * Formatage de la date récoltée dans l'input text du formulaire
 */
$patientBirthdate = DateTime::createFromFormat('d/m/Y', $patientBirthdate);
$patientBirthdate = $patientBirthdate->format('Y-m-d');

//Requête SQL
$updatePatientQuery = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `mail` = :mail, `phone` = :phone WHERE `lastname` = :previousname';
$patientUpdating = $db->prepare($updatePatientQuery);
$exec = $patientUpdating->execute(array('lastname'=>$patientLastname,'firstname'=>$patientFirstname,'birthdate'=>$patientBirthdate,'mail'=>$patientMail,'phone'=>$patientPhone,'previousname'=>$_GET['patient']));

$newUrl = 'patientProfile.php?patient=' . $patientLastname;
// Redirection sur la page de liste patients et fin de script
if($exec){
    echo 'Insertion complétée';
    header('Location: ' . $newUrl);
} else {
    echo 'Insertion non complétée';
}

}

?>