<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage V.Parrot- Ajout de véhicules</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
    <div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__ . '/header.php'); ?>
        </div>
        <div class="container mt-5" style="margin-top: 100px;"> 
        <div style="background-image: url('./assets/img/mercedes.jpg'); background-size: cover; background-position: center; border-radius: 15px; height: calc(100vh - 200px);"> 
        <a href="cars.php" class="btn btn-danger m-5">Voir les véhicules d'occasions</a> 
    </div>
</div>
        <h1 class="mt-5">Ajouter un véhicule</h1>
        <form action="cars_post_create.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="title" class="form-label">Marque du véhicule</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help">
                <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
            </div>
            <div class="mb-3">
                <label for="car" class="form-label">Description du véhicule</label>
                <textarea class="form-control" placeholder="Seulement du contenu vous appartenant ou libre de droits." id="car" name="car"></textarea>
            </div>
            <div class="mb-3">
    <label for="car_km" class="form-label">Kilométrage</label>
    <input type="number" class="form-control" id="car_km" name="car_km" aria-describedby="car_km-help">
    <div id="car_km-help" class="form-text">Indiquez le kilométrage du véhicule.</div>
</div>
        <div class="mb-3">
    <label for="year_of_registration" class="form-label">Année</label>
    <input type="number" class="form-control" id="year_of_registration" name="year_of_registration" aria-describedby="year_of_registration-help">
    <div id="year_of_registration-help" class="form-text">Indiquez l'année de mise en circulation du véhicule.</div>
</div>
<div class="mb-3">
        <label for="car_price" class="form-label">Prix du véhicule</label>
        <input type="number" class="form-control" id="car_price" name="car_price" aria-describedby="car_price-help">
        <div id="car_price-help" class="form-text">Indiquez le prix du véhicule.</div>
    </div>
    <div class="mb-3">
    <label for="car_image" class="form-label">Image du véhicule</label>
    <input type="file" class="form-control" id="car_image" name="car_image" accept="image/*" aria-describedby="car_image-help">
    <div id="car_image-help" class="form-text">Sélectionnez une image pour le véhicule.</div>
</div>
 
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
    <script src="./assets/bootstrap.min.js"></script>
<script src="./js/bold-and-dark.js"></script>
<?php

require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');


$query = "SELECT day_of_week, opening_time, closing_time FROM opening_hours";
$statement = $mysqlClient->prepare($query);
$statement->execute();
$openingHours = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
    
    let openingHoursList = document.getElementById('openingHoursList');
    let title = document.createElement('h4');
    title.textContent = "Nos horaires d'ouverture";
    title.classList.add('text-success', 'mb-3'); 
    openingHoursList.appendChild(title);
    <?php foreach ($openingHours as $hour) : ?>
        var listItem = document.createElement('li');
        listItem.textContent = "<?php echo $hour['day_of_week'] ?>: <?php echo $hour['opening_time'] ?> - <?php echo $hour['closing_time'] ?>";
        listItem.classList.add('list-group-item');
        openingHoursList.appendChild(listItem);
    <?php endforeach; ?>
</script>
</body>
</html>