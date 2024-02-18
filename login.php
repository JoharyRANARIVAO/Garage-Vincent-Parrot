<!--
   Si utilisateur/trice est non identifié(e), on affiche le formulaire
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Parrot-Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="./assets/style.css">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
<div class="position-absolute top-0 start-50 translate-middle-x w-100">
<?php require_once(__DIR__.'/header.php'); ?>
</div>
    
<div class="container mt-5 ">
    <h1 class="pt-3  bg-success rounded text-center testimony-form">Connexion</h1>
    <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
        <form action="submit_login.php" method="POST">
            <!-- si message d'erreur on l'affiche -->
            <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                    unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
                <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
        <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
    <?php else : ?>
        <div class="alert alert-success" role="alert">
            Bonjour <?php echo $_SESSION['LOGGED_USER']['email']; ?> et bienvenue sur le site !
        </div>
    <?php endif; ?>
<div class="position-absolute bottom-0 end-0 start-50 translate-middle-x w-100">
    <?php require_once(__DIR__.'/footer.php'); ?>
    
    <div>
</div>
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