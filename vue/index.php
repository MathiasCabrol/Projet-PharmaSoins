<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>PharmaSoins</title>
</head>

<body>
    <div class="flex-container">
        <h1>Pharma-Soins</h1>
        <img class="logo" src="../assets/image/Logo.jpg" alt="Logo Pharma-Soins">
        <h2>Bienvenue sur l'extranet !</h2>
        <p>Ici vous pourrez ajouter et/ou supprimer des RDV ainsi que des patients. Vous pourrez également consulter la liste des RDV et des patients inscrits.</p>
    </div>
    <div class="cardsContainer">
        <div class="card patient">
            <h3>Ajouter un patient</h3>
            <a href="addPatient.php"><button>+</button></a>
        </div>
        <div class="card">
            <h3>Liste des patients</h3>
            <a href="patientsList.php"><button>Consulter</button></a>
        </div>
        <div class="card">
            <h3>Ajouter un rendez-vous</h3>
            <a href="addAppointment.php"><button>+</button></a>
        </div>
        <div class="card">
            <h3>Liste des rendez-vous</h3>
            <a href="appointmentsList.php"><button>Consulter</button></a>
        </div>
    </div>
</body>

</html>