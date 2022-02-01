<?php

class Appointments {

    private $db;
    private $dateHour;



    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function addAppointment($idPatients) {
        $query = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:datehour, :idPatients)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':datehour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':idPatients', $idPatients, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function displayAppointmentsList() {
        $query = 'SELECT `patients`.`id` AS `patientId`, `firstname`, `lastname`, `phone`, `appointments`.`dateHour`, `appointments`.`id` AS `id` FROM `patients` INNER JOIN `appointments` ON `patients`.`id` = `appointments`.`idPatients` ORDER BY `appointments`.`dateHour`';
        $queryStatement = $this->db->query($query);
        $appointmentsList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $appointmentsList;
    }

    public function displayAppointment($appointmentId) {
        $query= 'SELECT `firstname`, `lastname`, `phone`, `appointments`.`dateHour`, `appointments`.`id` AS `id` FROM `patients` INNER JOIN `appointments` ON `patients`.`id` = `appointments`.`idPatients` WHERE `appointments`.`id` = :appointmentid ORDER BY `appointments`.`dateHour`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':appointmentid', $appointmentId, PDO::PARAM_INT);
        $queryStatement->execute();
        $patientProfileList = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $patientProfileList;
    }

    public function setDateHour($newDateHour): void{
        $this->dateHour = $newDateHour;
    }

    public function checkAppointmentIfExists()
    {   
        $query = 'SELECT COUNT(`appointments`.`id`) AS `number` FROM `appointments` LEFT JOIN `patients` ON `patients`.`id` = `appointments`.`idPatients` WHERE `appointments`.`dateHour` = :datehour';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':datehour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

}