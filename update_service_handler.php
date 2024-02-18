<?php
session_start();

// Vérifier si l'utilisateur est connecté et s'il est Vincent Parrot (user_id = 1)
if (!isset($_SESSION['LOGGED_USER']) || $_SESSION['LOGGED_USER']['user_id'] !== "1") {
    header('Location: permission_denied.php');
    exit;
}

// Vérifier si les données du formulaire sont présentes
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_id']) && isset($_POST['title']) && isset($_POST['description'])) {
    // Inclure le fichier de connexion à la base de données
    require_once(__DIR__.'/config/mysql.php');
    require_once(__DIR__ . '/databaseconnect.php');

    try {
        // Nettoyer et récupérer les données du formulaire
        $serviceId = $_POST['service_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        // Préparer la requête SQL pour mettre à jour le service
        $query = "UPDATE services SET title = :title, description = :description WHERE service_id = :service_id";
        $statement = $mysqlClient->prepare($query);

        // Liaison des paramètres
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':service_id', $serviceId, PDO::PARAM_INT);

        // Exécution de la requête
        if ($statement->execute()) {
            // Rediriger vers une page de succès si la mise à jour est réussie
            header('Location: update_success.php');
            exit;
        } else {
            // Rediriger vers une page d'erreur si la mise à jour échoue
            header('Location: update_error.php');
            exit;
        }
    } catch (PDOException $exception) {
        // Gérer les erreurs PDO
        echo "Erreur lors de la mise à jour du service : " . $exception->getMessage();
        // Rediriger vers une page d'erreur
        header('Location: update_error.php');
        exit;
    }
} else {
    // Rediriger vers une page d'erreur si les données du formulaire sont manquantes
    header('Location: update_error.php');
    exit;
}
?>
