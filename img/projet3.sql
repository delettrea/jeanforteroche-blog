-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 07 août 2017 à 18:21
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet3`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `author`, `title`, `article`, `date`) VALUES
(1, 'Jean Forteroche', 'Episode 1', 'Article 1 : Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in mollis dolor. Donec laoreet risus eget mi facilisis, vitae pellentesque libero bibendum. Morbi lobortis quam ac sapien rhoncus, a malesuada diam ornare. Praesent facilisis efficitur tortor, id hendrerit diam feugiat eu. Mauris rutrum felis in urna tempus blandit. Nulla hendrerit lacus sit amet sem scelerisque dapibus. Nulla eu facilisis nunc. Etiam nec sapien ac odio gravida bibendum vel et justo.', '2017-06-28 11:57:25'),
(2, 'Jean Forteroche', 'Episode 2', 'Article 2 : Curabitur interdum, dui a dignissim dignissim, erat risus egestas nisi, non convallis arcu turpis et mi. Duis sit amet erat sed ex vehicula bibendum. Nullam ut dolor sit amet neque scelerisque condimentum id et diam. Ut vehicula molestie magna sed porta. Nam ornare gravida ligula ut tincidunt. Vivamus lobortis at ante vitae porttitor. Phasellus ac enim eros. Proin molestie risus non nibh varius, at ullamcorper tortor cursus.', '2017-06-28 11:59:19'),
(3, 'Jean Forteroche', 'Episode 3', 'Article 3 : Suspendisse in sapien sed metus interdum placerat. Mauris porttitor nibh quis ante tincidunt, convallis pulvinar velit fringilla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Donec ac elit tincidunt, eleifend nibh vel, tempus mi. Morbi laoreet, neque non consequat tempus, magna nulla gravida dolor, ac fringilla tortor urna ac ex. Curabitur augue neque, consectetur eu dui eu, pharetra aliquet tellus. Vivamus vel velit velit. Etiam in tortor purus. Phasellus lacinia purus sed sollicitudin pellentesque.', '2017-06-28 12:00:53'),
(9, 'Jean Forteroche', 'Episode 5', '<p>Auteur4 avec POO et<strong> test </strong></p>', '2017-08-03 13:55:17'),
(11, 'Jean Forteroche', 'Episode 4', '<p>Auteur4 avec POO et<strong> test pour</strong> HomeController et une autre modification</p>', '2017-08-03 13:41:35');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_com` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `edit` varchar(3) NOT NULL,
  `online` varchar(3) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_com`, `id_article`, `author`, `email`, `comment`, `edit`, `online`, `date`) VALUES
(1, 9, 'commentaire 1', 'email@email.com', 'Premier commentaire sur l\'article 9', 'off', 'on', '2017-07-01 16:00:00'),
(2, 3, 'commentaire 2', 'email@email.com', 'Premier commentaire sur l\'article 3', 'off', 'on', '2017-07-01 17:00:00'),
(4, 9, 'Nouveau commentaire ', 'email@email.com', 'Commentaire numero 2', 'off', 'on', '2017-07-04 19:51:41'),
(5, 9, 'Commentaire', 'email@email.com', '<p>Ceci est un nouveau commentaire avec test et message d\'edition</p>', 'on', 'on', '2017-08-03 14:55:01'),
(7, 9, 'J\'aime les commentaires', 'email@email.com', '<p>Ceci est un commentaire sans edition</p>', 'off', 'on', '2017-08-03 14:56:17'),
(8, 11, 'Auteur du seul commentaire', 'email@email.com', '<p>Ceci est le seul commentaire de cet article</p>', 'off', 'off', '2017-08-03 16:23:14'),
(9, 11, 'Auteur du seul commentaire', 'email@email.com', '<p>Ceci est un nouveau commentaire</p>', 'off', 'off', '2017-08-03 16:24:05'),
(10, 11, 'Auteur du 3éme commentaire', 'email@email.com', '<p>Ceci est un commentaire</p>', 'off', 'off', '2017-08-03 16:30:47'),
(11, 9, 'Auteur du seul commentaire', 'email@email.com', '<p>Nouveau commentaire</p>', 'off', 'off', '2017-08-03 16:32:23'),
(12, 9, 'Auteur du seul commentaire', 'email@email.com', '<p>TESSTTT</p>', 'off', 'off', '2017-08-03 16:33:23');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `authorization_user` varchar(10) NOT NULL,
  `biography` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `authorization_user`, `biography`) VALUES
(1, 'Jean Forteroche', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin', 'Pellentesque vel pretium libero. Aliquam consectetur lobortis diam sit amet faucibus. Donec volutpat, turpis id suscipit suscipit, augue eros feugiat sem, eu interdum tortor tortor a erat. Praesent imperdiet varius nisl et molestie. Curabitur porta porttitor quam ac vestibulum. Morbi sed tempus felis. Donec accumsan elementum urna sed suscipit.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `com` (`id_article`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `com` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
