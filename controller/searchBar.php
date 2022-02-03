<?php

//Création des variables pour affichage dans la vue
$searchResults = $patients->searchPatient($lastname, $firstname);
$countResults = $patients->countSearchedPatient($lastname, $firstname);