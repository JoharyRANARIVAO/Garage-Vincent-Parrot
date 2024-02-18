

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Base de données : `Garage_Parrot`
--

-- --------------------------------------------------------

--
-- Structure de la table `Cars`
--

CREATE TABLE `Cars` (
  `car_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `car_km` int(11) NOT NULL,
  `car` varchar(256) NOT NULL,
  `car_price` int(11) NOT NULL,
  `author` varchar(128) NOT NULL,
  `is_enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Cars`
--

INSERT INTO `Cars` (`car_id`, `title`, `car_km`, `car`, `car_price`, `author`, `is_enabled`) VALUES
(1, 'Mercedes-Classe A', 90000, 'Magnifique auto avec systeme \"my Mercedes\"', 22000, 'vincent.parrot@exemple.com', 1);

-- --------------------------------------------------------
CREATE TABLE `contact_messages` (
  `message_id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(128) NOT NULL,
  `prenom` VARCHAR(128) NOT NULL,
  `email` VARCHAR(256) NOT NULL,
  `telephone` VARCHAR(20) NOT NULL,
  `message` TEXT NOT NULL,
  `date_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE contact_messages
ADD COLUMN car_id INT NOT NULL;

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `comment` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(128) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `admin`, `age`) VALUES
(1, 'Vincent Parrot', 'vincent.parrot@exemple.com', 'Mongarage1986', 1, 45);
INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `admin`, `age`) VALUES
(2, 'Jean Dupont', 'Jean.Dupont@exemple.com', 'Turbo2024', 0, 24);
INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `admin`, `age`) VALUES
( 3,'Anne Joel', 'Anne.joel@exemple.com', 'TopGear2001', 0, 18);
--
-- Index pour les tables déchargées
UPDATE `users` SET `admin` = 0 WHERE `admin` IS NULL;

CREATE TABLE `testimonies` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial` text NOT NULL,
  `validated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `testimonies`
  ADD COLUMN `name` VARCHAR(255) NOT NULL AFTER `testimonial_id`,
  ADD COLUMN `comment` TEXT NOT NULL AFTER `name`,
  ADD COLUMN `rating` INT(11) NOT NULL AFTER `comment`;
ALTER TABLE `testimonies`
  MODIFY COLUMN `testimonial` TEXT NOT NULL DEFAULT 'Default testimonial';

CREATE TABLE `services` (
  `service_id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(128) NOT NULL,
  `description` TEXT NOT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `services` (`title`, `description`) VALUES
('Service pneumatiques', 'Service de remplacement et de réparation de pneus.'),
('Réparations mécaniques', 'Service de réparation et d''entretien mécanique pour tous types de véhicules.');
CREATE TABLE `opening_hours` (
  `opening_hour_id` INT NOT NULL AUTO_INCREMENT,
  `day_of_week` VARCHAR(10) NOT NULL,
  `opening_time` TIME NOT NULL,
  `closing_time` TIME NOT NULL,
  `is_open` TINYINT(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`opening_hour_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour la table `Cars`
--
ALTER TABLE `Cars`
  ADD PRIMARY KEY (`car_id`);

ALTER TABLE `Cars` ADD `year_of_registration` INT NOT NULL;

-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Cars`
--
ALTER TABLE `Cars`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

USE `Garage_Parrot`
ALTER TABLE `comments` ADD `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `comments` ADD `review` INT NOT NULL DEFAULT 3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
ALTER TABLE `users` MODIFY `admin` BOOLEAN;

ALTER TABLE `Cars`
ADD `image_path` VARCHAR(255) DEFAULT NULL;
