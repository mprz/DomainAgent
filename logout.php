<?php
require_once (__DIR__.'/includes/config.inc.php');

// We remove the user's data from the session
unset($_SESSION['user']);

// We redirect them to the login page
header("Location: login.php");
die("Redirecting to: login.php");