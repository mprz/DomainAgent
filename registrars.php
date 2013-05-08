<?php require_once ("includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>dAgent - Registrars</title><?php head(); ?>
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
          <li>
            <a href="index.php">Domains</a> 
          </li>
          <li class="active">
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
        <h1>My Registrars</h1>
    </div>
    <p class="lead">This is the list of all registrars you have added to the application. You can add more or edit details of existing ones. You can also delete ones you don't need anymore, but only if they are not associated with any of your domains.</p>
    <hr>
<?php
    // adding a domain
    if ($action === 'add') 
    {
        $dName = mysql_real_escape_string(htmlentities($_POST['dname']));
        $dWebsite = mysql_real_escape_string(htmlentities($_POST['dwebsite']));
        $dComments = mysql_real_escape_string(htmlentities($_POST['dcomments']));
        if ($dName=='' || $dWebsite=='')
        {
echo '  <div class="alert alert-error">';
echo '      <h4>Error!</h4>Error adding a new registrar, you are missing the following:';
echo ($dName=='') ? '<br />- Name of the registrar' : '';
echo ($dWebsite=='') ? '<br />- Web address of the registrar' : '';
echo '  </div>';
        }
        else
        {
            $queryInsert = "INSERT INTO `registrars` (`RegName`, `RegLink`, `RegComment`) VALUES ('{$dName}', '{$dWebsite}', '{$dComments}');";
            $resultInsert = mysql_query($queryInsert);
            box('Success', 'The registrar has been added.', 'success');
        }
    }
    else if ($action === 'remove')
    {
            $queryRemove = "DELETE FROM `registrars` WHERE `RegID`=" . $id;
            $resultRemove = mysql_query($queryRemove);    
            box('Success', 'The registrar has been removed.', 'info');
    }
?>
<?php 
$resultCount = mysql_query("SELECT COUNT(1) FROM Registrars");
if (!resultCount) {
        die("Query failed");
}
$count = mysql_result($resultCount, 0);
?>
<?php
if ($action==='edit') {
    if ($id!=''){
        $resultEdit = mysql_query("SELECT RegID, RegName, RegLink, RegComment FROM Registrars WHERE RegID=".$id, $connection);
        if (!resultEdit) {
                die("Query failed");
        }
        while ($rowEdit = mysql_fetch_array($resultEdit)) {
            $dId = $rowEdit['RegID'];
            $dName = $rowEdit['RegName'];
            $dWebsite = $rowEdit['RegLink'];
            $dComments = $rowEdit['RegComment'];
        }
        echo '
    <form action="registrars.php?action=update" method="post">
        <label>Registrar ID</label>
        <input type="text" class="input-medium uneditable-input" name="did" value="'.$dId.'" readonly>
        <label>Registrar name</label>
        <input type="text" class="input-medium" name="dname" value="'.$dName.'">
        <label>Registrar website</label>
        <input type="text" class="input-medium" name="dwebsite" value="'.$dWebsite.'">
        <label>Comments</label>
        <textarea class="input-xxlarge" rows="5" name="dcomments">'.$dComments.'</textarea>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary"><i class="icon-edit"></i> Update registrar details</button>
          <input type="reset" class="btn" value="Reset"> 
        </div>                    
    </form>';
    }
    else {
            box('Success', 'The registrar details has been changed.', 'success');   
    }
} elseif ($action==='update') {
        $dId = mysql_real_escape_string(htmlentities($_POST['did']));
        $dName = mysql_real_escape_string(htmlentities($_POST['dname']));
        $dWebsite = mysql_real_escape_string(htmlentities($_POST['dwebsite']));
        $dComments = mysql_real_escape_string(htmlentities($_POST['dcomments']));
        if ($dName=='' || $dWebsite=='')
        {
            echo '  <div class="alert alert-error">';
            echo '      <h4>Error!</h4>Error updating registrar data, you have not entered the following:';
            echo ($dName=='') ? '<br />- Name of the registrar' : '';
            echo ($dWebsite=='') ? '<br />- Web address of the registrar' : '';
            echo '  </div>';    
         } else {
                $resultUpdate = mysql_query("UPDATE registrars SET RegName='".$dName."', RegLink='".$dWebsite."', RegComment='".$dComments."' WHERE RegID=".$dId, $connection);
                echo '  <div class="alert alert-success">';
                echo '      <h4>Success!</h4>The registrar information has been updated.';
                echo '  </div>';               
         }
}
?>
    <div class="tabbable">
        <ul class="nav nav-tabs">
           <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-list"></i> My registrars <span class="badge badge-info"><?php echo $count; ?></span></a></li>
           <li><a href="#tab2" data-toggle="tab"><i class="icon-plus"></i> Add new registrar</a></li>
        </ul>    
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Registrar name</th>
                        <th>Website</th>
                        <th>Comment</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $resultSelect = mysql_query("SELECT RegID, RegName, RegLink, RegComment FROM Registrars", $connection);
                        if (!resultSelect) {
                                die("Query failed");
                        }
                        while ($row = mysql_fetch_array($resultSelect)) {
                            echo '  <tr>';
                            echo '      <td>' . $row["RegName"] . '</td>';
                            echo '      <td><a href="http://' . $row["RegLink"] . '">' . $row["RegLink"] . '</a></td>';
                            echo '      <td>' . $row["RegComment"] . '</td>';
                            echo '      <td><div class="btn-group"><a class="btn" href="registrars.php?action=edit&id='. $row["RegID"] .'" alt="Edit"><i class="icon-pencil"></i></a><a class="btn" href="registrars.php?action=remove&id='. $row["RegID"] .'" alt="Remove"><i class="icon-remove-circle"></i></a></div></td>';
                            echo '  </tr>';
                        }
                        ?>          
                    </tbody>
                </table>
            </div>
            <div class="tab-pane" id="tab2">
                <form action="registrars.php?action=add" method="post">
                    <label>Registrar name</label>
                    <input type="text" class="input-medium" name="dname">
                    <label>Registrar website</label>
                    <input type="text" class="input-medium" name="dwebsite">
                    <label>Comments</label>
                    <textarea class="input-xxlarge" rows="5" name="dcomments"></textarea>
                    <div class="form-actions">
                      <button type="submit" class="btn btn-primary"><i class="icon-plus"></i> Add registrar</button>
                      <input type="reset" class="btn" value="Reset"> 
                    </div>                    
                </form>
            </div>
        </div>
    </div>
    <hr>
<?php require_once ("includes/footer.php"); ?>
</div>    
</body>
</html>
<?php mysql_close($connection); ?>