<?php

//Création des variables pour affichage dans la vue
$searchResults = $patients->searchPatient($lastname, $firstname);
$countResults = $patients->countSearchedPatient($lastname, $firstname);

//Création des variables pour affichage dans la vue
if(isset($_SESSION['lastName']) || isset($_SESSION['firstName'])){
    if(!isset($_GET['page'])){
        $searchResults = $patients->searchPatientByPage($lastname, $firstname, 1);
    } else {
        $searchResults = $patients->searchPatientByPage($lastname, $firstname, htmlspecialchars($_GET['page']));
    }
}
