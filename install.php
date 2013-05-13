<?php

require_once 'includes/config.php';

try {
    $conn = new PDO('mysql:host='.$DB_SERVER.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    echo $conn->errorCode();
    echo $conn->errorInfo();
    die();
}    

$domains    = $DB_PREFIX . $DB_DOM;
$registrars = $DB_PREFIX . $DB_REG;
$details    = $DB_PREFIX . $DB_DET;

echo 'Creating table: '.$domains;
$query = "CREATE TABLE IF NOT EXISTS `".$domains."` (
  `DomainID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DomainName` varchar(50) NOT NULL COMMENT 'domain name',
  `RegID` int(1) unsigned NOT NULL COMMENT 'domain registrar',
  `RegDate` date NOT NULL COMMENT 'when registered',
  `RenewalDate` date NOT NULL COMMENT 'renewal date',
  PRIMARY KEY (`DomainID`)
);";
$conn->exec($query);
        
echo 'Creating table: '.$registrars;
$query = "CREATE TABLE IF NOT EXISTS `".$registrars."` (
  `RegID` int(1) NOT NULL AUTO_INCREMENT,
  `RegName` varchar(100) NOT NULL,
  `RegLink` varchar(100) NOT NULL,
  `RegComment` varchar(500) NOT NULL,
  PRIMARY KEY (`RegID`)
);";
$conn->exec($query);

echo 'Inserting sample data.';
$query = "INSERT INTO `".$registrars."` (`RegName`, `RegLink`, `RegComment`) VALUES ('NameCheap', 'namecheap.com', 'sample registrar');";
$conn->exec($query);
echo 'Tables created.';

?>