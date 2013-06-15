-- --------------------------------------------------------
-- Host:                         10.0.0.10
-- Server version:               5.5.31-0+wheezy1 - (Debian)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             8.0.0.4396
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table dagent.domains
CREATE TABLE IF NOT EXISTS `domains` (
  `dom_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Domain id',
  `dom_name` varchar(255) NOT NULL COMMENT 'Domain name',
  `dom_reg_id` int(11) unsigned NOT NULL COMMENT 'Registrar ID',
  `dom_reg_date` date NOT NULL COMMENT 'Date of registration',
  `dom_exp_date` date NOT NULL COMMENT 'Date of expiration',
  `dom_comment` text NOT NULL COMMENT 'Comment',
  `dom_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Last modified',
  `dom_status` int(11) unsigned NOT NULL,
  PRIMARY KEY (`dom_id`),
  KEY `dom_reg_id` (`dom_reg_id`),
  CONSTRAINT `domains_ibfk_1` FOREIGN KEY (`dom_reg_id`) REFERENCES `registrars` (`reg_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table dagent.domains: ~13 rows (approximately)
/*!40000 ALTER TABLE `domains` DISABLE KEYS */;
INSERT INTO `domains` (`dom_id`, `dom_name`, `dom_reg_id`, `dom_reg_date`, `dom_exp_date`, `dom_comment`, `dom_modified`, `dom_status`) VALUES
	(1, 'google.com', 5, '2013-06-01', '2014-06-01', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2013-06-01 01:40:10', 0),
	(2, 'yahoo.com', 2, '2013-06-01', '2013-06-01', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2013-06-01 01:40:31', 0),
	(4, 'wordpress.com', 4, '2012-06-01', '2015-06-01', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '2013-06-01 01:41:20', 0),
	(5, 'lowendtalk.com', 5, '2012-06-01', '2016-06-01', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2013-06-01 01:41:44', 0),
	(6, 'vpsboard.com', 6, '2010-10-04', '2013-10-10', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2013-06-01 01:41:56', 0),
	(7, 'twitter.com', 1, '2010-03-01', '2014-03-01', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2013-06-01 01:42:51', 0),
	(8, 'facebook.com', 19, '2012-05-01', '2013-07-11', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', '2013-06-01 01:43:08', 0),
	(9, 'webhostingtalk.com', 3, '2013-06-01', '2014-06-01', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2013-06-01 01:43:25', 0),
	(10, 'buyvm.com', 4, '2013-06-01', '2014-06-01', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2013-06-01 01:43:37', 0),
	(11, 'ramnode.com', 5, '2013-06-01', '2014-06-01', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2013-06-01 01:43:46', 0),
	(12, 'digitalocean.com', 6, '2013-06-01', '2015-06-01', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.', '2013-06-01 01:44:10', 0),
	(13, 'lowendbox.com', 4, '2013-06-01', '2014-06-01', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.', '2013-06-01 01:44:37', 0),
	(14, 'envato.com', 2, '2013-06-01', '2014-06-01', 'All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', '2013-06-01 01:44:59', 0);
/*!40000 ALTER TABLE `domains` ENABLE KEYS */;


-- Dumping structure for table dagent.registrars
CREATE TABLE IF NOT EXISTS `registrars` (
  `reg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Registrar ID',
  `reg_name` varchar(255) NOT NULL COMMENT 'Registrar name',
  `reg_link` varchar(255) NOT NULL COMMENT 'Registrar link',
  `reg_comment` text NOT NULL,
  `reg_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table dagent.registrars: ~22 rows (approximately)
/*!40000 ALTER TABLE `registrars` DISABLE KEYS */;
INSERT INTO `registrars` (`reg_id`, `reg_name`, `reg_link`, `reg_comment`, `reg_modified`) VALUES
	(1, 'NameCheap', 'namecheap.com', '', '0000-00-00 00:00:00'),
	(2, 'InternetBS', 'internetbs.net', '', '0000-00-00 00:00:00'),
	(3, 'MediaTemple', 'mediatemple.net', '', '0000-00-00 00:00:00'),
	(4, 'CrazyDomains.com', 'crazydomains.com', '', '0000-00-00 00:00:00'),
	(5, 'GoDaddy', 'godaddy.com', '', '0000-00-00 00:00:00'),
	(6, 'NameSilo', 'namesilo.com', '', '0000-00-00 00:00:00'),
	(7, 'Gandi', 'gandi.net', '', '0000-00-00 00:00:00'),
	(8, 'Name.com', 'name.com', '', '0000-00-00 00:00:00'),
	(9, 'Moniker', 'moniker.com', '', '0000-00-00 00:00:00'),
	(10, 'Dynadot', 'dynadot.com', '', '0000-00-00 00:00:00'),
	(11, 'Netim', 'netim.com', '', '0000-00-00 00:00:00'),
	(12, 'Joker', 'joker.com', '', '0000-00-00 00:00:00'),
	(13, 'INWX.de', 'inwx.de', '', '0000-00-00 00:00:00'),
	(14, 'Enom', 'enom.com', '', '0000-00-00 00:00:00'),
	(15, 'Dotster', 'dotster.com', '', '0000-00-00 00:00:00'),
	(16, 'Hover.com', 'hover.com', '', '0000-00-00 00:00:00'),
	(17, '1and1.com', '1and1.com', '', '0000-00-00 00:00:00'),
	(18, 'OVH', 'ovh.com', '', '0000-00-00 00:00:00'),
	(19, 'DomainMonster', 'domainmonster.com', '', '0000-00-00 00:00:00'),
	(20, 'ResellerClub', 'resellerclub.com', '', '0000-00-00 00:00:00'),
	(21, 'Register.com', 'register.com', '', '0000-00-00 00:00:00'),
	(22, 'Domain.com', 'domain.com', '', '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `registrars` ENABLE KEYS */;


-- Dumping structure for table dagent.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table dagent.users: ~1 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`user_id`, `user_name`, `user_pass`) VALUES
	(1, 'admin', 'pass');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
