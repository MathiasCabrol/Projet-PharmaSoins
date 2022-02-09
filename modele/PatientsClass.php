<?php
class Patients
{
    private $id;
    private $lastname;
    private $firstname;
    private $birthdate;
    private $phone;
    private $mail;
    private $db;
    private $table = '`patients`';

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=hospitalE2N;charset=utf8', 'root', 'root');
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function formatDate (): void {
        $this->birthdate = DateTime::createFromFormat('d/m/Y', $this->birthdate);
        $this->birthdate = $this->birthdate->format('Y-m-d');
    }
    public function addPatient(): bool
    {   
        $query = 'INSERT INTO ' . $this->table
            . ' (`lastname`,`firstname`,`birthdate`,`phone`,`mail`) '
            . 'VALUES (:lastname, :firstname, :birthdate, :phone, :mail)';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        return $queryStatement->execute();
    }
    /**
     * Permet de savoir si un patient est unique
     *
     * @return boolean
     */
    public function checkPatientIfExists(): bool
    {   
        $check = false;
        $query = 'SELECT COUNT(`id`) AS `number` FROM ' . $this->table
            . ' WHERE `lastname` = :lastname AND `firstname` = :firstname AND `birthdate` = :birthdate';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->execute();
        // $number = $queryStatement->fetch(PDO::FETCH_OBJ)->number;
        $toto = $queryStatement->fetch(PDO::FETCH_OBJ);
        // number = 0 si il n'y a pas de patient identique
        // number = 1 si il y a un patient identique
        $number = $toto->number;
        if ($number) {
            $check = true;
        }
        return $check;
    }

    public function updatePatient(): bool {
        $query = 'UPDATE `patients` SET `lastname` = :lastname, `firstname` = :firstname, `birthdate` = :birthdate, `mail` = :mail, `phone` = :phone WHERE `id` = :previousid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
        $queryStatement->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $queryStatement->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryStatement->bindValue(':previousid', $this->id, PDO::PARAM_STR);
        return $queryStatement->execute();
    }

    public function displayPagePatients($page): array {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `mail`, `phone` FROM `patients` ORDER BY `lastname` LIMIT :number, 10';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':number', ($page - 1) * 10, PDO::PARAM_INT);
        $queryStatement->execute();
        $patientsByPage = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $patientsByPage;
    }

    public function displayPatientProfile():bool {
        $query= 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `mail`, `phone` FROM `patients` WHERE `id` = :patient';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':patient', $this->id, PDO::PARAM_INT);
        $queryStatement->execute();
        $patientProfileList = $queryStatement->fetch(PDO::FETCH_OBJ);
        if(is_object($patientProfileList)){
            $this->lastname = $patientProfileList->lastname;
            $this->firstname = $patientProfileList->firstname;
            $this->birthdate = $patientProfileList->birthdate;
            $this->mail = $patientProfileList->mail;
            $this->phone = $patientProfileList->phone;
            $check = true;
        } else {
            $check = false;
        }
        return $check;
    }

    public function searchPatient($lastName, $firstName): array {
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `mail`, `phone` FROM `patients` WHERE `lastname` lIKE CONCAT("%", :lastname, "%") OR `firstname` LIKE CONCAT("%", :firstname, "%")';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $queryStatement->execute();
        $searchResults = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $searchResults;
    }

    public function searchPatientByPage($lastName, $firstName, $page): array{
        $query = 'SELECT `id`, `lastname`, `firstname`, DATE_FORMAT(`birthdate`, "%d/%m/%Y") AS `birthdate`, `mail`, `phone` FROM `patients` WHERE `lastname` lIKE CONCAT("%", :lastname, "%") OR `firstname` LIKE CONCAT("%", :firstname, "%") ORDER BY `lastname` LIMIT :number, 10';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $queryStatement->bindValue(':number', ($page - 1) * 10, PDO::PARAM_INT);
        $queryStatement->execute();
        $searchResults = $queryStatement->fetchAll(PDO::FETCH_OBJ);
        return $searchResults;
    }

    public function countSearchedPatient($lastName, $firstName): object {
        $query = 'SELECT count(`id`) AS `results` FROM `patients` WHERE `lastname` lIKE CONCAT("%", :lastname, "%") OR `firstname` LIKE CONCAT("%", :firstname, "%")';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $queryStatement->execute();
        $countResults = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $countResults;
    }

    public function displaySelectedAppointmentForm(): array {
        $query = 'SELECT `lastname`, `firstname` FROM `patients` WHERE `id` = :patientId';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':patientId', $this->id, PDO::PARAM_STR);
        $queryStatement->execute();
        $patientSelected = $queryStatement->fetchAll(PDO::FETCH_OBJ); 
        return $patientSelected;
    }

    public function deletePatient(): bool {
        $query = 'DELETE FROM `patients` WHERE `patients`.`id` = :patientid';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':patientid', $this->id, PDO::PARAM_INT);
        return $queryStatement->execute();
    }

    public function countPages(): object {
        $query = 'SELECT COUNT(`id`)/10 AS `number` FROM `patients`';
        $queryStatement = $this->db->query($query);
        $numberOfPagesToRound = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $numberOfPagesToRound;
    }

    public function countPagesBySearch($lastName, $firstName): object {
        $query = 'SELECT COUNT(`id`)/10 AS `number` FROM `patients` WHERE `lastname` lIKE CONCAT("%", :lastname, "%") OR `firstname` LIKE CONCAT("%", :firstname, "%")';
        $queryStatement = $this->db->prepare($query);
        $queryStatement->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $queryStatement->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $queryStatement->execute();
        $pagesBySearch = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $pagesBySearch;
    }

    public function selectLastAddedPatientId(): object {
        $query = 'SELECT `id` FROM `patients` ORDER BY `id` DESC LIMIT 1';
        $queryStatement = $this->db->query($query);
        $lastPatientId = $queryStatement->fetch(PDO::FETCH_OBJ);
        return $lastPatientId;
    }

    public function setId (int $value):void {
        $this->id = $value;
    } 

    public function setLastname(string $value): void
    {
        $this->lastname = strtoupper($value);
    }

    public function setFirstname(string $value): void
    {
        $this->firstname = $value;
    }

    public function setBirthdate(string $value): void
    {
        $this->birthdate = $value;
    }

    public function setPhone(string $value): void
    {
        $value = str_replace([' ', '.', '-'], '', $value);
        $this->phone = $value;
    }

    public function setMail(string $value): void
    {
        $this->mail = $value;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function getBirthdate(): string {
        return $this->birthdate;
    }

    public function getMail(): string {
        return $this->mail;
    }

    public function getPhone():string {
        return $this->phone;
    }

    public function getId(): int {
        return $this->id;
    }
}
