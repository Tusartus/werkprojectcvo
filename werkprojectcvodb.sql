-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 07, 2022 at 06:59 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `werkprojectcvodb`
--
CREATE DATABASE IF NOT EXISTS `werkprojectcvodb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `werkprojectcvodb`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(258) NOT NULL,
  `slug` varchar(258) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`) VALUES
(1, 'boeken', 'boeken'),
(2, 'accessoires', 'accessoires'),
(3, 'laptop', 'laptop'),
(4, 'chips', 'chips'),
(5, 'chocolade', 'chocolade');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(259) NOT NULL,
  `email` varchar(259) NOT NULL,
  `provencie` varchar(259) NOT NULL,
  `bericht` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `provencie`, `bericht`, `created`) VALUES
(1, 'armel vanee', 'armel@gmail.com', 'Antwerpen', ' \r\n                       \r\n     Hello, \r\nik heb een vraagje. Ons afspraak voor volgende maand gaat het door of niet?\r\n                       \r\n                                                                                                      ', '2022-03-07 17:15:49'),
(3, 'marieke', 'marieke@gmail.com', 'West-Vlaanderen', ' \r\n Hallo,\r\n\r\nmijn naam is marieke.Ik heb een master in economie. Kan ik ook komen helpen.\r\n\r\n\r\nMvg,\r\nArthus                                  ', '2022-03-07 17:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `coupon_value` varchar(255) NOT NULL,
  `coupon_limit` varchar(255) NOT NULL,
  `coupon_expiry` date NOT NULL,
  `terms` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupon_code`, `type`, `description`, `coupon_value`, `coupon_limit`, `coupon_expiry`, `terms`, `created`) VALUES
(1, 'VSSCHOOL2022', 'percentage', '<p>coupon tegen 09/2022</p>\r\n', '10', '20', '2022-09-06', 'kopen in our webshop', '2022-03-05 17:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_redemptions`
--

DROP TABLE IF EXISTS `coupon_redemptions`;
CREATE TABLE IF NOT EXISTS `coupon_redemptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `helpen`
--

DROP TABLE IF EXISTS `helpen`;
CREATE TABLE IF NOT EXISTS `helpen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(259) NOT NULL,
  `description` text NOT NULL,
  `pic` varchar(259) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `helpen`
--

INSERT INTO `helpen` (`id`, `title`, `description`, `pic`, `created`) VALUES
(1, 'kom ons HELPEN!', 'S&amp;Z is steeds op zoek naar vrijwilligers. De inzet van elke vrijwilliger is van essentieel belang. Zonder hun engagement kan de organisatie niet bestaan.\r\n\r\nLeerkrachten, leerkrachten op rust of in opleiding en andere didactisch bekwame gediplomeerden kunnen het team van lesgevers versterken. Ook vrijwilligers met competenties in boekhouding, administratie, communicatie, IT&hellip; kunnen bij het besturen van de organisatie hun vrije tijd zinvol besteden.\r\n\r\nJe kan ook helpen door onze organisatie kenbaar te maken bij scholen, CLB&rsquo;s, ziekenhuizen &hellip;, zodat families met zieke kinderen de weg naar S&amp;Z kunnen vinden.\r\n\r\nOok scholen kunnen ons helpen bij de uitbreiding van het vrijwilligersnetwerk. Een ge&iuml;nformeerd leerkrachtenkorps en de oud-leerkrachten kunnen zo een uitgestoken hand bieden voor de zieke leerlingen. Wij stellen affiches ter beschikking om deze doelgroep te bereiken.\r\n', '289297.jpg', '2022-03-06 11:25:17'),
(2, 'Kom ons  STEUNEN?', 'De lesbegeleiding is kosteloos voor de ouders omdat vrijwilligers de zieke leerlingen belangeloos begeleiden.\r\n\r\nToch heeft School &amp; Ziekzijn heel wat kosten voor verzekeringen, verplaatsingen en administratie. Hiervoor hebben we jouw steun nodig. Dit kan door een gift te doen, als bedrijf te steunen, een actie op te zetten, &hellip;&nbsp;\r\n\r\nMeer informatie en het rekeningnummer vind je per provincie terug.\r\n\r\nDe werking van vzw School &amp; Ziekzijn, Brussel - Vlaams-Brabant is enkel mogelijk door giften, sponsoring door bedrijven en acties voor goede doelen. De vzw is officieel geregistreerd bij de Koning Boudewijnstichting.\r\n', '782565.jpg', '2022-03-06 11:27:41'),
(7, 'vorming and Hoelang duur het les geven ', 'De leerkrachten gaan gemiddeld &eacute;&eacute;n uur per week per vak bij de zieke leerling thuis of in het ziekenhuis les geven, steeds in samenspraak met de school van de leerling. Op deze manier blijft de band met de school behouden of wordt hij terug aangehaald.\r\n\r\nS&amp;Z zorgt voor de omkadering en vorming van de lesbegeleiders. Wij steunen&nbsp;de vrijwillige leerkracht en verstrekken de nodige gegevens in verband met de leerstof en de gezondheidstoestand van de leerling. Naast het vergoeden van de verplaatsingskosten verzekeren we de vrijwilliger tijdens het uitoefenen van de opdracht tegen lichamelijke ongevallen, burgerlijke aansprakelijkheid en rechtsbijstand. Wij bieden nuttige vormingen aan in het kader van de vrijwilligersactiviteit.\r\n', '457822.jpeg', '2022-03-06 13:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `title`, `description`) VALUES
(1, 'EEN RIJKE GESCHIEDENIS', '<p>In&nbsp;<strong>1951</strong>&nbsp;wordt een eerste ziekenhuisklasje opgericht in het St. Pietersziekenhuis te Brussel. Kort daarna krijgen de grote pediatrie afdelingen van het land gesubsidieerde schooltjes. In de vele kleinere ziekenhuizen wordt echter geen onderwijs aangeboden.</p>\r\n<p>In&nbsp;<strong>1982</strong>&nbsp;wordt door A-M Lamfalussy en Chantal Legrand een eerste vrijwilligersvereniging voor onderwijs aan zieke kinderen opgericht te Brussel, &lsquo;Ecole &agrave; l&rsquo;H&ocirc;pital &ndash; School in &rsquo;t Ziekenhuis&rsquo;.</p>\r\n<p>In&nbsp;<strong>1991</strong>&nbsp;wordt de vereniging een vzw met alle rechten en plichten verbonden aan dit juridisch statuut.</p>\r\n<p>In&nbsp;<strong>1993</strong>&nbsp;start de afdeling &lsquo;School na Ziekenhuis&rsquo; in Antwerpen met Fran&ccedil;oise Roels en Annick Van Coppenolle.</p>\r\n<p>In&nbsp;<strong>1998</strong>&nbsp;volgt Oost-Vlaanderen met de vereniging &lsquo;School in &amp; na Ziekenhuis&rsquo; (SINZ<em>),&nbsp;</em>opgericht door Claire Raeymaekers (&dagger;), Inge Bogaert en Miriam Tratsaert.</p>\r\n<p>In&nbsp;<strong>2001</strong>&nbsp;verandert de Brusselse vereniging haar naam naar &lsquo;Ecole &agrave; l&rsquo; H&ocirc;pital et &agrave; Domicile (EHD)&ndash; School aan huis en in &rsquo;t ziekenhuis (SHZ)&rsquo;.</p>\r\n<p>In&nbsp;<strong>2004</strong>&nbsp;wordt in Limburg SINZ opgericht door Guido Drijkoningen en Mart Peeters.</p>\r\n<p>In&nbsp;<strong>2010</strong>&nbsp;gaat de afdeling SINZ in West-Vlaanderen van start met Annemie Viaene, Micheline Decloedt, Miriam Tratsaert, Maaike Delbaere, Marleen Willaert.</p>\r\n<p>Ook in&nbsp;<strong>2010</strong>&nbsp;splitst SHZ zich af van EHD en richt Catheline Luyten-De Jonge een autonome vzw &lsquo;S&amp;Z, School &amp; Ziekzijn afdeling Brussel &ndash; Vlaams-Brabant&rsquo; op.</p>\r\n<p>Sindsdien is er in de vijf Vlaamse provincies een gelijkaardige, maar autonome werking voor het zieke kind.</p>\r\n<p>Op 25 maart&nbsp;<strong>2011</strong>&nbsp;wordt de &lsquo;Koepel School &amp; Ziekzijn Vlaanderen&rsquo; opgericht. De 5 afdelingen treden voor het eerst naar buiten onder dezelfde naam &lsquo;School &amp; Ziekzijn&rsquo;, met &eacute;&eacute;n folder, &eacute;&eacute;n website, &eacute;&eacute;n logo, &eacute;&eacute;n huisstijl, maar behouden hun autonome, provinciale werking.</p>\r\n<p>De vrijwilligersorganisatie S&amp;Z speelt gaandeweg een steeds grotere rol in het onderwijsveld rond het zieke kind. De Koepel S&amp;Z maakt deel uit van het Platform van Onderwijs aan Zieke Leerlingen in Vlaanderen (POZiLiV).</p>\r\n<p>\"</p>');

-- --------------------------------------------------------

--
-- Table structure for table `infogegevens`
--

DROP TABLE IF EXISTS `infogegevens`;
CREATE TABLE IF NOT EXISTS `infogegevens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(295) NOT NULL,
  `description` text NOT NULL,
  `linkurl` varchar(259) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infogegevens`
--

INSERT INTO `infogegevens` (`id`, `title`, `description`, `linkurl`) VALUES
(1, 'ANTWERPEN', '<p>0499 32 49 74 &amp; 0496 52 25 10</p>\r\n\r\n<p>antwerpen@s-z.be</p>\r\n\r\n<p>IBAN: BE43 9795 0207 1601</p>\r\n', 'https://www.snz-antwerpen.be/'),
(2, 'OOST-VLAANDEREN', '<p>0473 19 89 13</p>\r\n\r\n<p>oostvlaanderen@s-z.be</p>\r\n\r\n<p>IBAN: BE 30 0013 2079 191</p>\r\n', 'https://www.s-z.be/aanvraag-o-vl'),
(3, 'BRUSSEL - VLAAMS-BRABANT', '<p>02 731 43 96</p>\r\n\r\n<p>info@s-z.be</p>\r\n\r\n<p>IBAN: BE13 9730 0514 1539</p>\r\n', 'https://www.s-z.be/provincie-brussel-vlaams-brabant'),
(4, 'WEST-VLAANDEREN', '<p>0487 28 02 12 &amp; 0487 28 02 13</p>\r\n\r\n<p>westvlaanderen@s-z.be</p>\r\n\r\n<p>IBAN: BE39 0682 5158 8119</p>\r\n', 'https://schoolenziekzijn.peepl.be/nl/site/'),
(5, 'LIMBURG', '<p>089 85 53 24 &amp; 0479 50 87 08</p>\r\n\r\n<p>limburg@s-z.be</p>\r\n\r\n<p>IBAN: BE22 9796 5141 7447</p>\r\n', 'https://www.s-z.be/provincie-limburg');

-- --------------------------------------------------------

--
-- Table structure for table `lesgevers`
--

DROP TABLE IF EXISTS `lesgevers`;
CREATE TABLE IF NOT EXISTS `lesgevers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `pic` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lesgevers`
--

INSERT INTO `lesgevers` (`id`, `title`, `description`, `pic`, `created`) VALUES
(1, 'wie geeft lessen bij ons?', 'Gediplomeerde leerkrachten en leerkrachten op rust, uit het basis- en secundair onderwijs, begeleiden zieke kinderen en jongeren. Ook studenten in opleiding en gediplomeerde vrijwilligers zoals logopedisten, psychologen, ingenieurs &hellip; worden ingeschakeld in de werking.\r\n\r\nDe vrijwilligers die zich voor S&amp;Z engageren kiezen bewust om aan een ziek of herstellend kind les te geven. Zij zijn in staat om zich aan te passen aan de specifieke noden en situatie van het kind.\r\n\r\nS&amp;Z beschikt over een geografisch goed verspreid netwerk van leerkrachten voor alle vakken en niveaus. Zo houden we de verplaatsingen kort.\r\n', '420920.jpg', '2022-03-06 13:03:05'),
(2, 'Hoelang duurt het les geven', 'De leerkrachten gaan gemiddeld &eacute;&eacute;n uur per week per vak bij de zieke leerling thuis of in het ziekenhuis les geven, steeds in samenspraak met de school van de leerling. Op deze manier blijft de band met de school behouden of wordt hij terug aangehaald.\r\n\r\nS&amp;Z zorgt voor de omkadering en vorming van de lesbegeleiders. Wij steunen&nbsp;de vrijwillige leerkracht en verstrekken de nodige gegevens in verband met de leerstof en de gezondheidstoestand van de leerling. Naast het vergoeden van de verplaatsingskosten verzekeren we de vrijwilliger tijdens het uitoefenen van de opdracht tegen lichamelijke ongevallen, burgerlijke aansprakelijkheid en rechtsbijstand. Wij bieden nuttige vormingen aan in het kader van de vrijwilligersactiviteit.\r\n', '810343.jpeg', '2022-03-06 13:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `add_id` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `paymentmethod` varchar(255) NOT NULL,
  `coupon` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

DROP TABLE IF EXISTS `order_status`;
CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `overons`
--

DROP TABLE IF EXISTS `overons`;
CREATE TABLE IF NOT EXISTS `overons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(259) NOT NULL,
  `description` text NOT NULL,
  `pic` varchar(259) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overons`
--

INSERT INTO `overons` (`id`, `title`, `description`, `pic`, `created`) VALUES
(1, 'MISSIE', 'Elk kind heeft recht op onderwijs, ook het zieke kind!\r\n\r\nSchool &amp; Ziekzijn organiseert les- en studiebegeleiding voor het zieke kind. Zij wil, van zodra de gezondheidstoestand van de leerling dit toelaat, leerachterstand wegwerken en beperken. Zo tracht S&amp;Z het blijven zitten te vermijden.\r\n\r\nVia de vrijwilliger wordt het contact tussen de school, de klasgenoten en het zieke kind in stand gehouden wat bijdraagt tot de re&iuml;ntegratie in de school. Deze sociale steun doorbreekt eveneens het isolement van de zieke leerling.\r\n\r\nNaarmate de ziekteperiode langer duurt neemt de onrust over de toekomst en het welzijn toe. S&amp;Z biedt psychologische steun aan het zieke kind door het geven van onderwijs. De leerling krijgt terug hoop en kracht om verder aan zijn toekomst te bouwen.\r\n', '809261.jpg', '2022-03-06 12:20:57'),
(2, 'VISIE', 'Als een leerling ziek is, is een geco&ouml;rdineerd onderwijsaanbod thuis of in het ziekenhuis noodzakelijk. De verschillende partners verklaren uitdrukkelijk dat ze bereid zijn om voortdurend, in overleg met mekaar, op zoek te gaan naar de toegevoegde waarde van een aangepast pakket aan onderwijsondersteuning voor alle zieke leerlingen waarvoor de hulp van School &amp; Ziekzijn ingeroepen wordt. De ondersteuning door S&amp;Z is complementair aan andere initiatieven (TOaH, Bednet ).\r\n\r\nDe kerntaak van S&amp;Z is het organiseren van les - en studiebegeleiding voor de zieke leerling. Dit bewerkstelligt ze door het inzetten van competente, gediplomeerde en ervaren vrijwilligers.\r\n\r\nDe lessen zijn gratis, individueel, op maat van de leerling en steeds in samenwerking met de thuisschool en/of het CLB. Zij gaan door bij de zieke leerling thuis of daar waar de leerling verblijft. De inhoud en duur van de lessen worden aangepast aan het niveau en de gezondheidstoestand van de zieke leerling.\r\n\r\nAls de leerling weer &ldquo;gezond verklaard is&rdquo;, willen we er ook over waken dat de herinschakeling op school onmiddellijk gerealiseerd wordt.\r\n', '708468.jpg', '2022-03-06 12:22:29');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
CREATE TABLE IF NOT EXISTS `partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(295) NOT NULL,
  `linkurl` varchar(295) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `linkurl`) VALUES
(1, 'bednet', 'https://bednet.be/'),
(2, 'toah', 'https://onderwijs.vlaanderen.be/nl/toah'),
(3, 'k-diensten', 'https://www.onderwijsvoorziekekinderen.be/onderwijsbegeleiding-kinder-en-jeugdpsychiatrie'),
(4, 'Telnet', 'https://www2.telenet.be/residential/nl'),
(5, 'KBC ', 'https://www.kbc.be/particulieren/nl.html'),
(6, 'Proximus', 'https://www.proximus.be/nl/id_personal/particulieren.html');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Description` text NOT NULL,
  `pic` varchar(250) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `catid` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `Name`, `Description`, `pic`, `Price`, `catid`, `slug`, `created`) VALUES
(1, 'How to build a car', 'How to build a car: The Autobiography of the World&rsquo;s Greatest Formula 1 Designer&nbsp;Hardcover &ndash; 1 januari 2017\r\n\r\nTells the story of Newey&#39;s unrivalled career - one that spans 35 years - in Formula 1. A powerful and fascinating memoir, he talks the reader through the incredible cars he has designed, the drivers he has worked alongside and the races he has been involved with\r\n', '915753.jpg', '25', '1', 'how-to-build-a-car', '2022-03-05 16:36:32'),
(2, 'Het boek waarvan je wilde dat je ouders het hadden gelezen', 'Over het boek\r\n\r\nMeer dan 60.000 exemplaren, het opvoedboek als uitgebreide editie nu voor 15 euro.\r\n\r\nAchterflaptekst\r\n\r\n&lsquo;Een warm en wijs boek voor ouders en eigenlijk alle mensen die ooit iemands kind waren.&rsquo; &ndash;De Standaard &lsquo;Het beste opvoedboek dat ik heb gelezen. En dat zijn er heel wat!&rsquo; &ndash; Julia Wouters, schrijver en strategisch &amp; communicatieadviseur &lsquo;Zelf komt Perry over als de moeder die je graag had willen hebben: wijs, grappig en een tikje excentriek.&rsquo; &ndash; Psychologie Magazine &lsquo;Razend interessant.&rsquo; &ndash; Flair Lezersreacties: &ndash; &lsquo;Een topboek [...] een frisse liefdevolle kijk op opvoeden.&rsquo; &ndash; &lsquo;Ik vlieg door het boek, zo makkelijk leest het weg.&rsquo; &ndash; &lsquo;Echt een aanrader!&rsquo; &ndash; &lsquo;Met heel veel humor!&rsquo; Iedere ouder wil dat zijn kind gelukkig is, en dat het in een veilige omgeving opgroeit tot een gelukkige volwassene. Maar hoe doe je dat? In dit wijze, verstandige en verfrissende boek staat alles wat er in de opvoeding van een kind echt toe doet. Geen praktische tips over slapen, eten, goede manieren of huiswerk, maar helder advies over de essentie van het ouderschap. Op basis van haar rijke ervaring als therapeut, haar wetenschappelijke inzichten en haar persoonlijke ervaringen als ouder, behandelt Philippa Perry de grote vragen van de ouder-kindrelatie, van baby tot tienerjaren. Hoe ga je om met je eigen gevoelens en die van je kind? Hoe zien je gedragingen en patronen eruit? Hoe ga je om met je ouders, je partner, vrienden? Dit boek biedt een brede, verrassende kijk op een diepgaande en gezonde ouder-kindrelatie. Zonder oordelend te zijn, geeft Perry op een even directe als geestige manier inzicht in de invloed van je eigen opvoeding op je ouderschap. Het is een boek vol liefdevol advies over het maken van fouten en het onder ogen zien daarvan - waardoor het uiteindelijk goed zal komen.\r\n\r\nOver de auteur\r\n\r\nPhilippa Perry is al twintig jaar psychotherapeut en schrijver. Daarnaast is ze tv- en radiopresentator en werkt ze mee aan vele documentaires. Ze woont in Londen met haar echtgenoot, de kunstenaar Grayson Perry, met wie ze een volwassen dochter heeft.\r\n\r\n\r\nProductgegevens\r\n\r\n\r\n	Uitgever &rlm; : &lrm;&nbsp;Uitgeverij Balans; 1e editie (1 juni 2021)\r\n	Taal &rlm; : &lrm;&nbsp;Nederlands\r\n	Paperback &rlm; : &lrm;&nbsp;301 pagina&#39;s\r\n	ISBN-10 &rlm; : &lrm;&nbsp;9463821686\r\n	ISBN-13 &rlm; : &lrm;&nbsp;978-9463821681\r\n	Afmetingen &rlm; : &lrm;&nbsp;13.5 x 2.5 x 21.5 cm\r\n\r\n', '951436.jpg', '16', '1', 'het-boek-waarvan-je-wilde-dat-je-ouders-het-hadden-gelezen', '2022-03-05 16:38:06'),
(3, 'Lay\'s Naturel Chips, Doos 20 stuks x 45 g', '\r\n	\r\n		\r\n			Smaak\r\n			Gezouten\r\n		\r\n		\r\n			Merk\r\n			Lay&#39;s\r\n		\r\n		\r\n			Grootte\r\n			20 x 45 g\r\n		\r\n		\r\n			Gewicht\r\n			0.9 Kilogram\r\n		\r\n		\r\n			Afmetingen van item (L x B x H)\r\n			39.6 x 29.6 x 18.5 centimeter\r\n		\r\n		\r\n			Gewicht van pakket\r\n			1.17 Kilogram\r\n		\r\n	\r\n\r\n\r\n\r\nOver dit item\r\n\r\n\r\n	Simpelweg genieten, dat is waar de producten van Lay&rsquo;s voor staan. Bereid met echte ingredi&euml;nten en verkrijgbaar in onweerstaanbaar lekkere smaken\r\n	Al meer dan 60 jaar een hit en nog steeds vertrouwd lekker! Heerlijke aardappels, knapperig gebakken met een beetje zout, een echte klassieker in zijn iconische rode zak. Gezouten aardappelchips\r\n	Zonder kunstmatige kleurstoffen en conserverinngsmiddelen. Zonder toegevoegde smaakversterkers. Geschikt voor vegans en vegetarians\r\n	Lay&rsquo;s chips is verkrijgbaar in meerdere lekkere smaken: Naturel, Paprika, Patatje Joppie, Barbecue Ham, Bolognese, Heinz Tomato Ketchup &amp; Cheese &amp; Onion\r\n	Bevat 20 zakken per doos, elke zak bevat 1 portie\r\n\r\n', '993592.jpg', '8', '4', 'lay\'s-naturel-chips--doos-20-stuks-x-45-g', '2022-03-05 16:40:29'),
(4, 'Lay\'s Paprika Chips, Doos 20 stuks x 45 g', 'Over dit item\r\n\r\n\r\n	Simpelweg genieten, dat is waar de producten van Lay&rsquo;s voor staan. Bereid met echte ingredi&euml;nten en verkrijgbaar in onweerstaanbaar lekkere smaken\r\n	Nergens in de wereld houden mensen zoveel van Lay&rsquo;s Paprika chips als in Nederland. Een beetje zoet en lekker gekruid, al jaren favoriet! Aardappelchips met paprikasmaak\r\n	Zonder kunstmatige kleurstoffen en conserverinngsmiddelen. Zonder toegevoegde smaakversterkers\r\n	Lay&rsquo;s chips is verkrijgbaar in meerdere lekkere smaken: Naturel, Paprika, Patatje Joppie, Barbecue Ham, Bolognese, Heinz Tomato Ketchup &amp; Cheese &amp; Onion\r\n	Bevat 20 zakken per doos, elke zak bevat 1 portie\r\n\r\n', '26760.jpg', '6', '4', 'lay\'s-paprika-chips--doos-20-stuks-x-45-g', '2022-03-05 16:41:47'),
(5, 'Lay\'s Multibox Chips, 6 x 225 g', '\r\n	\r\n		\r\n			Merk\r\n			Lay&#39;s\r\n		\r\n		\r\n			Grootte\r\n			6 x 225 g\r\n		\r\n		\r\n			Gewicht\r\n			1350 Gram\r\n		\r\n		\r\n			Afmetingen van item (L x B x H)\r\n			70 x 230 x 330 centimeter\r\n		\r\n		\r\n			Gewicht van pakket\r\n			1.68 Kilogram\r\n		\r\n	\r\n\r\n\r\n\r\nOver dit item\r\n\r\n\r\n	Simpelweg genieten, dat is waar de producten van Lay&rsquo;s voor staan. Bereid met echte ingredi&euml;nten en verkrijgbaar in onweerstaanbaar lekkere smaken\r\n	Zonder kunstmatige kleurstoffen, toegevoegde smaakversterkers en conserverinngsmiddelen\r\n	Deze multibox is handig om uit te delen of mee te nemen op uitjes\r\n	Bevat 6 zakken van 225 g per doos, elke zak bevat 7-8 porties\r\n	Zonder kunstmatige kleurstoffen, toegevoegde smaakversterkers en conserverinngsmiddelen\r\n\r\n\r\nIngredi&euml;nten\r\n\r\n&nbsp;\r\n\r\nIngredi&euml;nten - PAPRIKA CHIPS: aardappelen, plantaardige oli&euml;n (zonnebloem, koolzaad, ma&iuml;s, in wisselende hoeveelheden), paprikasmaak [suiker, zout, paneermeel (van TARWE), paprika, MELKWEI-permeaat, uienpoeder, kaliumchloride, aroma&#39;s, knoflookpoeder, johannesbroodpitmeel, kleurstof (paprika-extract), rookaroma&#39;s, voedingszuur (citroenzuur en appelzuur)]; NATUREL CHIPS: aardappelen, plantaardige oli&euml;n (zonnebloem, koolzaad, ma&iuml;s, in wisselende hoeveelheden), zout.; BOLOGNESE CHIPS: aardappelen, plantaardige oli&euml;n (zonnebloem, koolzaad, ma&iuml;s, in wisselende hoeveelheden), bolognesesaussmaak [weipoeder (van melk), aroma&#39;s (bevat paprikapoeder, peterselie, uipoeder, zwarte peper, chillipeper en tomaten), suiker, kaliumchloride, zuurteregelaar (citroenzuur), rookaroma&#39;s], zout.; BARBECUE HAM CHIPS: aardappelen, plantaardige oli&euml;n (zonnebloem, koolzaad, ma&iuml;s, in wisselende hoeveelheden), barbecue hamsmaak [suiker, aroma&rsquo;s (bevat MELKCOMPONENTEN, uipoeder, peterselie, paprika-extract), kaliumchloride, zuurteregelaars (citroenzuur, natriumacetaten), weipoeder (van MELK), kleurstof (paprika-extract), rookaroma&rsquo;s], zout.; CHEESE ONION CHIPS: aardappelen, plantaardige oli&euml;n (zonnebloem, koolzaad, ma&iuml;s, in wisselende hoeveelheden), kaas- en uismaak [weipermeaat (van MELK), zout, suiker, aroma (bevat MELK), rijstebloem, uienpoeder, zuurteregelaars (citroenzuur, appelzuur), weiprote&iuml;ne (van MELK), knoflookpoeder, Cheddar kaaspoeder (van MELK), kleurstoffen (annatto bixin, paprika extract), maltodextrine, weipoeder (van MELK), magere MELKpoeder]. &amp; PATATJE JOPPIE CHIPS: aardappelen, plantaardige oli&euml;n (zonnebloem, koolzaad, ma&iuml;s, in wisselende hoeveelheden), patatje Joppiesmaak [aroma&#39;s (bevat BOTERVET, SELDERIJ- en MOSTERD extract), suiker, ui, paprika, knoflook, kaliumchloride, specerijen en kruiden, kaneel], zout.\r\n\r\n&nbsp;\r\n\r\nAanwijzingen\r\n\r\nIdeaal tijdens het aperitief of als snack\r\n\r\n&nbsp;\r\n', '26599.jpg', '9', '4', 'lay\'s-multibox-chips--6-x-225-g', '2022-03-05 16:43:15'),
(6, 'Harry Potter Schokofrosch Snoep standaard zie omschrijving Fan merch, Film', '\r\n	\r\n		\r\n			Merk\r\n			HARRY POTTER\r\n		\r\n		\r\n			Aantal items\r\n			1\r\n		\r\n		\r\n			Aantal exemplaren\r\n			15 gram\r\n		\r\n		\r\n			Gewicht\r\n			0.02 Kilogram\r\n		\r\n		\r\n			Gewicht van pakket\r\n			0.02 Kilogram\r\n		\r\n	\r\n\r\n', '341350.jpg', '4', '5', 'harry-potter-schokofrosch-snoep-standaard-zie-omschrijving-fan-merch--film', '2022-03-05 16:45:22'),
(7, 'Valentus Europa Cocoa- 24 saicÃ­nÃ­', 'Over dit item\r\n\r\n\r\n	Europa Cocoa is een heerlijke chocolademelk op basis van Belgische chocolade. Het is een voedingssupplement met essenti&euml;le voedingsstoffen voor gebruik in een dieet voor gewichtscontrole. Deze ingredi&euml;nten werken samen en vullen elkaar aan om je te helpen je eetlust te controleren.\r\n\r\n\r\nProductbeschrijving\r\n\r\nDeze luxe cacaodrank is heerlijk en effectief, ontwikkeld om je stofwisseling te bevorderen. Het verhoogt ook je energieniveau de hele dag en bestaat uit 100% natuurlijke ingredi&euml;nten. Aanbevolen dagelijkse dosis: 1 zak in een kopje met heet water mengen, 1 x dagelijks (30 minuten tot 90 minuten wachten om levensmiddelen te eten. Je kunt met groentedrank (soja, amandel, rijst) mengen. 6 dagen achter elkaar en 1 dag laten rusten.\r\n', '580926.jpg', '4', '5', 'valentus-europa-cocoa--24-saicã­nã­', '2022-03-05 16:46:41'),
(8, 'Manette Sans Fil Dualsense â€“ Cosmic Red', '\r\n	DualSense gamepad voor PS5, draadloos, voor een intensievere en innovatieve gaming-reis, compatibel met pc via USB-kabel\r\n	Eigenschappen: Luidspreker en microfoon, ING, hoofdtelefoonaansluiting, 6-assige bewegingstectie, USB-C-poort, terugkeer\r\n	Create-technologie: Productie en delen van olydische inhoud met andere spelers, adaptieve picks voor een exp immersieve prikkel\r\n	ING oplaadbare batterij, speel- en oplaadfunctie van de batterij simuleert\r\n	Omvang levering: 1 x Sony DualSense Wireless Controller voor PS5, oplaadbare batterij, C oplaadkabel USB C niet inbegrepen, handleiding in Cosmic Red\r\n\r\n', '689748.jpg', '70', '2', 'manette-sans-fil-dualsense-â€“-cosmic-red', '2022-03-05 16:49:13'),
(9, 'Trust Gaming Headset met Microfoon voor PS4, PS5, PC, Xbox Series X, Nintendo Switch, Xbox One GXT 310 Radius - Verstelbare Microfoon en Hoofdband, 1m Kabel - Zwart', 'Trust Gaming Headset met Microfoon voor PS4, PS5, PC, Xbox Series X, Nintendo Switch, Xbox One GXT 310 Radius - Verstelbare Microfoon en Hoofdband, 1m Kabel - Zwart\r\n\r\n\r\n	\r\n		\r\n			Merk\r\n			Trust Gaming\r\n		\r\n		\r\n			Kleur\r\n			Zwart\r\n		\r\n		\r\n			Aansluitingstechnologie\r\n			Kabel\r\n		\r\n		\r\n			Serie\r\n			Trust Gaming GXT 310 Radius Gaming Headset - Zwart\r\n		\r\n		\r\n			Vormfactor\r\n			Over het oor\r\n		\r\n		\r\n			Koptelefoonaansluiting\r\n			3,5 mm Jack\r\n		\r\n		\r\n			Gewicht van item\r\n			322 Gram\r\n		\r\n		\r\n			Type controle\r\n			Volumeregeling\r\n		\r\n		\r\n			Aanbevolen toepassingen voor product\r\n			Gaming\r\n		\r\n		\r\n			Speciale kenmerken\r\n			\r\n			Volumeregeling\r\n\r\n			&nbsp;\r\n			\r\n		\r\n	\r\n\r\n\r\n&nbsp;\r\n\r\nOver dit item\r\n\r\n\r\n	Gaming headset voor de PS4, PS5, PC, Xbox Series X (S), Xbox One en Nintendo Switch met een krachtig geluid\r\n	Zachte en comfortabele On-ear pads\r\n	Verstelbare microfoon en hoofdband\r\n	In-line afstandsbediening met volumeregeling en dempen van microfoon\r\n	Vaste kabel van 1 m en verlengkabel van 50 cm voor console adapterkabel van 1 m voor pc/laptop\r\n\r\n', '964552.jpg', '12', '2', 'trust-gaming-headset-met-microfoon-voor-ps4--ps5--pc--xbox-series-x--nintendo-switch--xbox-one-gxt-310-radius---verstelbare-microfoon-en-hoofdband--1m-kabel---zwart', '2022-03-05 16:51:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `mobile`, `password`, `role`, `created`) VALUES
(1, 'arthus admin', 'admin@gmail.com', '04895321', '$2y$10$C0wH6KDUr/bocnsMqgFhyu/UNFuKcMj3QEXBF7K/jsYY2naghROy.', 'admin', '2022-03-05 11:29:46'),
(2, 'avocette', 'avocette@gmail.com', '023659874', '$2y$10$xpggcDxIrWQN2EENMSFwEOtBn2F3jH6aD8MR4LdIwAdnXIzM8o1bm', 'customer', '2022-03-05 11:41:32'),
(3, 'test1', 'test1@gmail.com', '0569874', '$2y$10$ec479NKA2aoKL1Ukac4mq.lCtpzbXG2vjDdPplcfUT.jvWg34gjlu', 'customer', '2022-03-06 18:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE IF NOT EXISTS `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `nickname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `werking`
--

DROP TABLE IF EXISTS `werking`;
CREATE TABLE IF NOT EXISTS `werking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(259) NOT NULL,
  `description` text NOT NULL,
  `pic` varchar(259) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `werking`
--

INSERT INTO `werking` (`id`, `title`, `description`, `pic`, `created`) VALUES
(1, 'AANVRAAG VAN DE BEGELEIDING', 'De ouder, leerling, zorgco&ouml;rdinator, leerlingenbegeleider, CLB-medewerker, directie, arts kan een aanvraag tot begeleiding indienen. Dit kan voor elke zieke leerling die\r\n\r\n\r\n	ingeschreven is in een Vlaamse erkende school &eacute;n\r\n	over een medisch afwezigheidsattest beschikt (= doktersbriefje).\r\n\r\n\r\nDe aanvraag wordt ingediend via de contactgegevens van de provincie waar de leerling woont.\r\n', '620175.jpg', '2022-03-06 12:49:15'),
(2, 'HET VERLOOP VAN DE BEGELEIDING', '\r\n	De dossierverantwoordelijke van S&amp;Z komt op huisbezoek voor een eerste kennismaking en licht de werking toe.\r\n	Samen met de school en de ouders wordt bepaald voor welke vakken S&amp;Z de begeleiding zal opstarten.\r\n	De dossierverantwoordelijke zoekt op basis van de verzamelde gegevens naar de meest geschikte vrijwilliger.\r\n	De vrijwilliger contacteert de ouders van het zieke kind en de vakleerkracht van de school. In onderling overleg spreken vrijwilliger en familie af wanneer de lessen kunnen plaats vinden.\r\n	De school wordt gevraagd om het lesmateriaal ter beschikking te stellen. De ouders zorgen dat nota&rsquo;s, cursussen en handboeken thuis zijn bij de opstart van de lessen.\r\n	De familie zorgt voor de aanwezigheid van een volwassene in huis tijdens de lessen.\r\n	De familie kan steeds terecht bij de dossierverantwoordelijke met vragen en opmerkingen.\r\n\r\n', '987729.jpg', '2022-03-06 12:50:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
