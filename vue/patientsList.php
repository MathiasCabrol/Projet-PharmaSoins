<?php include '../modele/PatientsClass.php';
    $patients = new Patients;
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/patientsList.css">
    <title>Liste de patients</title>
</head>

<body>
    <div class="flex-container">
        <h1>Liste des patients</h1>
    </div>
    <div class="tableContainer">
        <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>E-mail</th>
                    <th>Téléphone</th>
                </tr>
                <?php 
                if(count($patients->displayPatient()) == 0){
                    ?>
                <tr>
                    <td colspan="5">Aucun client renseigné</td>
                </tr>
                <?php
                } else {
                foreach ($patients->displayPatient() as $client){
                    ?>
                <tr onclick="window.location='patientProfile.php?patient=<?= $client->lastname ?>'">
                    <td><?= $client->lastname ?></td>
                    <td><?= $client->firstname ?></td>
                    <td><?= $client->birthdate ?></td>
                    <td><?= $client->mail ?></td>
                    <td><?= $client->phone ?></td>
                </tr>
                <?php }
                } ?>
        </table>
    </div>
    <div class="buttonsContainer">
        <a href="addPatient.php"><button>Ajouter patient</button></a>
    </div>
    <div class="menuContainer">
    <a href="index.php"><button class="menu">Menu principal</button></a>
    </div>
</body>

</html>