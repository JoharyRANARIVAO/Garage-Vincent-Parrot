<?php

session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');


$postData = $_POST;

if (!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo 'Il faut un identifiant valide pour supprimer un véhicule.';
    return;
}

$deleteCarsStatement = $mysqlClient->prepare('DELETE FROM Cars WHERE Car_id = :id');
$deleteCarsStatement->execute([
    'id' => (int)$postData['id'],
]);

redirectToUrl('index.php');