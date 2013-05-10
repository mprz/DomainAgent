<?php

require_once 'includes/database.php';

$connection = mysql_connect($DB_SERVER, $DB_USER, $DB_PASS);
    if (!$connection) {
        echo 'Connection error';
        die(mysql_error());
    }

$db_select = mysql_select_db($DB_NAME, $connection);
if (!$db_select) {
    echo 'Database select error';
    die(mysql_error());
}

$query1 = "CREATE TABLE IF NOT EXISTS `domains` (
  `DomainID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DomainName` varchar(50) NOT NULL COMMENT 'domain name',
  `RegID` int(1) unsigned NOT NULL COMMENT 'domain registrar',
  `RegDate` date NOT NULL COMMENT 'when registered',
  `RenewalDate` date NOT NULL COMMENT 'renewal date',
  PRIMARY KEY (`DomainID`)
);";
$result1 = mysql_query($query1);
if (!$result1) {
    echo 'Table creation error (1)';
    die(mysql_error());
}

$query2 = "CREATE TABLE IF NOT EXISTS `registrars` (
  `RegID` int(1) NOT NULL AUTO_INCREMENT,
  `RegName` varchar(100) NOT NULL,
  `RegLink` varchar(100) NOT NULL,
  `RegComment` varchar(500) NOT NULL,
  PRIMARY KEY (`RegID`)
);";
$result2 = mysql_query($query2);
if (!$result2) {
    echo 'Table creation error (2)';
    die(mysql_error());
}

$query3 = "INSERT INTO `registrars` (`RegName`, `RegLink`, `RegComment`) VALUES ('NameCheap', 'namecheap.com', 'sample registrar');";
$result3 = mysql_query($query3);
if (!$result3) {
    echo 'Sample registrar not inserted!';
    die(mysql_error());
}       
echo 'Tables created.';

?>