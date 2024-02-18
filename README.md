Voici le projet ECF sur le garage Vincent Parrot pour la preparation du DWWM.
Afin de pouvoir consulter mon travail sur votre hardware en local, voici les étapes à suivre:
Installation de XAMPP pour PHP et MySQL
Ce guide vous expliquera comment installer XAMPP, un ensemble logiciel gratuit et open-source qui facilite le déploiement de serveurs web contenant Apache, MySQL, PHP, et Perl.
Étapes d'installation :
Téléchargement de XAMPP :

Rendez-vous sur le site officiel de XAMPP.
Téléchargez la version correspondant à votre système d'exploitation (Windows, macOS, Linux).
Installation de XAMPP :

Une fois le téléchargement terminé, exécutez le fichier d'installation.
Suivez les instructions à l'écran pour installer XAMPP. Sur Windows, vous pouvez être invité à sélectionner les composants à installer. Assurez-vous que PHP et MySQL sont sélectionnés.
Choisissez le répertoire d'installation (le répertoire par défaut est généralement recommandé).
Démarrage de XAMPP :

Après l'installation, lancez XAMPP depuis le dossier où il a été installé.
Sur Windows, double-cliquez sur xampp-control.exe. Sur macOS, ouvrez le dossier Applications et double-cliquez sur XAMPP Control.
Vous verrez une interface graphique où vous pouvez démarrer ou arrêter les différents modules (Apache, MySQL, etc.).
Vérification de l'installation :

Ouvrez votre navigateur web et accédez à http://localhost ou http://127.0.0.1.
Si XAMPP est correctement installé, vous devriez voir la page d'accueil de XAMPP.
Configuration de MySQL :

Dans XAMPP Control, assurez-vous que MySQL est démarré.
Ouvrez un navigateur et accédez à http://localhost/phpmyadmin.
Vous pouvez maintenant créer une nouvelle base de données: `Garage_Parrot`, importer une base de données existante, etc.

Créer une Base de données et ensuite vous pouvez utiliser les codes sql qui se trouve dans le dossier SQL de mon github
![capture d'ecran de mon vs code ou se trouve le dossier SQL](<img width="191" alt="Capture d’écran 2024-02-18 à 22 22 16" src="https://github.com/JoharyRANARIVAO/Garage-Vincent-Parrot/assets/126516353/388eb981-6132-475a-b97d-4f0d2c36328f">)
Création de la base de données et utilisation des scripts SQL :

Création de la base de données :

Après avoir installé XAMPP et lancé MySQL, ouvrez phpMyAdmin en accédant à http://localhost/phpmyadmin.
Créez une nouvelle base de données en cliquant sur l'onglet "Bases de données" et en saisissant un nom pour votre base de données dans le champ prévu à cet effet.=> `Garage_Parrot`
Assurez-vous de choisir un encodage approprié pour votre base de données (par exemple, utf8mb4_general_ci).
Utilisation des scripts SQL :

Dans votre projet GitHub, vous trouverez un dossier nommé "SQL" contenant des scripts SQL.
Ouvrez chaque script SQL dans un éditeur de texte ou un outil de gestion de base de données.
Exécutez les scripts SQL dans l'ordre indiqué pour créer les tables et insérer les données nécessaires dans votre base de données fraîchement créée.
Assurez-vous que chaque script s'exécute correctement et qu'il n'y a pas d'erreurs.
Validation :

Après avoir exécuté les scripts SQL, retournez dans phpMyAdmin pour vérifier que les tables et les données ont été correctement ajoutées à votre base de données.
Assurez-vous que toutes les tables nécessaires sont présentes et que les données sont conformes à ce que vous attendiez.
