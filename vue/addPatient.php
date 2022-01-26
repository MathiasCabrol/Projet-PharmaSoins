<?php include '../controller/addPatientController.php'; 
 include '../modele/sendForm.php';
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addPatient.css">
    <title>Formulaire ajout de patient</title>
</head>

<body>
    <div class="flex-container">
        <h1>Ajout de patient</h1>
    </div>
    <div class="formContainer">
        <form class="colContainer" method="post" action="addPatient.php">
            <label for="lastname">Nom de famille</label>
            <input placeholder="Dupont" type="text" name="lastname">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['lastname']) ? $errorlist['lastname'] : '' ?></p>
            <label for="firstname">Prénom</label>
            <input placeholder="Jean" type="text" name="firstname">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['firstname']) ? $errorlist['firstname'] : '' ?></p>
            <label for="birthdate">Date de naissance</label>
            <input placeholder="02/03/1982" type="text" name="birthdate">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['birthdate']) ? $errorlist['birthdate'] : '' ?></p>
            <label for="mail">E-mail</label>
            <input placeholder="Dupont.jean@gmail.com" type="text" name="mail">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['mail']) ? $errorlist['mail'] : '' ?></p>
            <label for="phone">Téléphone</label>
            <input placeholder="0645326735" type="text" name="phone">
            <p><?= isset($_POST['addPatient']) && isset($errorlist['phone']) ? $errorlist['phone'] : '' ?></p>
            <div>
                <input class="confirm" type="submit" value="Confirmer" name="addPatient">
            </div>
        </form>
    </div>
    
</body>

</html>