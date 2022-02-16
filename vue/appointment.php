<?php
require 'controller/appointment.php';
require 'controller/addAppointment.php';

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Profil patient</title>
</head>

<body>
    <a class="returnButton" href="index.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    <div class="flex-container">
        <h1>Rendez-vous séléctionné</h1>
    </div>
    <div class="appoContainer">
    <div class="profileContainer">
        <?php if (!empty($_POST['addAppointment'])) {
            unset($_POST['modify']);
            $_POST['undo'] = 'undo';
        }
        ?>
        <?php if (!isset($_POST['modify']) || isset($_POST['undo'])) {
            if (isset($_POST['modify'])) {
                unset($_POST['modify']);
            }
        ?>
            <form action="" method="post">
                <button class="modifyButton" type="submit" name="modify" value="modify">
                    <i class="fas fa-exchange-alt fa-2x"></i>
                </button>
            </form>
            <p class="firstParagraph">Date : <?= date("d/m/Y", strtotime($selectedAppointment->dateHour)) ?></p>
            <p>Heure : <?= date("H:i:s", strtotime($selectedAppointment->dateHour)) ?></p>
            <p>Nom : <?= $selectedAppointment->lastname ?></p>
            <p>Prénom : <?= $selectedAppointment->firstname ?></p>
            <p>Numéro de téléphone : <?= $selectedAppointment->phone ?></p>
        <?php
        } else {
            if (isset($_POST['undo'])) {
                unset($_POST['undo']);
            } ?>
            <form action="" method="post">
                <button class="modifyButton" type="submit" name="undo" value="undo">
                    <i class="fas fa-undo fa-2x"></i>
                </button>
            </form>
            <form id="appoForm" class="colContainer" method="post" action="">
                <input type="datetime-local" name="dateHour">
                <div>
                    <input class="confirm" type="submit" value="Confirmer" name="addAppointment">
                </div>
            </form>
        <?php } ?>
    </div>
    </div>
</body>

</html>