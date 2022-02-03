<?php

//Si la session est renseignée, la variable en prends la valeur, si la session est vide, 
//l'utilisateur a renseigné un seul champ donc la valeur est nulle.


if (!empty($_GET['lastName'])){
    $lastname = htmlspecialchars($_GET['lastName']);
} else {
    $lastname = null;
}
if (!empty($_GET['firstName'])){
    $firstname = htmlspecialchars($_GET['firstName']);
} else {
    $firstname = null;
}

require '../controller/searchBar.php';
