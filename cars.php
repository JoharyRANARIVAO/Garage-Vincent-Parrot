<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Garage Vincent PARROT </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
    
<div class="container">
    <div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
    <div class="banniere">
        <div class="banniere-titre">
            <h4>Mode sombre</h4>
        </div>
        <div class="switch-box">
            <i class="fas fa-moon"></i>
            <div class="btnDark">
            </div>
        </div>
    </div>
    <div class="article">
    <div class="container mt-5">
        <h1 class="pt-3 mt-5 bg-light rounded text-center">Voitures d'occasion</h1>
    
        <div class="row row-cols-1 row-cols-md-2 g-3">
        <?php foreach (getCars($cars) as $car) : ?>
    <div class="col-md-6">
        <div class="card h-100">
            <?php if (isset($car['image_path'])) : ?>
                <img src="<?php echo $car['image_path']; ?>" class="card-img-top" alt="Image de la voiture">
            <?php endif; ?>
            
            <div class="card-body d-flex flex-column">
                <h3 class="card-title"><a href="cars_read.php?id=<?php echo($car['car_id']); ?>"><?php echo($car['title']); ?></a></h5>
                <p class="card-text"><?php echo $car['car']; ?></p>
                <p class="card-text">Kilométrage : <?php echo $car['car_km']; ?>km</p>
                <p class="card-text">Prix : <?php echo $car['car_price']; ?>€</p>
                <p class="card-text">Année de mise en circulation : <?php echo $car['year_of_registration']; ?></p>
                <p class="card-text">Editer par: <small class="text-muted"><?php echo displayAuthor($car['author'], $users); ?></small></p>
                <?php if (isset($_SESSION['LOGGED_USER']) && $car['author'] === $_SESSION['LOGGED_USER']['email']) : ?>
                    <div class="mt-auto">
                        
                            <a class="btn btn-warning" href="cars_update.php?id=<?php echo($car['car_id']); ?>">Editer le véhicule</a>
                            <a class="btn btn-danger" href="cars_delete.php?id=<?php echo($car['car_id']); ?>">Supprimer le véhicule</a>
                        
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach ?>

        </div>
    </div>
</div>
</div>

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
