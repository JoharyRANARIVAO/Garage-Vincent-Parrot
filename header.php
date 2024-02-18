<nav class="navbar navbar-expand-lg navbar-light  ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="./assets/logo.jpeg" alt="logo du Garage Parrot" class="img-fluid" style="max-width:100px;">
            </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse position-relative" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="cars.php">Nos véhicules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="Vos témoignages" href="testimony.php">Vos témoignages</a>
                </li>
               
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Se Connecter</a>
                </li>
                <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cars_create.php">Ajoutez un véhicule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_messages.php">Messages de contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="moderation.php">Modération des témoignages</a>
                    <li class="nav-item">
                        <a class="nav-link" href="create_users.php">Ajoutez un employé</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="update_services.php">Mise à jour des services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_opening_hours.php">Gérer l'ouverture </a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link" href="logout.php">Déconnexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>