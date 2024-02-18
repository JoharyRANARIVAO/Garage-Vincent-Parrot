<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');

// Vérifier si le formulaire de témoignage a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['name'], $_POST['comment'], $_POST['rating'])) {
    // Récupérer les données soumises
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $rating = $_POST['rating'];

    // Insérer le témoignage dans la base de données (non validé)
    $stmt = $mysqlClient->prepare("INSERT INTO testimonies (name, comment, rating, testimonial) VALUES (:name, :comment, :rating, :testimonial)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':comment', $comment);
    $stmt->bindParam(':rating', $rating);
    $default_testimonial = 'Default testimonial';
    $stmt->bindParam(':testimonial', $default_testimonial);
    $stmt->execute();

    // Redirection vers une page de remerciement ou autre
    redirectToUrl("thankyou.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laisser un témoignage - Garage V.PARROT</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
<div class="container">
    <div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
    <div class="container testimony-form">
        <h1 class="pt-3 mt-5 bg-success rounded text-center">Laisser un témoignage</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="name">Votre nom :</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="comment">Votre commentaire :</label>
                        <textarea class="form-control" id="comment" name="comment" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="rating">Votre note :</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </form>
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
