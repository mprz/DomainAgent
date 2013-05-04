<?php require_once ("includes/database.php"); ?>
<?php require_once ("includes/functions.php"); ?>
<?php
    $action = $_GET['action'];
    $id = $_GET['id'];
?>
<?php 
$result = mysql_query("SELECT COUNT(1) FROM Domains", $connection);
if (!result) {
        die("Query failed");
}
$count = mysql_result($result, 0);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Domains</title>
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
        <h1>My Domains</h1>
    </div>
    <p class="lead">This is the list of all domains in the database. From here you can navigate
      to retrieve more details, edit your domains, manage your domain registrars
      and configure app settings.</p>
    <hr>
    <div class="tabbable">
        <ul class="nav nav-tabs">
           <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-list"></i> My domains (<?php echo $count; ?>)</a></li>
           <li><a href="#tab2" data-toggle="tab"><i class="icon-plus"></i> Add new domain</a></li>
        </ul>    
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Domain name</th>
                        <th>Registrar</th>
                        <th>Renewal Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $result = mysql_query("SELECT DomainID, DomainName, RegID, RenewalDate FROM Domains", $connection);
                        if (!result) {
                                die("Query failed");
                        }
                        while ($row = mysql_fetch_array($result)) {
                            echo '  <tr>';
                            echo '      <td>' . $row["DomainName"] . '  <a href="http://' . $row["DomainName"] . '"><i class="icon-globe"></i></a></td>';
                            
                            $result2 = mysql_query("SELECT RegName FROM Registrars WHERE `RegID`=". $row["RegID"], $connection);
                            if (!result2) {
                                    die("Query failed");
                            }                            
                            $regName = mysql_result($result2, 0);
                            
                            echo '      <td><a href="registrars.php?action=edit&id=' . $row["RegID"] . '">'.$regName.'</td>';
                            echo '      <td>' . $row["RenewalDate"] . '</td>';
                            echo '      <td><div class="btn-group"><button class="btn"><a href="index.php?action=edit&id='. $row["DomainID"] .'" alt="Edit"><i class="icon-pencil"></i></a></button><button class="btn"><a href="index.php?action=remove&id='. $row["DomainID"] .'" alt="Remove"><i class="icon-remove-circle"></i></a></button></div></td>';
                            echo '  </tr>';
                        }
                        ?>          
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab2">
               
            </div>
        </div>
    </div>
    <hr>
<?php require_once ("includes/footer.php"); ?>
</div>    
</body>

</html>
<?php mysql_close($connection); ?>