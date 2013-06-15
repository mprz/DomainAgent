<?php
error_reporting(E_ALL);
ini_set('display_errors', true);
define ("DB_HOST", "localhost");
define ("DB_USER", "root");
define ("DB_PASS", "mysql");
define ("DB_NAME", "dagent");

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

require_once __DIR__.'/functions.inc.php';
require_once __DIR__.'/classes/common.php';
require_once __DIR__.'/classes/db.php';
require_once __DIR__.'/classes/domains.php';
require_once __DIR__.'/classes/registrars.php';

