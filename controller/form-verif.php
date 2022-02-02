<?php

/**
 * Création des REGEX pour les formulaires
 */

$nameRegex = '/^[A-ZÀ-ÖØ][A-Za-zÀ-ÖØ-öø-ÿ\-\']*$/';
$phoneRegex = '/^((([\+]([0-9])*[\.\-\s]?)[0-9]?)||(([0])[0-9]))([\.\-\s])?([0-9]{2}([\.\-\s])?){3}[0-9]{2}$/';
$birthdateRegex = '/^(([0-2][0-9])||([3][0-1]))[\/](([1][0-2])||([0][0-9]))[\/](([1][9][0-9][0-9])||([2][0](([0-1][0-9])||([2][0-1]))))$/';


//Création d'un tableau vide qui contiendra les erreurs du formulaire

if(isset($_POST['addPatient'])){
    $errorlist = [];

    //Condition de test saisie nom
    if(isset($_POST['lastname'])){
        if(preg_match($nameRegex, $_POST['lastname'])){
            $patientLastname = htmlspecialchars($_POST['lastname']);
        } else {
            $errorlist['lastname'] = 'Veuillez entrer un nom commençant par une majuscule.';
        }
    } else {
        $errorlist['lastname'] = 'Merci d\'entrer un nom de famille.';
    }

    //Condition de test saisie prénom
    if(isset($_POST['firstname'])){
        if(preg_match($nameRegex, $_POST['firstname'])){
            $patientFirstname = htmlspecialchars($_POST['firstname']);
        } else {
            $errorlist['firstname'] = 'Veuillez entrer un prénom commençant par une majuscule.';
        }
    } else {
        $errorlist['firstname'] = 'Merci d\'entrer un prénom.';
    }

    //Condition de test saisie date de naissance
    if(isset($_POST['birthdate'])){
        if(preg_match($birthdateRegex, $_POST['birthdate'])){
            $patientBirthdate = htmlspecialchars($_POST['birthdate']);
        } else {
            $errorlist['birthdate'] = 'Veuillez entrer une date de naissance avec un format valide.';
        }
    } else {
        $errorlist['birthdate'] = 'Merci d\'entrer une date de naissance.';
    }

    //Condition de test saisie adresse mail
    if(isset($_POST['mail'])){
        if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $patientMail = htmlspecialchars($_POST['mail']);
        } else {
            $errorlist['mail'] = 'Veuillez entrer une addresse mail avec un format valide.';
        }
    } else {
        $errorlist['mail'] = 'Merci d\'entrer une adresse mail.';
    }

    //Condition de test saisie numéro de téléphone
    if(isset($_POST['phone'])){
        if(preg_match($phoneRegex, $_POST['phone'])){
            $patientPhone = htmlspecialchars($_POST['phone']);
        } else {
            $errorlist['phone'] = 'Veuillez entrer un numéro de téléphone valide.';
        }
    } else {
        $errorlist['phone'] = 'Merci d\'entrer un numéro de téléphone.';
    }
    if (count($errorlist) == 0) {
        $patient = new Patients;
        $patient->setLastname(htmlspecialchars($patientLastname));
        $patient->setFirstname(htmlspecialchars($patientFirstname));
        $patient->setBirthdate(htmlspecialchars($patientBirthdate));
        $patient->setPhone(htmlspecialchars($patientPhone));
        $patient->setMail(htmlspecialchars($patientMail));
        $patient->formatDate();
        if (!$patient->checkPatientIfExists()) {
            if(!isset($_GET['patient'])){
                $patient->addPatient();
                header('location: patientsList.php');
            } else {
                $patient->setId(htmlspecialchars($_GET['patient']));
                $patient->updatePatient();
                header('location: patientProfile.php?patient=' . htmlspecialchars($_GET['patient']));
            }
            exit;
        }else{
            $errorlist['addPatient'] = 'Ce patient existe déjà';
        }
    }
}
 ?>   