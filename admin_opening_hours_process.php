<?php
session_start();

// Inclure les informations de connexion à la base de données
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $dayOfWeek = $_POST["dayOfWeek"]; 
    $openingTime = $_POST["openingTime"]; 
    $closingTime = $_POST["closingTime"];

    try {
        // Insérer les horaires d'ouverture dans la base de données
        $sql = "INSERT INTO opening_hours (day_of_week, opening_time, closing_time) VALUES (?, ?, ?)";
        $stmt= $mysqlClient ->prepare($sql);
        if ($stmt->execute([$dayOfWeek, $openingTime, $closingTime])) {
            echo "Les horaires d'ouverture ont été ajoutés avec succès.";
            // Redirection vers la page d'administration des horaires d'ouverture
            header("Location: admin_opening_hours.php");
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'ajout des horaires d'ouverture.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message d'erreur et éventuellement logguer l'erreur
        echo "Erreur lors de l'insertion des horaires : " . $e->getMessage();
        // Vous pouvez également utiliser error_log() pour logguer l'erreur dans un fichier
        // error_log("Erreur PDO : " . $e->getMessage(), 0);
    }
}
?>
