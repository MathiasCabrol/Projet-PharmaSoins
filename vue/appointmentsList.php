<?php require '../controller/appointments-list.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/list.css">
    <title>Liste des rendez-vous</title>
</head>

<body>
    <div class="flex-container">
        <h1>Liste des rendez-vous</h1>
    </div>
    <div class="tableContainer">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(count($appointmentsList) == 0){
                    ?>
                <tr>
                    <td colspan="5">Aucun rendez-vous ajouté</td>
                </tr>
                <?php
                } else {
                foreach ($appointmentsList as $appointment){
                    ?>
                <tr onclick="window.location='appointment.php?appointment=<?= $appointment->id ?>&patient=<?= $appointment->patientId ?>'">
                    <td><?= date("d/m/Y",strtotime($appointment->dateHour)) ?></td>
                    <td><?= date("H:i:s",strtotime($appointment->dateHour)) ?></td>
                    <td><?= $appointment->lastname ?></td>
                    <td><?= $appointment->firstname ?></td>
                    <td><?= $appointment->phone ?></td>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <div class="buttonsContainer">
        <a href="addAppointment.php"><button>Ajouter rdv</button></a>
    </div>
    <div class="menuContainer">
    <a href="index.php"><button class="menu">Menu principal</button></a>
    </div>
</body>

</html>