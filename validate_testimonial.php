<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['LOGGED_USER'])) {
    echo('Accès refusé.');
    exit;
}

// Vérifier si un ID de témoignage est passé en paramètre
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo('ID de témoignage non fourni.');
    exit;
}

$testimonialId = $_GET['id'];

// Mettre à jour le témoignage pour le valider
$stmt = $mysqlClient->prepare("UPDATE testimonies SET validated = 1 WHERE testimonial_id = :testimonial_id");
$stmt->bindParam(':testimonial_id', $testimonialId);
$stmt->execute();

// Redirection vers la page de modération avec un message de succès
header("Location: moderation.php?success=1");
exit;
?>
