<?php
require_once 'config.php';

// allow letters and numbers
$action = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['action']); 
// allow only numbers for id
$id = preg_replace("/[^0-9]/","", $_GET['id']);     

// draws box using Bootstrap classes
// $boxType:
// - info
// - error
// - success
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

// use PDO instead mysql_connect() to connect to MySQL database
try {
    $conn = new PDO('mysql:host='.$DB_SERVER.';dbname='.$DB_NAME, $DB_USER, $DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
    echo $conn->errorCode();
    echo $conn->errorInfo();
    die();
}    