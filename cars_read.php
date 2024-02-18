<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');


$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('Le véhicule n\'existe pas');
    return;
}

// On récupère le véhicule
$retrievecarWithCommentsStatement = $mysqlClient->prepare('SELECT r.*, c.comment_id, c.comment, c.user_id,  DATE_FORMAT(c.created_at, "%d/%m/%Y") as comment_date, u.full_name FROM cars r 
LEFT JOIN comments c on c.car_id = r.car_id
LEFT JOIN users u ON u.user_id = c.user_id
WHERE r.car_id = :id 
ORDER BY comment_date DESC');
$retrievecarWithCommentsStatement->execute([
    'id' => (int)$getData['id'],
]);
$carWithComments = $retrievecarWithCommentsStatement->fetchAll(PDO::FETCH_ASSOC);

if ($carWithComments === []) {
    echo('Le véhicule n\'existe pas');
    return;
}
$year_of_registration = $carWithComments[0]['year_of_registration'];
$car_price = $carWithComments[0]['car_price'];
$car_km = $carWithComments[0]['car_km'];
$retrieveAverageRatingStatement = $mysqlClient->prepare('SELECT ROUND(AVG(c.review),1) as rating FROM cars r LEFT JOIN comments c on r.car_id = c.car_id WHERE r.car_id = :id');
$retrieveAverageRatingStatement->execute([
    'id' => (int)$getData['id'],
]);
$averageRating = $retrieveAverageRatingStatement->fetch();
;

$car = [
    'car_id' => $carWithComments[0]['car_id'],
    'title' => $carWithComments[0]['title'],
    'car' => $carWithComments[0]['car'],
    'author' => $carWithComments[0]['author'],
    'comments' => [],
    'rating' => $averageRating['rating'],
    'image_path' => $carWithComments[0]['image_path'],
    'year_of_registration' => $year_of_registration,
    'car_price' => $car_price,
    'car_km' => $car_km,
];

foreach ($carWithComments as $comment) {
    if (!is_null($comment['comment_id'])) {
        $car['comments'][] = [
            'comment_id' => $comment['comment_id'],
            'comment' => $comment['comment'],
            'user_id' => (int) $comment['user_id'],
            'full_name' => $comment['full_name'],
            'created_at' => $comment['comment_date'],
        ];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de véhicules - <?php echo($car['title']); ?></title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1><?php echo($car['title']); ?></h1>
     
        <div class="row">
        <p><b>Année de mise en circulation : </b><?php echo $car['year_of_registration']; ?></p>
        <p><b>Kilométrage : </b><?php echo $car['car_km'];?>km</p>
        <p><b>Prix : </b><?php echo $car['car_price']; ?> €</p>
            <article class="col">
                <?php echo($car['car']); ?>
            </article>
            <aside class="col">
                <p><i>Contribuée par <?php echo($car['author']); ?></i></p>
                <?php if ($car['rating'] !== null) : ?>
                    <p><b>Evaluée par la communauté à <?php echo($car['rating']); ?> / 5</b></p>
                <?php else : ?>
                    <p><b>Aucune évaluation</b></p>
                <?php endif; ?>
            </aside>
        </div>
        <div class="row">
            <div class="col">
                <?php if (!empty($car['image_path'])) : ?>
                    <img src="<?php echo $car['image_path']; ?>" class="img-fluid mx-auto d-block" style="max-width: 300px;" alt="Image du véhicule">
                <?php endif; ?>
            </div>
        </div>
        <hr />
        <h2>Commentaires</h2>
        <?php if ($car['comments'] !== []) : ?>
        <div class="row">
            <?php foreach ($car['comments'] as $comment) : ?>
                <div class="comment">
                    <p><?php echo($comment['created_at']); ?></p>
                    <p><?php echo($comment['comment']); ?></p>
                    <i>(<?php echo $comment['full_name']; ?>)</i>
                </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="row">
            <p>Aucun commentaire</p>
        </div>
        <?php endif; ?>
        <hr />
        <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
            <?php require_once(__DIR__ . '/comments_create.php'); ?>
        <?php endif; ?>
    </div>
    <div class="article">
        <div class="container mt-5">
            <?php
            // Vérifiez si le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Traitement du formulaire de contact ici
                // Vous pouvez récupérer les données soumises par le visiteur
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $telephone = $_POST['telephone'];
                $message = $_POST['message'];
                $car_id = $_POST['car_id'];
                // Effectuez des actions telles que l'envoi d'un email au garage ou l'enregistrement dans la base de données
                 // Préparez la requête SQL d'insertion
    $query = "INSERT INTO contact_messages (nom, prenom, email, telephone, message,car_id) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $mysqlClient->prepare($query);
    
    // Exécutez la requête avec les données du formulaire
    $statement->execute([$nom, $prenom, $email, $telephone, $message, $car_id]);
    
    // Affichez un message de succès ou effectuez d'autres actions nécessaires
    echo "Votre message a été envoyé avec succès.";
            }
            ?>
            <h1 class="pt-3 mt-5 bg-light rounded text-center">Détails du véhicule</h1>
            <div class="row">
                <!-- Affichage des détails du véhicule -->
            </div>
            <!-- Formulaire de contact -->
            <div class="row mt-5">
                <div class="col-md-6 offset-md-3">
                    <h2>Contactez-nous</h2>
                    <form method="post" action="">
                         <!-- Champ caché pour stocker l'identifiant de la voiture -->
                        <input type="hidden" name="car_id" value="<?php echo $car['car_id']; ?>">
                        <div class="mb-3">
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="telephone" name="telephone" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
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