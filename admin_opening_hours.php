<?php
session_start();

require_once(__DIR__ . '/isConnect.php');

$userId = trim($_SESSION['LOGGED_USER']['user_id']);
if ($userId !== "1") {
    header('Location: permission_denied.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Admin horaire d'ouverture</title>
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
<div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
    <div class="container mt-5 main-container" style="margin-top: 100px;"> <!-- Ajout de marge en haut -->
    <div style="background-image: url('./assets/img/mercedes.jpg'); background-size: cover; background-position: center; border-radius: 15px; height: calc(100vh - 200px);"> <!-- Calcul de la hauteur pour prendre toute la hauteur de l'écran avec un décalage -->
        <a href="cars.php" class="btn btn-danger m-5">Voir les véhicules d'occasions</a> 
    </div>
</div>
    <div class="container m-5">
<h1>Gérer les horaires d'ouverture</h1>

<form id="openingHoursForm" method="POST" action="admin_opening_hours_process.php">
    <label for="dayOfWeek">Jour de la semaine:</label>
    <select id="dayOfWeek" name="dayOfWeek">
        <option value="Lundi">Lundi</option>
        <option value="Mardi">Mardi</option>
        <option value="Mercredi">Mercredi</option>
        <option value="Jeudi">Jeudi</option>
        <option value="Vendredi">Vendredi</option>
        <option value="Samedi">Samedi</option>
        <option value="Dimanche">Dimanche</option>
    </select>
    <br><br>
    <label for="openingTime">Heure d'ouverture:</label>
    <input type="time" id="openingTime" name="openingTime">
    <br><br>
    <label for="closingTime">Heure de fermeture:</label>
    <input type="time" id="closingTime" name="closingTime">
    <br><br>
    <button type="submit" onclick="addOpeningHours()">Ajouter</button>
</form>

<h2 m-5>Horaires actuels :</h2>
<ul id="currentOpeningHours">
    <!-- Les horaires seront affichés ici -->
</ul>
</div>

<script>
    function addOpeningHours() {
        var dayOfWeek = document.getElementById('dayOfWeek').value;
        var openingTime = document.getElementById('openingTime').value;
        var closingTime = document.getElementById('closingTime').value;

        var openingHours = {
            dayOfWeek: dayOfWeek,
            openingTime: openingTime,
            closingTime: closingTime
        };

        var openingHoursString = JSON.stringify(openingHours);

        var openingHoursList = document.getElementById('currentOpeningHours');
        var openingHoursListItem = document.createElement('li');
        openingHoursListItem.textContent = openingHoursString;
        openingHoursList.appendChild(openingHoursListItem);
    }
</script>
<div >
<footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <?php require_once(__DIR__.'/footer.php'); ?>
        </div>
    </footer>
  </div>
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