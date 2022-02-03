<?php

//Création de session pour sauvegarde des POST
session_start();

require '../controller/appointmentSearchBar.php';
require '../controller/addAppointment.php';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/addAppointment.css">
    <link rel="stylesheet" href="../assets/css/searchBar.css">
    <title>Formulaire de Rendez-vous</title>
    <script>
        /*to prevent Firefox FOUC, this must be here*/
        let FF_FOUC_FIX;
    </script>
</head>

<body>
    <a class="returnButton" href="index.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
    <div class="flex-container">
        <h1>Ajout de Rendez-vous</h1>
    </div>
    <div id="appoContainer">
        <!-- Affichage du nombre de résultats de la recherche au clic-->
        
        <h2>Rechercher un patient</h2>
        <form id="searchForm" method="post" action="">
            <input type="search" name="searchLastName" placeholder="Dupontel">
            <input type="search" name="searchFirstName" placeholder="Albert">
            <input class="confirm" type="submit" value="rechercher">
        </form>
        <?php if (isset($_POST['searchFirstName']) || isset($_POST['searchLastName'])) {
?>
        <div id="results"><p><?= $countResults->results ?> résultats trouvés</p></div>
        <?php } ?>
        <!-- Affichage de la liste des patients recherchés si le formulaire a été envoyé -->
        <?php if ((isset($_SESSION['searchLastName']) || isset($_SESSION['searchFirstName'])) && (!isset($_POST['searchFirstName']) || !isset($_POST['searchLastName']))) {
        ?>
            <?php if (isset($_GET['patient'])) {
                foreach ($appointmentForm as $selectedPatient) {
            ?>
                <div class="card patient appoCard">
                    <h3>Nouveau RDV pour <?= $selectedPatient->lastname ?> <?= $selectedPatient->firstname ?></h3>
                    <form id="appoForm" method="post" action="">
                        <input type="datetime-local" name="dateHour">
                        <button class="confirm" type="submit" value="Réserver" name="addAppointment">Réserver</button>
                    </form>
                </div>
    </div>
<?php
                }   
        } 
        } ?>
<?php if (isset($_POST['searchFirstName']) || isset($_POST['searchLastName'])) {
?>
    <!-- Boucle foreach d'affichage des patients recherchés -->

    <div class="cardsContainer">
        <?php
        foreach ($searchResults as $results) {
        ?>
            <div class="card patient">
                <p><?= $results->lastname ?></p>
                <p><?= $results->firstname ?></p>
                <p><?= $results->birthdate ?></p>
                <p><?= $results->phone ?></p>
                <p><?= $results->mail ?></p>
                <form method="get" action="">
                    <input type="hidden" name="patient" value="<?= $results->id ?>"><button class="confirm" type="submit">+</button>
                </form>
            </div>
        <?php
        }
        ?>

    </div>

<?php
}
?>
</body>

</html>