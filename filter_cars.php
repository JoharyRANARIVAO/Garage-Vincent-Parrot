<?php
// Inclure le fichier de connexion à la base de données
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');

// Capturer les valeurs des filtres
$price = isset($_GET['price']) ? intval($_GET['price']) : null;
$mileage = isset($_GET['mileage']) ? intval($_GET['mileage']) : null;
$year = isset($_GET['year']) ? intval($_GET['year']) : null;

// Construire la requête SQL en fonction des filtres
$sql = "SELECT * FROM Cars WHERE is_enabled = 1";
if ($price !== null) {
    $sql .= " AND car_price <= $price";
}
if ($mileage !== null) {
    $sql .= " AND car_km <= $mileage";
}
if ($year !== null) {
    $sql .= " AND year_of_registration >= $year";
}

// Exécuter la requête SQL
$stmt = $mysqlClient->prepare($sql);
$stmt->execute();
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');

// Convertir les résultats en JSON et les renvoyer
echo json_encode($cars);
?>
