<?php
require '../controller/patient-profile.php';
var_dump($appointmentsList);
var_dump(empty($appointmentsList));
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addPatient.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
    <title>Profil patient</title>
</head>

<body>
    <?php if ($checkIfIdExist) { ?>
        <a class="returnButton" href="patientsList.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
        <div class="flex-container">
            <h1>Profil patient</h1>
        </div>
        <div class="rowContainer">
            <div class="profileContainer">
                <?php if (!empty($_POST['addPatient'])) {
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
                    <p>Nom : <?= $patients->getLastname() ?></p>
                    <p>Prénom : <?= $patients->getFirstname() ?></p>
                    <p>Date de naissance : <?= $patients->getBirthdate() ?></p>
                    <p>Adresse e-mail : <?= $patients->getMail() ?></p>
                    <p>Numéro de téléphone : <?= $patients->getPhone() ?></p>
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
                    <form class="colContainer" method="post" action="">
                        <label for="lastname">Nom de famille</label>
                        <input placeholder="Dupont" type="text" name="lastname" value="<?= $patients->getLastname() ?>">
                        <p><?= isset($_POST['addPatient']) && isset($errorlist['lastname']) ? $errorlist['lastname'] : '' ?></p>
                        <label for="firstname">Prénom</label>
                        <input placeholder="Jean" type="text" name="firstname" value="<?= $patients->getFirstname() ?>">
                        <p><?= isset($_POST['addPatient']) && isset($errorlist['firstname']) ? $errorlist['firstname'] : '' ?></p>
                        <label for="birthdate">Date de naissance</label>
                        <input placeholder="02/03/1982" type="text" name="birthdate" value="<?= $patients->getBirthdate() ?>">
                        <p><?= isset($_POST['addPatient']) && isset($errorlist['birthdate']) ? $errorlist['birthdate'] : '' ?></p>
                        <label for="mail">E-mail</label>
                        <input placeholder="Dupont.jean@gmail.com" type="text" name="mail" value="<?= $patients->getMail() ?>">
                        <p><?= isset($_POST['addPatient']) && isset($errorlist['mail']) ? $errorlist['mail'] : '' ?></p>
                        <label for="phone">Téléphone</label>
                        <input placeholder="0645326735" type="text" name="phone" value="<?= $patients->getPhone() ?>">
                        <p><?= isset($_POST['addPatient']) && isset($errorlist['phone']) ? $errorlist['phone'] : '' ?></p>
                        <div>
                            <input class="confirm" type="submit" value="Confirmer" name="addPatient">
                        </div>
                    </form>
                <?php } ?>
            </div>
            <div class="profileContainer appointments">
            <?php if(count($appointmentsList) > 0) {?>
                <?php foreach ($appointmentsList as $appointment) {
                    ?>
                    <div class="appointmentContainer">
                        <p><?= $appointment->date ?></p>
                        <p><?= $appointment->hour ?></p>
                    </div>
                <?php }   ?>
                <?php } else { ?>
                    <div class="appointmentContainer">
                        <p>Pas de rendez-vous actuellement</p>
                        <?php } ?>
                    </div>    
            </div>
        </div>
    <?php } else { ?>
        <div id="errorContainer">
            <div class="innerContainer">
            <p id="errorText">Une erreur s'est produite, Veuillez contacter l'assistance pour plus d'informations</p>
            <a id="errorLink" href="patientsList.php">Retour à la liste des patients</a>
            </div>
        </div>
    <?php } ?>
</body>

</html>