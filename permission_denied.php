<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Permissions nécessaires</title>
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
    
<div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
    <div class="container mt-5">
    <h1 class="pt-3 mt-5 bg-danger rounded">Vous n'avez pas les permissions nécessaires pour accéder à cette page.</h1>
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