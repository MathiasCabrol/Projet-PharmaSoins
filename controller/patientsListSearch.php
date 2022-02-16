<?php

//Si la session est renseignée, la variable en prends la valeur, si la session est vide, 
//l'utilisateur a renseigné un seul champ donc la valeur est nulle.

if (isset($_POST['cancel'])) {
    session_destroy();
    header('location: patientsList.php');
}

//Si le formulaire est validé, insérer les informations dans la session
if(isset($_GET['firstName'])){
    $_SESSION['firstName'] = htmlspecialchars($_GET['firstName']);
}
if(isset($_GET['lastName'])){
    $_SESSION['lastName'] = htmlspecialchars($_GET['lastName']);
}

//Si la session est renseignée, la variable en prends la valeur, si la session est vide, 
//l'utilisateur a renseigné un seul champ donc la valeur est nulle.


if (!empty($_SESSION['lastName'])){
    $lastname = $_SESSION['lastName'];
} else {
    $lastname = null;
}
if (!empty($_SESSION['firstName'])){
    $firstname = $_SESSION['firstName'];
} else {
    $firstname = null;
}


if (!isset($_SESSION['firstName']) || !isset($_SESSION['lastName'])) {
    $patientsPages = $patients->countPages();
} else {
    $patientsPages = $patients->countPagesBySearch($lastname, $firstname);
}

require 'controller/searchBar.php';
