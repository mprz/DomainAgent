<?php require_once ("includes/database.php"); ?>
<?php require_once ("includes/functions.php"); ?>

    <?php 
$result = mysql_query("SELECT COUNT(1) FROM Registrars", $connection);
if (!result) {
        die("Query failed");
}
$count = mysql_result($result, 0);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registrars</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
        <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap.css">
        <link rel="stylesheet" href="https://app.divshot.com/css/bootstrap-responsive.css">
        <script src="https://app.divshot.com/js/jquery.min.js"></script>
        <script src="https://app.divshot.com/js/bootstrap.min.js"></script>
</head>
<body>
    
<?php require_once("includes/menu.php"); ?>
<div class="container">
    <div class="page-header">
        <h1>Remove domain</h1>
    </div>
    <p class="lead">You are about to remove a domain. Please make sure you keep backups to prevent losing any important data.</p>
    <hr>

<?php
    $id = $_GET["id"];
echo '    <div class="alert">';
echo '        <strong>Warning!</strong> wrong or unknown domain id.';
echo '    </div>';
?>
    
    <hr>
<?php require_once ("includes/footer.php"); ?>
</div>    
</body>

</html>
<?php mysql_close($connection); ?>