<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    echo('Accès refusé.');
    exit;
}

// Récupérer les témoignages non validés depuis la base de données
$stmt = $mysqlClient->prepare("SELECT testimonial_id, name, comment, rating FROM testimonies WHERE validated = 0");
$stmt->execute();
$testimonials = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modération des témoignages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
        <h1 class="mt-5 mb-3">Modération des témoignages</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Commentaire</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $testimonial) : ?>
                    <tr>
                        <td><?php echo $testimonial['name']; ?></td>
                        <td><?php echo $testimonial['comment']; ?></td>
                        <td><?php echo $testimonial['rating']; ?></td>
                        <td>
                            <a href="validate_testimonial.php?id=<?php echo $testimonial['testimonial_id']; ?>" class="btn btn-success">Valider</a>
                            <a href="reject_testimonial.php?id=<?php echo $testimonial['testimonial_id']; ?>" class="btn btn-danger">Rejeter</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <?php require_once(__DIR__.'/footer.php'); ?>
        </div>
    </footer>

<script src="./assets/bootstrap.min.js"></script>
<script src="./js/bold-and-dark.js"></script>
</body>
</html>
