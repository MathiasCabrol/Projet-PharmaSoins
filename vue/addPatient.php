<?php 
require '../controller/addPatientController.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addPatient.css">
    <title>Formulaire ajout de patient</title>
</head>

<body>
    <a class="returnButton" href="index.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    <div class="flex-container">
        <h1>Ajout de patient</h1>
    </div>
    <div class="formContainer">
        <form class="colContainer" method="post" action="addPatient.php">
            <label for="lastname">Nom de famille</label>
            <input placeholder="Dupont" type="text" name="lastname" value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['lastname']) ? $errorlist['lastname'] : '' ?></p>
            <label for="firstname">Prénom</label>
            <input placeholder="Jean" type="text" name="firstname" value="<?= isset($_POST['firstname']) ? $_POST['firstname'] : '' ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['firstname']) ? $errorlist['firstname'] : '' ?></p>
            <label for="birthdate">Date de naissance</label>
            <input placeholder="02/03/1982" type="text" name="birthdate" value="<?= isset($_POST['birthdate']) ? $_POST['birthdate'] : '' ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['birthdate']) ? $errorlist['birthdate'] : '' ?></p>
            <label for="mail">E-mail</label>
            <input placeholder="Dupont.jean@gmail.com" type="text" name="mail" value="<?= isset($_POST['mail']) ? $_POST['mail'] : '' ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['mail']) ? $errorlist['mail'] : '' ?></p>
            <label for="phone">Téléphone</label>
            <input placeholder="0645326735" type="text" name="phone" value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['phone']) ? $errorlist['phone'] : '' ?></p>
            <div>
                <input class="confirm" type="submit" value="Confirmer" name="addPatient">
            </div>
            <p><?= isset($errorlist['addPatient']) ? $errolist['addPatient'] : '' ?></p>
        </form>
    </div>
    
</body>

</html>