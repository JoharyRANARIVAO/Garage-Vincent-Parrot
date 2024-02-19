<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

$postData = $_POST;

if (
    !isset($postData['id'])
    || !is_numeric($postData['id'])
    || empty($postData['title'])
    || empty($postData['car'])
    || trim(strip_tags($postData['title'])) === ''
    || trim(strip_tags($postData['car'])) === ''
) {
    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}

$id = (int)$postData['id'];
$title = trim(strip_tags($postData['title']));
$car = trim(strip_tags($postData['car']));
$car_km = isset($_POST['car_km']) ? intval($_POST['car_km']) : 0;
$car_price = isset($_POST['car_price']) ? floatval($_POST['car_price']) : 0;
$year_of_registration = isset($postData['year_of_registration']) ? intval($postData['year_of_registration']) : 0;

// Vérifie s'il y a des erreurs lors du téléchargement de la nouvelle image
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
    return; // Arrête l'exécution du script en cas d'erreur
}

// Traitement du téléchargement de la nouvelle image
if(isset($_FILES['car_image']) && $_FILES['car_image']['error'] === UPLOAD_ERR_OK) {
    $upload_directory = './assets/images/';
    $image_name = $_FILES['car_image']['name'];
    $target_path = $upload_directory . $image_name;

    if(move_uploaded_file($_FILES['car_image']['tmp_name'], $target_path)) {
        $image_path = $upload_directory . $image_name;

        // Met à jour le véhicule avec la nouvelle image
        $updateCarStatement = $mysqlClient->prepare('UPDATE cars SET title = :title, car = :car,car_km = :car_km ,car_price = :car_price, image_path = :image_path , year_of_registration = :year_of_registration WHERE car_id = :id');
        $updateCarStatement->execute([
            'title' => $title,
            'car' => $car,
            'car_km' => $car_km,
            'car_price' => $car_price,
            'image_path' => $image_path,
            'year_of_registration' => $year_of_registration,
            'id' => $id,
        ]);

        if ($updateCarStatement->rowCount() > 0) {
            echo 'Véhicule modifié avec succès !';
        } else {
            echo 'Erreur lors de la modification du véhicule.';
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Site de Véhicules - Modification de Véhicule</title>
    
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <?php require_once(__DIR__ . '/header.php'); ?>
        <h1>Véhicule modifié avec succès !</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo($title); ?></h5>
                <p class="card-text"><b>Email</b> : <?php echo $_SESSION['LOGGED_USER']['email']; ?></p>
                <p class="card-text"><b>Véhicule</b> : <?php echo $car; ?></p>
                <img src="<?php echo $image_path; ?>" alt="Image du véhicule">
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
</html>
