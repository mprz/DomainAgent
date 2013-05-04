<?php
// only change the 4 lines below
$DB_SERVER  = 'localhost';
$DB_USER    = 'root';
$DB_PASS    = 'mysql';
$DB_NAME    = "dom";

// do NOT change anything below this line
$connection = mysql_connect($DB_SERVER, $DB_USER, $DB_PASS);
if (!$connection) {
        echo 'Make sure you filled out all the required info in INCLUDES/database.php';
	die("Database connection failed: " . mysql_error());
}
$db_select = mysql_select_db($DB_NAME, $connection);
if (!$db_select) {
        echo 'Run install.php first!';
	die("Database selection failed: " . mysql_error());
}
?>