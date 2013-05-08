<?php require_once ("includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>dAgent - Domains</title><?php head(); ?>
</head>
<body>
    
<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="brand" href="index.php">dAgent</a>
      <div class="nav-collapse collapse">
        <ul class="nav">
          <li class="active">
            <a href="index.php">Domains</a> 
          </li>
          <li>
            <a href="registrars.php">Registrars</a> 
          </li>
          <li>
            <a href="about.php">About</a> 
          </li>    
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="page-header">
        <h1>My Domains</h1>
    </div>
    <p class="lead">This is the list of all domains in the database. From here you can navigate
      to retrieve more details, edit your domains, manage your domain registrars
      and configure app settings.</p>
    <hr>
<?php
    if ($action==='remove') {
            $queryRemove = "DELETE FROM `domains` WHERE `DomainID`=" . $id;
            $resultRemove = mysql_query($queryRemove);    
            box('Success', 'The domain has been removed.', 'info' );
    }
    elseif ($action === 'add') 
    {
        $dName = mysql_real_escape_string(htmlentities($_POST['dname']));
        $dReg = mysql_real_escape_string(htmlentities($_POST['dreg']));
        $dDate = mysql_real_escape_string(htmlentities($_POST['ddate']));
        if ($dName=='' || $dReg=='' || $dDate=='')
        {
            if ($dName=='') $t1='<li>Domain name</li>'; else $t1=''; 
            if ($dReg=='') $t2='<li>Registrar</li>'; else $t2='';
            if ($dDate=='') $t3='<li>Registration date</li>'; else $t3='';
            box("Error", 'Error adding a new domain, you are missing the following:' . '<ul>' .  $t1 .  $t2 .  $t3 . '</ul>', 'error');
        }
        else
        {
            $queryInsert = "INSERT INTO `domains` (`DomainName`, `RegID`, `RegDate`) VALUES ('{$dName}', '{$dReg}', '{$dDate}');";
            $resultInsert = mysql_query($queryInsert);
            box("Success", 'Domain '.$dName.' has been added.', 'success');
        }
    }    
    
    $result = mysql_query("SELECT COUNT(1) FROM Domains", $connection);
    if (!result) {
            die("Query failed");
    }
    $count = mysql_result($result, 0);
?>    
    <div class="tabbable">
        <ul class="nav nav-tabs">
           <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-list"></i> My domains <span class="badge badge-info"><?php echo $count; ?></span></a></li>
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
                        $result = mysql_query("SELECT DomainID, DomainName, RegID, RenewalDate FROM Domains ORDER BY DomainName", $connection);
                        if (!result) {
                                die("Query failed");
                        }
                        while ($row = mysql_fetch_array($result)) {
                            echo '  <tr>';
                            echo '      <td>' . $row["DomainName"] . '  <a href="http://' . $row["DomainName"] . '" target="_blank"><i class="icon-globe"></i></a></td>';
                            
                            $result2 = mysql_query("SELECT RegName FROM Registrars WHERE `RegID`=". $row["RegID"], $connection);
                            if (!result2) {
                                    die("Query failed");
                            }                            
                            $regName = mysql_result($result2, 0);
                            
                            echo '      <td><a href="registrars.php?action=edit&id=' . $row["RegID"] . '">'.$regName.'</td>';
                            echo '      <td>' . $row["RenewalDate"] . '</td>';
                            echo '      <td><div class="btn-group"><a class="btn" href="index.php?action=edit&id='. $row["DomainID"] .'" alt="Edit"><i class="icon-pencil"></i></a><a class="btn" href="index.php?action=remove&id='. $row["DomainID"] .'" alt="Remove"><i class="icon-remove-circle"></i></a></div></td>';
                            echo '  </tr>';
                        }
                        ?>          
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab2">
                <form action="index.php?action=add" method="post">
                    <label>Domain name</label>
                    <input type="text" class="input-medium" name="dname">
                    <label>Registrar</label>
                    <input type="text" class="input-medium" name="dreg">
                    <label>Renewal date</label>
                    <input type="text" class="input-medium" name="ddate">
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary"><i class="icon-plus"></i> Add domain</button>
                      <input type="reset" class="btn" value="Reset"> 
                    </div>                    
                </form>          
            </div>
        </div>
    </div>
    <hr>
<?php foot() ?>
</div>    
</body>
</html>
<?php mysql_close($connection); ?>