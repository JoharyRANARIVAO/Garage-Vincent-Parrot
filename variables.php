<?php
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
$usersStatement=$mysqlClient->prepare('SELECT * FROM users');
$usersStatement->execute();
$users=$usersStatement->fetchAll();


// Préparation de la requête SQL pour récupérer toutes les lignes de la table Cars
$carsStatement = $mysqlClient->prepare('SELECT * FROM Cars');

// Exécution de la requête SQL
$carsStatement->execute();

// Récupération de toutes les lignes de résultats
$cars = $carsStatement->fetchAll();
?>
