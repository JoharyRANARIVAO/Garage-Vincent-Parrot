<?php
session_start();
require_once(__DIR__.'/config/mysql.php');
require_once(__DIR__.'/databaseconnect.php');
require_once(__DIR__.'/variables.php');
require_once(__DIR__.'/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Garage Vincent Parrot/Services</title>
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
<div class="position-absolute top-0 start-50 translate-middle-x w-100">
    <?php require_once(__DIR__.'/header.php'); ?>
</div>

<div class="container mt-5 bg-light">
    <div class="row align-items-center justify-content-center mb-5">
        <div class="col-lg-6">
            <img src="./assets/img/garage.png" alt="garage_mécanique" class="img-fluid rounded-3xl m-4" style="margin-right:40px;border-radius: 15px;">
        </div>
        <div class="col-lg-6">
            <p class="text-lg text-gray-700">
                Lorem ipsum dolor ipsum itaque, ab quibusdam suscipit mollitia asperiores officiis, expedita recusandae. Tenetur veniam hic vel nostrum officia ducimus sint sapiente libero omnis at id voluptatum natus perspiciatis debitis exercitationem voluptate dolor, error tempora. Ad facilis delectus, aliquam modi nemo aspernatur praesentium id eius maxime totam molestias veritatis laborum quos nulla vel, nihil, inventore incidunt dicta!
            </p>
        </div>
    </div>

    <!-- Formulaire de mise à jour des services -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center mb-4">Modifier les Services</h2>
            <form action="update_service_handler.php" method="POST">
                <div class="mb-3">
                    <label for="service_id" class="form-label">ID du Service:</label>
                    <input type="text" class="form-control" id="service_id" name="service_id">
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Titre:</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à Jour</button>
            </form>
        </div>
    </div>
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
