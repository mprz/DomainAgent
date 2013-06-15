<?php
require_once ('../includes/config.php');

try {

    $db = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS );

    $what='Creating table `registrars`';
    $query=$db->prepare("CREATE TABLE IF NOT EXISTS `registrars` (
      `reg_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Registrar ID',
      `reg_name` varchar(255) NOT NULL COMMENT 'Registrar name',
      `reg_link` varchar(255) NOT NULL COMMENT 'Registrar link',
      `reg_comment` text NOT NULL,
      `reg_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      PRIMARY KEY (`reg_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
    $query->execute();

    $what='Creating table `domains`';
    $query=$db->prepare("CREATE TABLE IF NOT EXISTS `domains` (
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
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;");
    $query->execute();

    $what='Creating table `users`';
    $query=$db->prepare("CREATE TABLE IF NOT EXISTS `users` (
      `user_id` int(10) NOT NULL AUTO_INCREMENT,
      `user_name` varchar(50) NOT NULL,
      `user_pass` varchar(50) NOT NULL,
      PRIMARY KEY (`user_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;");
    $query->execute();

    $what='Populating table `registrars`';
    $query=$db->prepare("INSERT INTO `registrars` (`reg_id`, `reg_name`, `reg_link`, `reg_comment`, `reg_modified`) VALUES
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
        (22, 'Domain.com', 'domain.com', '', '0000-00-00 00:00:00');");
    $query->execute();
    echo 'Installation completed. Please delete folder /install and its content';
}
catch (PDOException $e)
{
    echo 'Error during installation process. Check /include/config.php: '.$what;
    die();
}