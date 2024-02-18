<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

// Validation du formulaire
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Récupérer l'utilisateur depuis la base de données
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqlClient->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifier si le mot de passe correspond
        if (password_verify($password, $user['password'])) {
            // Authentification réussie
            $_SESSION['LOGGED_USER'] = [
                'email' => $user['email'],
                'user_id' => $user['user_id'],
            ];
        } else {
            // Vérifier si le mot de passe correspond au mot de passe non haché dans la base de données
            if ($password === $user['password']) {
                // Authentification réussie
                $_SESSION['LOGGED_USER'] = [
                    'email' => $user['email'],
                    'user_id' => $user['user_id'],
                ];
        } else {
            // Mot de passe incorrect
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Mot de passe incorrect.';
        }
    }
        
    } else {
        // Utilisateur non trouvé
        $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Utilisateur non trouvé.';
    }

    // Rediriger l'utilisateur
    redirectToUrl('index.php');
} else {
    // Si les données du formulaire ne sont pas complètes, rediriger vers la page de connexion
    redirectToUrl('login.php');
}
?>
