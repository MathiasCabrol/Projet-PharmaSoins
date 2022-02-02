<?php require '../controller/patient-list.php';
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
    <title>Liste de patients</title>
</head>

<body>

    <a class="returnButton" href="index.php"><i class="fas fa-chevron-circle-left fa-3x"></i></a>
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
            if (count($patientsList) == 0) {
            ?>
                <tr>
                    <td colspan="5">Aucun client renseigné</td>
                </tr>
                <?php
            } else {
                foreach ($patientsList as $client) {
                ?>
                    <tr onclick="window.location='patientProfile.php?patient=<?= $client->id ?>'">
                        <td><?= $client->lastname ?></td>
                        <td><?= $client->firstname ?></td>
                        <td><?= $client->birthdate ?></td>
                        <td><a href="mailto:<?= $client->mail ?>"><?= $client->mail ?></a></td>
                        <td><a href="tel:<?= $client->phone ?>"><?= $client->phone ?></a></td>
                        <form method="post" action="patientsList.php">
                            <td><input type="hidden" name="delete" value="<?= $client->id ?>">
                                <button type="submit" id="deleteButton">-</button>
                            </td>
                        </form>
                    </tr>
            <?php }
            } ?>
        </table>
    </div>
    <div class="buttonsContainer">
        <a href="addPatient.php"><button>Ajouter patient</button></a>
    </div>
</body>

</html>