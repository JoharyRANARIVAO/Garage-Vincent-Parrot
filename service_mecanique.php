

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
    <title>Garage Vincent Parrot/Services Mécanique</title>
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
<div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
    
    <div class="container mt-5 bg-light">
    <div class="row align-items-center justify-content-center mb-5">
        <div class="col-lg-6 ">
            <img src="./assets/img/garage.png" alt="garage_mécanique" class="img-fluid rounded-3xl m-4" style="height:256px;width:455px; margin-right:40px;border-radius: 15px;">
        </div>
        <div class="col-lg-6 ">
            <h2>Service Mécanique</h2>
            <p class="text-lg text-gray-700">
                Lorem ipsum dolor ipsum itaque, ab quibusdam suscipit mollitia asperiores officiis, expedita recusandae. Tenetur veniam hic vel nostrum officia ducimus sint sapiente libero omnis at id voluptatum natus perspiciatis debitis exercitationem voluptate dolor, error tempora. Ad facilis delectus, aliquam modi nemo aspernatur praesentium id eius maxime totam molestias veritatis laborum quos nulla vel, nihil, inventore incidunt dicta!
            </p>
        </div>
    </div>
    <div class="container mt-5 bg-light">
    <div class="row align-items-center justify-content-center mb-5">
        <div class="col-lg-6 ">
            <img src="./assets/img/pirelli.jpg" alt="garage_mécanique" class="img-fluid rounded-3xl m-4" style="margin-right:40px;border-radius: 15px;">
        </div>
        <div class="col-lg-6 ">
            <h2>Service Pneumatique</h2>
            <p class="text-lg text-gray-700">
                Lorem ipsum dolor ipsum itaque, ab quibusdam suscipit mollitia asperiores officiis, expedita recusandae. Tenetur veniam hic vel nostrum officia ducimus sint sapiente libero omnis at id voluptatum natus perspiciatis debitis exercitationem voluptate dolor, error tempora. Ad facilis delectus, aliquam modi nemo aspernatur praesentium id eius maxime totam molestias veritatis laborum quos nulla vel, nihil, inventore incidunt dicta!
            </p>
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