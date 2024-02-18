<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employé ajouté</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
<div class="position-absolute top-0 start-50 translate-middle-x w-100" style="z-index:2;" >
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>

    <div class="container mt-5 position-relative " style="margin-top: 150px;z-index1;"> <!-- Ajout de marge en haut -->
    <div style="background-image: url('./assets/img/mercedes.jpg'); background-size: cover; background-position: center; border-radius: 15px; height: calc(100vh - 200px);position:relative;"> 
        <a href="cars.php" class="btn btn-danger"style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);font-size: 24px; padding: 15px 30px; border-radius: 15px; opacity:0.8;">Voir les véhicules d'occasions</a> 
    </div>
   <h1 class="mt-5">Well done👍🏽</h1>
   <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <?php require_once(__DIR__.'/footer.php'); ?>
        </div>
    </footer>
  
<script src="./assets/bootstrap.min.js"></script>
<script src="./js/bold-and-dark.js"></script>
<script src="./scripts/script.js"></script>
<?php
// Assurez-vous que la connexion à la base de données est établie
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

// Récupérez les horaires depuis la base de données
$query = "SELECT day_of_week, opening_time, closing_time FROM opening_hours";
$statement = $mysqlClient->prepare($query);
$statement->execute();
$openingHours = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
    // Utilisez les horaires récupérés pour générer le contenu HTML dans le footer
    let openingHoursList = document.getElementById('openingHoursList');
    let title = document.createElement('h4');
    title.textContent = "Nos horaires d'ouverture";
    title.classList.add('text-success', 'mb-3'); // Ajout de classes pour le style
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