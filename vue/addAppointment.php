<?php 

require '../controller/addAppointment.php'; 

//Création de session pour sauvegarde des POST
session_start();

//Condition d'ajout si le formulaire a été validé

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>
    <a class="returnButton" href="patientsList.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    <div class="flex-container">
        <h1>Ajout de Rendez-vous</h1>
    </div>
    <div class="appoContainer">
        <h2>Rechercher un patient</h2>
        <form method="post" action="">
            <input type="search" name="searchLastName" placeholder="Dupontel">
            <input type="search" name="searchFirstName" placeholder="Albert">
            <input type="submit">
        </form>
        <!-- Affichage de la liste des patients recherchés si le formulaire a été envoyé -->
        <?php if(isset($_SESSION['searchLastName']) || isset($_SESSION['searchFirstName'])){
            //Incrément pour identifier le patient séléctionné
            ?> 
            <?php if(isset($_GET['patientId'])) {
                foreach($appointmentForm as $selectedPatient){
                ?>
                <h3>Nouveau RDV pour <?= $selectedPatient->lastname ?> <?= $selectedPatient->firstname ?></h3>
            <form method="post" action="">
                <input type="datetime-local" name="dateHour">
                <input type="submit" value="Réserver" name="book">
            </form>
            <?php
                }    
            } 
        }?>
        <?php if (isset($_POST['searchFirstName']) || isset($_POST['searchLastName'])){
            ?>
            <!-- Affichage du nombre de résultats de la recherche -->
            <h2><?= $countResults->results ?> résultats trouvés.</h2>
            <!-- Boucle foreach d'affichage des patients recherchés -->
            <?php
            foreach($searchResults as $results){
            ?>
                <table>
                    <tr>
                        <td><?= $results->lastname ?></td>
                        <td><?= $results->firstname ?></td>
                        <td><?= $results->birthdate ?></td>
                        <td><?= $results->phone ?></td>
                        <td><?= $results->mail ?></td>
                        <!-- Formulaire get afin de récupérer le patient pour ajouter un rdv -->
                        <form method="get" action="">
                        <td><input type="hidden" name="patientId" value="<?= $results->id ?>"><button type="submit">+</button></td>
                        </form>
                    </tr>
                </table>
            <?php
            }
        }
            ?>
    </div>
</body>
</html>