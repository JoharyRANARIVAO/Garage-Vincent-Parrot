<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');


$postData = $_POST;

// Vérification du formulaire soumis
if (
    empty($postData['title'])
    || empty($postData['car'])
    || trim(strip_tags($postData['title'])) === ''
    || trim(strip_tags($postData['car'])) === ''
    || !isset($postData['year_of_registration'])
) {
    echo 'Il faut un titre et un véhicule pour soumettre le formulaire.';
    return;
}

$title = trim(strip_tags($postData['title']));
$car = trim(strip_tags($postData['car']));
$car_km = isset($postData['car_km']) ? intval($postData['car_km']) : 0;
$car_price = isset($postData['car_price']) ? floatval($postData['car_price']) : 0;
$year_of_registration = isset($postData['year_of_registration']) ? intval($postData['year_of_registration']) : 0;


// Vérifie s'il y a des erreurs lors du téléchargement de l'image
if ($_FILES['car_image']['error'] !== UPLOAD_ERR_OK) {
    switch ($_FILES['car_image']['error']) {
        case UPLOAD_ERR_INI_SIZE:
            echo "La taille du fichier dépasse la limite autorisée par le serveur.";
            break;
        case UPLOAD_ERR_FORM_SIZE:
            echo "La taille du fichier dépasse la limite spécifiée dans le formulaire HTML.";
            break;
        case UPLOAD_ERR_PARTIAL:
            echo "Le fichier n'a été que partiellement téléchargé.";
            break;
        case UPLOAD_ERR_NO_FILE:
            echo "Aucun fichier n'a été téléchargé.";
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            echo "Le dossier temporaire est manquant.";
            break;
        case UPLOAD_ERR_CANT_WRITE:
            echo "Échec de l'écriture du fichier sur le disque.";
            break;
        case UPLOAD_ERR_EXTENSION:
            echo "Une extension PHP a arrêté le téléchargement du fichier.";
            break;
        default:
            echo "Erreur inconnue lors du téléchargement du fichier.";
            break;
    }
    return; 
}

// Traitement du téléchargement de l'image
if(isset($_FILES['car_image']) && $_FILES['car_image']['error'] === UPLOAD_ERR_OK) {
    // Chemin où stocker l'image sur le serveur
    $upload_directory = './assets/images/';
    $image_name = $_FILES['car_image']['name'];
    $target_path = $upload_directory . $image_name;

    // Déplacement du fichier téléchargé vers le répertoire de stockage
    if(move_uploaded_file($_FILES['car_image']['tmp_name'], $target_path)) {
        // Enregistrement du chemin d'accès dans la base de données
        $image_path = $upload_directory . $image_name;

        // Faire l'insertion en base
        $insertcar = $mysqlClient->prepare('INSERT INTO cars(title, car, car_km, car_price, author, is_enabled, image_path, year_of_registration) VALUES (:title, :car, :car_km, :car_price, :author, :is_enabled, :image_path, :year_of_registration)');
        $insertcar->execute([
            'title' => $title,
            'car' => $car,
            'car_price'=> $car_price,
            'car_km' => $car_km,
            'is_enabled' => 1,
            'author' => $_SESSION['LOGGED_USER']['email'],
            'image_path' => $image_path,
            'year_of_registration'=> $year_of_registration
        ]);

        // Vérification de l'insertion
        if ($insertcar->rowCount() > 0) {
            echo 'Véhicule ajouté avec succès !';
        } else {
            echo 'Erreur lors de l\'insertion du véhicule.';
        }
    } else {
        echo "Erreur lors du téléchargement de l'image.";
        return;
    }
} else {
    echo "Aucun fichier téléchargé ou erreur lors du téléchargement.";
    return;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Vehicule- Création de véhicule</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <!-- MESSAGE DE SUCCES -->
        <h1>véhicule ajoutée avec succès !</h1>

        <div class="card">

            <div class="card-body">
                <h5 class="card-title"><?php echo $title ; ?></h5>
                <p class="card-text"><b>Email</b> : <?php echo $_SESSION['LOGGED_USER']['email']; ?></p>
                <p class="card-text"><b>véhicule</b> : <?php echo $car; ?></p>
                <?php if(isset($image_path)): ?>
                <img src="<?php echo $image_path; ?>" alt="Image du véhicule">
                <?php endif; ?>

            </div>
        </div>
    </div>
    <?php require_once(__DIR__ . '/footer.php'); ?>
    <script src="./assets/bootstrap.min.js"></script>
<script src="./js/bold-and-dark.js"></script>
</body>
</html>
