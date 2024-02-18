<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('Il faut un identifiant de véhicule pour la modifier.');
    return;
}

$retrievecarStatement = $mysqlClient->prepare('SELECT * FROM cars WHERE car_id = :id');
$retrievecarStatement->execute([
    'id' => (int)$getData['id'],
]);
$car = $retrievecarStatement->fetch(PDO::FETCH_ASSOC);

// si le véhicule n'est pas trouvé, renvoyer un message d'erreur
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Vincent Parrot - Mise à jour de véhicule</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Mettre à jour <?php echo($car['title']); ?></h1>
        <form action="cars_post_update.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant du véhicule</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']); ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Nom du véhicule</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help" value="<?php echo($car['title']); ?>">
                <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
            </div>
            <div class="mb-3">
                    <label for="car_km" class="form-label">Kilométrage du véhicule</label>
                    <input type="number" class="form-control" id="car_km" name="car_km" value="<?php echo $car['car_km']; ?>">
                </div>
                <div class="mb-3">
                    <label for="car_price" class="form-label">Prix du véhicule</label>
                    <input type="number" class="form-control" id="car_price" name="car_price" value="<?php echo $car['car_price']; ?>">
                </div>
                <div class="mb-3">
                    <label for="year_of_registration" class="form-label">Année de mise en circulation</label>
                    <input type="number" class="form-control" id="year_of_registration" name="year_of_registration" value="<?php echo $car['year_of_registration']; ?>">
                </div>

            <div class="mb-3">
                <label for="car" class="form-label">Description du véhicule</label>
                <textarea class="form-control" placeholder="Seulement du contenu vous appartenant ou libre de droits." id="car" name="car"><?php echo $car['car']; ?></textarea>
            </div>
            <div class="mb-3">
    <label for="car_image" class="form-label">Image du véhicule</label>
    <input type="file" class="form-control" id="car_image" name="car_image" accept="image/*" aria-describedby="car_image-help">
    <div id="car_image-help" class="form-text">Sélectionnez une image pour le véhicule.</div>
</div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <br />
    </div>

    <?php require_once(__DIR__ . '/footer.php'); ?>
    <script src="./assets/bootstrap.min.js"></script>
<script src="./js/bold-and-dark.js"></script>
</body>
</html>