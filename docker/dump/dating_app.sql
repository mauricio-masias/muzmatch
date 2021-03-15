# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.5.9-MariaDB-1:10.5.9+maria~focal)
# Database: dating_app
# Generation Time: 2021-03-15 20:09:19 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table gallery
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `gallery_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;

INSERT INTO `gallery` (`id`, `user_id`, `photo`, `created_at`, `updated_at`)
VALUES
	(1,1,'http://localhost:8080/27dcea61d4682620b9302d58.jpg','2021-03-15 17:43:27','2021-03-15 17:43:27'),
	(2,1,'http://localhost:8080/44b1257b4d17f5e34dff5151.jpg','2021-03-15 19:14:57','2021-03-15 19:14:57'),
	(3,1,'http://localhost:8080/690d1e9093687ed67ab60bce.jpg','2021-03-15 19:15:00','2021-03-15 19:15:00');

/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pair
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pair`;

CREATE TABLE `pair` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `match_user_id` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `match_user_id` (`match_user_id`),
  CONSTRAINT `pair_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `pair_ibfk_2` FOREIGN KEY (`match_user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `pair` WRITE;
/*!40000 ALTER TABLE `pair` DISABLE KEYS */;

INSERT INTO `pair` (`id`, `user_id`, `match_user_id`, `status`, `created_at`, `updated_at`)
VALUES
	(1,1,2,1,'2021-03-15 17:50:52','2021-03-15 17:50:52'),
	(2,1,4,1,'2021-03-15 17:51:52','2021-03-15 17:51:52');

/*!40000 ALTER TABLE `pair` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table profile
# ------------------------------------------------------------

DROP TABLE IF EXISTS `profile`;

CREATE TABLE `profile` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `gender` varchar(10) NOT NULL DEFAULT '',
  `age` tinyint(3) NOT NULL,
  `location` varchar(100) NOT NULL,
  `attraction` tinyint(2) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `dislikes` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;

INSERT INTO `profile` (`id`, `user_id`, `gender`, `age`, `location`, `attraction`, `likes`, `dislikes`, `created_at`, `updated_at`)
VALUES
	(1,1,'Male',30,'London',50,0,0,NULL,'2021-03-15 14:24:11'),
	(2,2,'Female',62,'Derby',51,1,0,'2021-03-15 17:42:16','2021-03-15 17:50:52'),
	(3,3,'Male',61,'Gloucester',50,0,0,'2021-03-15 17:42:18','2021-03-15 17:42:18'),
	(4,4,'Female',61,'Brighton & Hove',51,1,0,'2021-03-15 17:42:19','2021-03-15 17:51:52'),
	(5,5,'Male',23,'Lichfield',50,0,0,'2021-03-15 17:42:20','2021-03-15 17:42:20'),
	(6,6,'Female',57,'Ely',50,0,0,'2021-03-15 17:42:21','2021-03-15 17:42:21'),
	(7,7,'Female',37,'Coventry',50,0,0,'2021-03-15 17:42:22','2021-03-15 17:42:22'),
	(8,8,'Male',51,'Leeds',50,0,0,'2021-03-15 17:42:22','2021-03-15 17:42:22'),
	(9,9,'Male',23,'Wolverhampton',50,0,0,'2021-03-15 17:42:23','2021-03-15 17:42:23'),
	(10,10,'Male',38,'London',50,0,0,'2021-03-15 17:42:24','2021-03-15 17:42:24'),
	(11,11,'Male',61,'Bristol',50,0,0,'2021-03-15 17:42:25','2021-03-15 17:42:25');

/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `lname` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `name`, `lname`, `email`, `password`, `active`, `created_at`, `updated_at`)
VALUES
	(1,'Mauricio','Masias','mauricio@masias.co.uk','$2y$10$Zh6FCJsp2Et31jTbifmrsO7W3KQqNpm1kP/Ld/bG10LtH8kDO37O6',1,'2021-03-13 21:45:29',NULL),
	(2,'Sophie','Walls','sophie.walls@test.co.uk','$2y$10$dQW3HCZ5Gmto05kJOu.xX.sZJqikGnsq2iHobycDdHkgTbJLQnXl.',1,'2021-03-15 17:42:16','2021-03-15 17:42:16'),
	(3,'Isaiah','Santiago','isaiah.santiago@test.co.uk','$2y$10$2QKPj9KoxBYSotz1mE5qE.w1lXOHouwT5iOlrFjtSiUIo5neflkUi',1,'2021-03-15 17:42:18','2021-03-15 17:42:18'),
	(4,'Zoey','Leon','zoey.leon@test.co.uk','$2y$10$xCMwwF3P5NOUFtXfSjF6ou2TSv4tH4F1zQTNJV.bWs0EHChR49co6',1,'2021-03-15 17:42:19','2021-03-15 17:42:19'),
	(5,'Caleb','Stout','caleb.stout@test.co.uk','$2y$10$D9EUZoQF1cEI3sazof30w.A3ahGeUxkER/34UsZWtoiEaHCD6hK5K',1,'2021-03-15 17:42:20','2021-03-15 17:42:20'),
	(6,'Nora','Rhodes','nora.rhodes@test.co.uk','$2y$10$EcbkpojovK4vJD7v2d58L.qslso8TjHlImLJwpJNEqTK7bfAfp2S2',1,'2021-03-15 17:42:21','2021-03-15 17:42:21'),
	(7,'Layla','Beck','layla.beck@test.co.uk','$2y$10$WePbzXqj9b9E6IwagYBm1u79Bh8RLVu8Txey/eVf.nGaKs5WzBL6S',1,'2021-03-15 17:42:22','2021-03-15 17:42:22'),
	(8,'Parker','Stout','parker.stout@test.co.uk','$2y$10$5EbIvWquMijF4dFa66n4AeYg1rLlNY4H54.geZf6iOARn2UzVViq6',1,'2021-03-15 17:42:22','2021-03-15 17:42:22'),
	(9,'Dylan','Tate','dylan.tate@test.co.uk','$2y$10$lml8vWkaYjBYs51ZU9fNvOCjqOZ6ongskCfGAGRkTyIBwkoAeZE76',1,'2021-03-15 17:42:23','2021-03-15 17:42:23'),
	(10,'Jackson','Krueger','jackson.krueger@test.co.uk','$2y$10$RZD44BYRMEBw9yDt.XJ3uO45CsXu4225FOh3N9ZRUaCdJrFeciEPi',1,'2021-03-15 17:42:24','2021-03-15 17:42:24'),
	(11,'Cooper','Odom','cooper.odom@test.co.uk','$2y$10$3HpRcqeYsSh9WPMOmSXkkeO/UkRp7xfVp1YzEtyHLXrimcz/TWNbi',1,'2021-03-15 17:42:25','2021-03-15 17:42:25');

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
