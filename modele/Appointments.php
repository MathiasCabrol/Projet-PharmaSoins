<?php

class Appointments {

    private $dateHour;
    private $patientId;
    private $id;
    private $db;
    



    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function addAppointment() {
        $query = 'INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:datehour, :idPatients)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':datehour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->bindValue(':idPatients', $this->patientId, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function displayAppointmentsList():array {
        $query = 'SELECT `patients`.`id` AS `patientId`, `firstname`, `lastname`, `phone`, `appointments`.`dateHour`, `appointments`.`id` AS `id` FROM `patients` INNER JOIN `appointments` ON `patients`.`id` = `appointments`.`idPatients` ORDER BY `appointments`.`dateHour`';
        $queryStatement = $this->db->query($query);
        $appointmentsList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $appointmentsList;
    }

    public function selectPatientAppointments():array {
        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour` FROM `appointments` LEFT JOIN `patients` ON  `appointments`.`idPatients` = `patients`.`id` WHERE `patients`.`id` = :patientid ORDER BY `date`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':patientid', $this->patientId, PDO::PARAM_INT);
        $queryStatement->execute();
        $appointmentsList = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $appointmentsList;
    }

    public function displayAppointment():object {
        $query= 'SELECT `firstname`, `lastname`, `phone`, `appointments`.`dateHour`, `appointments`.`id` AS `id` FROM `patients` INNER JOIN `appointments` ON `patients`.`id` = `appointments`.`idPatients` WHERE `appointments`.`id` = :appointmentid ORDER BY `appointments`.`dateHour`';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':appointmentid', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $patientProfileList = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $patientProfileList;
    }

    public function checkAppointmentIfExists():object
    {   
        $query = 'SELECT COUNT(`appointments`.`id`) AS `number` FROM `appointments` LEFT JOIN `patients` ON `patients`.`id` = `appointments`.`idPatients` WHERE `appointments`.`dateHour` = :datehour';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':datehour', $this->dateHour, PDO::PARAM_STR);
        $queryStatement->execute();
        $result = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function deleteAppointment() {
        $query = 'DELETE FROM `appointments` WHERE `id` = :appointmentid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':appointmentid', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function setPatientId(int $value):void {
        $this->patientId = $value;
    }

    public function setId(int $value):void {
        $this->id = $value;
    }

    public function setDateHour($newDateHour): void{
        $this->dateHour = $newDateHour;
    }

}