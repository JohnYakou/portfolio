-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 04 fév. 2022 à 14:08
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wf3_php_intermediaire_prenom`
--

-- --------------------------------------------------------

--
-- Structure de la table `advert`
--

CREATE TABLE `advert` (
  `id` int(3) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `postal_code` int(5) NOT NULL,
  `city` varchar(70) NOT NULL,
  `type` enum('vente','location') NOT NULL,
  `price` int(10) NOT NULL,
  `reservation_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `advert`
--

INSERT INTO `advert` (`id`, `title`, `description`, `postal_code`, `city`, `type`, `price`, `reservation_message`) VALUES
(1, 'jhjh', 'jhjhjhjhjhj', 95500, 'Gonesse', 'vente', 100, ''),
(2, 'appart sympa', 'giouerur bn_izeutb iusro', 95500, 'Gonesse', 'vente', 1500, ''),
(3, 'APPART A VENDRE', 'UN APPART SYMPA A VENDRE LE PLUS TOT POSSIBLE', 75001, 'Paris', 'vente', 50000, ''),
(4, 'igbeu', 'jieurby i_qeychnvigyb_izaotnubiot shua _ç', 95500, 'Gonesse', 'location', 555, ''),
(5, 'bhetuihzeruio', 'gjzeriughzruibvhzriufvnyhauighdhuio uehgiy hi_', 95500, 'Gonesse', 'vente', 99999, ''),
(6, 'guierghiuo_z', 'giostj isrjblotyjyitr,jjubhjrilyjenr yjernio,tr', 95500, 'Gonesse', 'vente', 666, ''),
(7, 'trightrguih\'r', 'dfiogjuigtrjiug jtriurj rhj rtuihj i', 95500, 'Gonesse', 'vente', 1, ''),
(8, 'hhhh', 'HHHHHHHH', 95500, 'Gonesse', 'vente', 1000000, ''),
(9, 'yyughgbuiruit r', 'yug uyeghyuerhg yuergh er ghg ee gr ', 95500, 'Gonesse', 'vente', 500000, ''),
(10, 'hyuerhg', 'jg ehgeuihieruh eoyjeroij eiijy tr yjer bfgze zeg zuig hziug hziug hzio ', 95500, 'Gonesse', 'location', 275, ''),
(11, 'ghiue h', 'uiogfzj zjh iuzjrh jezhu juioj ziohriohj rzihj riohj ioh ny tj ,rihnjeh erioh jteyopyietjioh jrioejthioe', 95500, 'Gonesse', 'location', 350, ''),
(12, 'APPART DE LUXE', 'JE LOUE MON APPART DE LUXE POUR SEULEMENT 50 000 € PAR MOIS. A CE PRIX LA, C\'EST DONNE. VOUS NE TROUVEREZ PAS MOINS CHER AILLEURS !!!', 95500, 'Gonesse', 'location', 50000, ''),
(13, 'OKOK', 'OKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOKOK', 75000, 'Paris', 'vente', 6000000, 'Je suis intéressé par vote annonce '),
(14, 'APPART SUR MARSEILLE', 'CUI CUI', 13000, 'Marseille', 'location', 250, ''),
(15, 'VEND APPART TOULOUSE', 'uierghui eghi urhgiuz hueigh yuzgh zg zignuiz biurzh iurzhuizhj uizhj \r\n\r\nCONTACTER MOI !!!', 31000, 'Toulouse', 'vente', 1500000, ''),
(16, 'APPART BORDEAUX', '(è _ç\"(uy\'(uy_ç\'(uyç_u_t_ç(uyç_èuy_ç(-yu_çrthç_éu\'y_çrnju ç_(z\"u', 33000, 'Bordeaux', 'location', 55, ''),
(17, 'Je vend mon appart', 'Bonjour, je poste cette annonce dans le but de vendre un de mes 43 biens immobiliers. Le bâtiment contient 50 logements. Je le vend pour la modique somme de 650 000 €. Le prix n\'est pas négociable. Je ne répondrais qu\'aux personnes sérieuses.', 69000, 'Lyon', 'vente', 650000, ''),
(18, 'APPART BORDEAUX', '(è _ç\"(uy\'(uy_ç\'(uyç_u_t_ç(uyç_èuy_ç(-yu_çrthç_éu\'y_çrnju ç_(z\"u', 33000, 'Bordeaux', 'location', 55, ''),
(19, 'Je vend mon appart', 'Bonjour, je poste cette annonce dans le but de vendre un de mes 43 biens immobiliers. Le bâtiment contient 50 logements. Je le vend pour la modique somme de 650 000 €. Le prix n\'est pas négociable. Je ne répondrais qu\'aux personnes sérieuses.', 69000, 'Lyon', 'vente', 650000, '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `advert`
--
ALTER TABLE `advert`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `advert`
--
ALTER TABLE `advert`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;