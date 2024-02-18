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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de contact</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
    
<div class="position-absolute top-0 start-50 translate-middle-x w-100" >
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
<div class="container mt-5 content-container">
    <h1 class="mt-5">Messages de contact</h1>

    <?php
   require_once(__DIR__.'/config/mysql.php');
   require_once(__DIR__.'/databaseconnect.php');

    // Sélectionnez tous les messages de contact de la base de données
    $query = "SELECT cm.*, c.title AS car_title FROM contact_messages cm INNER JOIN cars c ON cm.car_id = c.car_id";
    $statement = $mysqlClient->prepare($query);
    $statement->execute();
    $messages = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Vérifiez s'il y a des messages à afficher
    if (count($messages) > 0) {
        ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Message</th>
                    <th>Voiture associée</th>
                    <th>Date/Heure</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($messages as $message) { ?>
                    <tr>
                        <td><?= $message['nom'] ?></td>
                        <td><?= $message['prenom'] ?></td>
                        <td><?= $message['email'] ?></td>
                        <td><?= $message['telephone'] ?></td>
                        <td><?= $message['message'] ?></td>
                        <td><?= $message['car_title'] ?></td>
                        <td><?= $message['date_time'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        echo "<p class='text-muted'>Aucun message de contact trouvé.</p>";
    }
    ?>
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