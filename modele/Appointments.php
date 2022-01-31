<?php

class Appointments {

    private $id;
    private $lastname;
    private $firstname;
    private $db;



    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function addAppointment($dateHour, $idPatients) {
        $query = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:datehour, :idPatients)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':datehour', $dateHour);
        $queryStatement->bindValue(':idPatients', $idPatients);
        return $queryStatement->execute();
    }
}