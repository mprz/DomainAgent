<?php
session_start();
require_once 'database.php';

$action = $_GET['action'];
$id = $_GET['id'];
    
function box($boxTitle, $boxText, $boxType) {
    echo '  <div class="alert alert-'.$boxType.'">';
    echo '      <h4>' . $boxTitle . '</h4>' . $boxText;
    echo '  </div>';
}

function head() {
echo '
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.css">
        <link rel="stylesheet" href="css/datepicker.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
';
}

function foot() {
echo '
    <p>Visit dAgent on <a href="https://github.com/mprz/dAgent">Github</a></p>';
}

// do NOT change anything below this line
$connection = mysql_connect($DB_SERVER, $DB_USER, $DB_PASS);
    if (!$connection) {
        errorBox('Error', 'Error connecting to MySQL database: ' ,'error');
        die(mysql_error());
    }
    
$db_select = mysql_select_db($DB_NAME, $connection);
    if (!$db_select) {
        errorBox('Error', 'Run <strong>install.php<strong> first, error accessing database: ', 'error');
        die(mysql_error());
    }

?>