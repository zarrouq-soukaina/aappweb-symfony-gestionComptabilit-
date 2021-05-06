-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 09 sep. 2020 à 02:13
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `comptabilite`
--

-- --------------------------------------------------------

--
-- Structure de la table `caisse`
--

DROP TABLE IF EXISTS `caisse`;
CREATE TABLE IF NOT EXISTS `caisse` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sortiecheques_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paiementvente_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `date_modif` date NOT NULL DEFAULT current_timestamp(),
  `motif` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client_cheque` (`sortiecheques_id`),
  KEY `fk_client_paiment` (`paiementvente_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `caisse`
--

INSERT INTO `caisse` (`id`, `sortiecheques_id`, `paiementvente_id`, `montant`, `date_modif`, `motif`) VALUES
('2508203312', '2408202311', NULL, 18000, '2020-07-18', 'Achat du matériels');

-- --------------------------------------------------------

--
-- Structure de la table `cheque`
--

DROP TABLE IF EXISTS `cheque`;
CREATE TABLE IF NOT EXISTS `cheque` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depenses_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiare` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `IDX_A0BBFDE9338B55D2` (`depenses_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cheque`
--

INSERT INTO `cheque` (`id`, `depenses_id`, `beneficiare`, `date`) VALUES
('2408202311', '2408205811', 'Bouzelmad', '2020-07-18'),
('2708204010', '2708205410', 'Zarrouq', '2020-07-17');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `adresse`, `type`) VALUES
('2408200510', 'zarrouq', 'soukaina', '17 ouarzazate', 'Particulier'),
('3108200302', 'zarrouq', 'manal', '19 ouarzazate maroc', 'société');

-- --------------------------------------------------------

--
-- Structure de la table `commandeachat`
--

DROP TABLE IF EXISTS `commandeachat`;
CREATE TABLE IF NOT EXISTS `commandeachat` (
  `id` varchar(20) NOT NULL,
  `fournisseurs_id` varchar(11) NOT NULL,
  `date_achat` date NOT NULL DEFAULT current_timestamp(),
  `ref_facture` int(11) NOT NULL,
  `total` int(20) NOT NULL,
  `tva` int(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_10E0F5AE27ACDDFD` (`fournisseurs_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandeachat`
--

INSERT INTO `commandeachat` (`id`, `fournisseurs_id`, `date_achat`, `ref_facture`, `total`, `tva`) VALUES
('2408201009', '2408204709', '2020-07-18', 15885, 18000, 0),
('2708201710', '2708202410', '2020-07-17', 581146, 7000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `commandevente`
--

DROP TABLE IF EXISTS `commandevente`;
CREATE TABLE IF NOT EXISTS `commandevente` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clients_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_vente` date NOT NULL DEFAULT current_timestamp(),
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_BEC35BB4AB014612` (`clients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandevente`
--

INSERT INTO `commandevente` (`id`, `clients_id`, `date_vente`, `total`) VALUES
('809204205', '2408200510', '2020-07-11', 8120),
('809205805', '2408200510', '2015-01-01', 5500),
('909203201', '2408200510', '2015-01-01', 1570);

-- --------------------------------------------------------

--
-- Structure de la table `commandevente_produit`
--

DROP TABLE IF EXISTS `commandevente_produit`;
CREATE TABLE IF NOT EXISTS `commandevente_produit` (
  `commandevente_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `produit_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qte_com` int(10) NOT NULL,
  `prix` int(20) DEFAULT NULL,
  PRIMARY KEY (`commandevente_id`,`produit_id`),
  KEY `IDX_1608B225FF3484D7` (`commandevente_id`),
  KEY `IDX_1608B225F347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandevente_produit`
--

INSERT INTO `commandevente_produit` (`commandevente_id`, `produit_id`, `qte_com`, `prix`) VALUES
('809204205', '809202705', 10, 1050),
('2508201701', '2408200308', 2, 0),
('2508201701', '2408200708', 10, 0),
('2508201701', '2408205708', 9, 0),
('809203602', '0809204602', 2, NULL),
('809204205', '809200105', 10, 1570),
('809204205', '809204602', 2, 5500),
('809205503', '809204602', 2, 5500),
('809205805', '809204602', 2, 5500),
('909203201', '809200105', 10, 1570);

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `id` varchar(20) NOT NULL,
  `achats_id` varchar(20) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `motif` longtext NOT NULL,
  `date_depense` date NOT NULL DEFAULT current_timestamp(),
  `mode_pai` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_Fachat` (`achats_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`id`, `achats_id`, `montant`, `motif`, `date_depense`, `mode_pai`) VALUES
('2408205811', '2408201009', 18000, 'Achat du matériels', '2020-07-18', 'chèque'),
('2708205410', '2708201710', 4000, 'Achat de matériels', '2020-07-17', 'chèque');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200814163527', '2020-08-14 16:38:22', 7643),
('DoctrineMigrations\\Version20200815000713', '2020-08-16 14:44:34', 9191);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commandes_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_fact` date NOT NULL,
  `paiment` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_FE8664108BF5C2E6` (`commandes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `facture`
--

INSERT INTO `facture` (`id`, `commandes_id`, `date_fact`, `paiment`) VALUES
('2908205712', '809204205', '2020-07-13', 'Chèque');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `prenom`, `type`, `adresse`) VALUES
('2408204709', 'Bouzelmad', 'Takquyi-eddine', 'particulier', '12 rabat'),
('2708202410', 'zarrouq', 'soukaina', 'particulier', '17 rabat'),
('2708204910', 'faid', 'chaima', 'particulier', '12 marrakech');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE IF NOT EXISTS `livraison` (
  `id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factures_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_liv` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_A60C9F1FE9D518F9` (`factures_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `factures_id`, `date_liv`) VALUES
('2908200112', '2908205712', '2015-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `paiment`
--

DROP TABLE IF EXISTS `paiment`;
CREATE TABLE IF NOT EXISTS `paiment` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `factures_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datepai` date NOT NULL DEFAULT current_timestamp(),
  `mantant_rest` int(11) DEFAULT NULL,
  `montantpay` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `UNIQ_DC8138FE9D518F9` (`factures_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix_aht` int(11) NOT NULL,
  `tva` int(11) NOT NULL,
  `qte_stock` int(11) NOT NULL,
  `prix_ttc` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `designation`, `prix_aht`, `tva`, `qte_stock`, `prix_ttc`) VALUES
('809200105', 'clavier X985', 150, 5, 80, 157),
('809202705', 'Souris Gb 588', 100, 5, 140, 105),
('809204602', 'PC SZ1998', 2500, 10, 492, 2750);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`) VALUES
('2908200611', 'zarrouq', 'soukaina', 'test'),
('2908204511', 'zarrouq', 'soukaina', 'testtest'),
('2908205612', 'zarrouq', 'soukaina', '$2y$13$WDYPoWxmXq0kgpFLGxQtRen9d2XBImC3sXqRu0pGNGVz9PX.q6lwW'),
('2908202301', 'zarrouq@gmail.com', 'soukaina', '$2y$13$ASha.kGD7.BFhYdWF53xJO4nt.u9kVh.i/SQXXadQ3EJpQCO.L5Xu'),
('2908203602', 'soukaina@gmail.com', 'soukaina', '$2y$13$ZSJB7Ihxs0aZJhRfcf/JvOhx3IY2.EGR7CBdSNHoItzYYgIzSvd0i'),
('0109205312', 'test@gmail.com', 'test', '$2y$13$lr9Uf.jShunVYELEEyLhyu8FxbRpPzXP13bVUktzcYLpzNNhjh0mO');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandevente`
--
ALTER TABLE `commandevente`
  ADD CONSTRAINT `FK_BEC35BB4AB014612` FOREIGN KEY (`clients_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE8664108BF5C2E6` FOREIGN KEY (`commandes_id`) REFERENCES `commandevente` (`id`);

--
-- Contraintes pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD CONSTRAINT `FK_A60C9F1FE9D518F9` FOREIGN KEY (`factures_id`) REFERENCES `facture` (`id`);

--
-- Contraintes pour la table `paiment`
--
ALTER TABLE `paiment`
  ADD CONSTRAINT `FK_DC8138FE9D518F9` FOREIGN KEY (`factures_id`) REFERENCES `facture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
