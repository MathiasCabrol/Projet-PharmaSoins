<?php 
 require '../controller/patient-profile.php';

 var_dump($patientProfile);
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
    <link rel="stylesheet" href="../assets/css/patientProfile.css">
    <title>Document</title>
</head>

<body>
    <a class="returnButton" href="patientsList.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    <div class="flex-container">
        <h1>Profil patient</h1>
    </div>
    <div class="patientContainer">
        <?php if(!empty($_POST['addPatient'])){
            unset($_POST['modify']);
            $_POST['undo'] = 'undo';
        }
        ?>
        <?php if(!isset($_POST['modify']) || isset($_POST['undo'])){
                if(isset($_POST['modify'])){
                    unset($_POST['modify']);
                }
            ?>
        <form action="" method="post">
            <button class="modifyButton" type="submit" name="modify" value="modify">
                <i class="fas fa-exchange-alt fa-2x"></i>
            </button>
        </form>
            <p class="firstParagraph">Nom : <?= $patientProfile->lastname ?></p>
            <p>Prénom : <?= $patientProfile->firstname ?></p>
            <p>Date de naissance : <?= $patientProfile->birthdate ?></p>
            <p>Adresse e-mail : <?= $patientProfile->mail ?></p>
            <p>Numéro de téléphone : <?= $patientProfile->phone ?></p>
        <?php 
        } else { 
            if(isset($_POST['undo'])){
                unset($_POST['undo']);
            }?>
            <form action="" method="post">
            <button class="modifyButton" type="submit" name="undo" value="undo">
                <i class="fas fa-undo fa-2x"></i>
            </button>
            </form>
            <form class="colContainer" method="post" action="">
            <label for="lastname">Nom de famille</label>
            <input placeholder="Dupont" type="text" name="lastname" value="<?= $patientProfile->lastname ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['lastname']) ? $errorlist['lastname'] : '' ?></p>
            <label for="firstname">Prénom</label>
            <input placeholder="Jean" type="text" name="firstname" value="<?= $patientProfile->firstname ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['firstname']) ? $errorlist['firstname'] : '' ?></p>
            <label for="birthdate">Date de naissance</label>
            <input placeholder="02/03/1982" type="text" name="birthdate" value="<?= $patientProfile->birthdate ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['birthdate']) ? $errorlist['birthdate'] : '' ?></p>
            <label for="mail">E-mail</label>
            <input placeholder="Dupont.jean@gmail.com" type="text" name="mail" value="<?= $patientProfile->mail ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['mail']) ? $errorlist['mail'] : '' ?></p>
            <label for="phone">Téléphone</label>
            <input placeholder="0645326735" type="text" name="phone" value="<?= $patientProfile->phone ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['phone']) ? $errorlist['phone'] : '' ?></p>
            <div>
                <input class="confirm" type="submit" value="Confirmer" name="addPatient">
            </div>
        </form>
        <?php } ?>
    </div>
</body>

</html>