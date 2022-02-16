<?php require 'controller/appointments-list.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/list.css">
    <title>Liste des rendez-vous</title>
</head>

<body>
        <a class="returnButton" href="index.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>

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
                <tr onclick="window.location='index.php?action=appointment&appointment=<?= $appointment->id ?>&patient=<?= $appointment->patientId ?>'">
                    <td><?= date("d/m/Y",strtotime($appointment->dateHour)) ?></td>
                    <td><?= date("H:i:s",strtotime($appointment->dateHour)) ?></td>
                    <td><?= $appointment->lastname ?></td>
                    <td><?= $appointment->firstname ?></td>
                    <td><?= $appointment->phone ?></td>
                    <form method="post" action="index.php?action=appointmentsList">
                    <td><input type="hidden" name="delete" value="<?= $appointment->id ?>">    
                    <button type="submit" id="deleteButton">-</button></td>    
                    </form>
                </tr>
                <?php }
                } ?>
            </tbody>
        </table>
    </div>
    <div class="buttonsContainer">
        <button onclick="window.location='index.php?action=addAppointment'">Ajouter rdv</button>
    </div>
</body>

</html>