<?php require_once ("includes/database.php"); ?>
<?php

$query1 = "CREATE TABLE IF NOT EXISTS `domains` (
  `DomainID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DomainName` varchar(50) NOT NULL COMMENT 'domain name',
  `RegID` int(1) unsigned NOT NULL COMMENT 'domain registrar',
  `RegDate` date NOT NULL COMMENT 'when registered',
  `RenewalDate` date NOT NULL COMMENT 'renewal date',
  PRIMARY KEY (`DomainID`)
);";
$result1 = mysql_query($query1);

$query2 = "CREATE TABLE IF NOT EXISTS `registrars` (
  `RegID` int(1) NOT NULL AUTO_INCREMENT,
  `RegName` varchar(100) NOT NULL,
  `RegLink` varchar(100) NOT NULL,
  `RegComment` varchar(500) NOT NULL,
  PRIMARY KEY (`RegID`)
);";
$result2 = mysql_query($query2);

echo 'Tables created.';

?>