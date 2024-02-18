<?php
session_start();

require_once(__DIR__ . '/isConnect.php');

$userId = trim($_SESSION['LOGGED_USER']['user_id']);
if ($userId !== "1") {
     header('Location: permission_denied.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer les données du formulaire
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $age = $_POST['age'];

    // Hasher le mot de passe (à des fins de sécurité)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $admin_default_value = 0;
    // Insérer les données dans la base de données
    require_once(__DIR__.'/config/mysql.php');
    require_once(__DIR__.'/databaseconnect.php'); // inclure le fichier de configuration MySQL

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO users (full_name, email, password, admin, age) VALUES (?, ?, ?, ?, ?)";
        $stmt = $mysqlClient->prepare($sql);

        // Exécuter la requête avec les valeurs liées
        $stmt->execute([$full_name, $email, $hashed_password, $admin_default_value, $age]);

        // Rediriger l'utilisateur vers une page de succès ou de confirmation
        header('Location: success.php');
        exit;
    } catch (PDOException $e) {
        // Gérer les erreurs PDO
        echo "Erreur d'insertion : " . $e->getMessage();
    }
}
?>

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
    <title>Ajouter un utilisateur</title>
</head>
<body class="d-flex flex-column min-vh-100 position-relative">
<div class="container">
<div class="position-absolute top-0 start-50 translate-middle-x w-100">
        <?php require_once(__DIR__.'/header.php'); ?>
    </div>
    <div class="container mt-5">
    <h2 class="mt-5 bg-danger p-3 text-white">Ajouter un utilisateur</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"class="p-4 border rounded shadow-sm bg-light">
        <label for="full_name">Nom complet :</label><br>
        <input type="text" id="full_name" name="full_name" class="form-control" required><br>

        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" class="form-control" required><br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" class="form-control" required><br>

        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age"class="form-control" required><br>

        <input type="submit" value="Ajouter">
    </form>
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
