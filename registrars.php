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
        $dName = $_POST['dname'];
        $dWebsite = $_POST['dwebsite'];
        $dComments = $_POST['dcomments'];
        if ($dName=='' || $dWebsite=='')
        {
            if ($dName=='') $t1='<li>Registrar name</li>'; else $t1=''; 
            if ($dReg=='') $t2='<li>Registrar website</li>'; else $t2='';
            box("Error", 'Error adding a new domain, you are missing the following:' . '<ul>' .  $t1 .  $t2 . '</ul>', 'error');            
        }
        else
        {
        try {
            $query = $conn->prepare('INSERT INTO `'.$DB_PREFIX . $DB_REG.'` (`RegName`, `RegLink`, `RegComment`) VALUES (:dname, :dwebsite, :dcomments);');
            $query->execute(array(
                'dname' => $dName,
                'dwebsite' => $dWebsite,
                'dcomments' => $dComments));            
            box('Success', 'The registrar has been added.', 'success');
        }

        catch (PDOException $e) {
            echo 'MySQL ERROR: ' . $e->getMessage();
            echo $conn->errorCode();
            echo $conn->errorInfo();
        }
        }
    }
    else if ($action === 'remove')
    {
    try {
        $query = $conn->prepare('DELETE FROM `'.$DB_PREFIX . $DB_REG.'` WHERE `RegID`=:id');
        $query->execute(array('id' => $id));
        box('Success', 'The domain has been removed.', 'info' );
    } 
    catch (PDOException $e) {
        echo 'MySQL ERROR: ' . $e->getMessage();
        echo $conn->errorCode();
        echo $conn->errorInfo();
    }
    }
    $count = -1;
    try {
        $query = $conn->prepare('SELECT COUNT(1) FROM '.$DB_PREFIX . $DB_REG.';');
        $query->execute();
        $count = $query->fetchColumn();
    } 
    catch (PDOException $e) {
        echo 'MySQL ERROR: ' . $e->getMessage();
        echo $conn->errorCode();
        echo $conn->errorInfo();
    }     

if ($action==='edit') {
    if ($id!=''){
    try {
        $query = $conn->prepare('SELECT RegID, RegName, RegLink, RegComment FROM '.$DB_PREFIX . $DB_REG.' WHERE RegID=:regid;');
        $query->execute(array('regid' => $id));
        $result=$query->fetchAll();
        foreach ($result as $row) {            
        echo '
    <form action="registrars.php?action=update" method="post">
        <label>Registrar ID</label>
        <input type="text" class="input-medium uneditable-input" name="did" value="'.$row["RegID"].'" readonly>
        <label>Registrar name</label>
        <input type="text" class="input-medium" name="dname" value="'.$row["RegName"].'">
        <label>Registrar website</label>
        <input type="text" class="input-medium" name="dwebsite" value="'.$row["RegLink"].'">
        <label>Comments</label>
        <textarea class="input-xxlarge" rows="5" name="dcomments">'.$row["RegComment"].'</textarea>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><i class="icon-edit"></i> Update registrar details</button>
            <input type="reset" class="btn" value="Reset"> 
            <a href="registrars.php" class="btn">Cancel</a>          
        </div>                    
    </form>';      
       }
      } 
        catch (PDOException $e) {
            echo 'MySQL ERROR: ' . $e->getMessage();
            echo $conn->errorCode();
            echo $conn->errorInfo();
        }            
    }
    else {
            box('Success', 'The registrar details has been changed.', 'success');   
    }
} elseif ($action==='update') {
        $dId = $_POST['did'];
        $dName = $_POST['dname'];
        $dWebsite = $_POST['dwebsite'];
        $dComments = $_POST['dcomments'];
        if ($dName=='' || $dWebsite=='')
        {
            if ($dName=='') $t1='<li>Domain name</li>'; else $t1=''; 
            if ($dWebsite=='') $t2='<li>Registrar</li>'; else $t2='';
            box("Error", 'Error adding a new registrar, you are missing the following:' . '<ul>' .  $t1 .  $t2 . '</ul>', 'error');
         } else {
         try {
            $query = $conn->prepare('UPDATE '.$DB_PREFIX . $DB_REG.' SET RegName=:dname, RegLink=:dwebsite, RegComment=:dcomments WHERE RegID=:regid;');
            $query->execute(array(
                'dname' => $dName,
                'dwebsite' => $dWebsite,
                'dcomments' => $dComments,
                'regid' => $dId));              
            box('Success', 'The registrar details has been changed.', 'success');             
         }
            catch (PDOException $e) {
                echo 'MySQL ERROR: ' . $e->getMessage();
                echo $conn->errorCode();
                echo $conn->errorInfo();
            }         
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
                    try {
                        $query = $conn->prepare('SELECT RegID, RegName, RegLink, RegComment FROM '.$DB_PREFIX . $DB_REG.';');
                        $query->execute();
                        $result=$query->fetchAll();
                        foreach ($result as $row) {
                        echo '
                            <tr>
                                <td>' . $row["RegName"] . '</td>
                                <td><a href="http://' . $row["RegLink"] . '">' . $row["RegLink"] . '</a></td>
                                <td>' . $row["RegComment"] . '</td>
                                <td><div class="btn-group"><a class="btn" href="registrars.php?action=edit&id='. $row["RegID"] .'" alt="Edit"><i class="icon-pencil"></i></a><a class="btn" href="registrars.php?action=remove&id='. $row["RegID"] .'" alt="Remove"><i class="icon-remove-circle"></i></a></div></td>
                            </tr>';
                        }                        
                    } 
                    catch (PDOException $e) {
                        echo 'MySQL ERROR: ' . $e->getMessage();
                        echo $conn->errorCode();
                        echo $conn->errorInfo();
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
<?php foot(); ?>
</div>    
</body>
</html>