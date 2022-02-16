<?php
if(!isset($_GET['action'])){
    require 'vue/homepage.php';
}

if(isset($_GET['action'])){   
    $fileName = $_GET['action']; 
    require 'vue/' . $fileName . '.php';
}


