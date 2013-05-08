<?php require_once ("includes/functions.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>dAgent - Login</title><?php head(); ?>
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
        <h1>dAgent</h1>
    </div>
    <p class="lead">You need to login to access this page.</p>
    <hr>
<?php 
if ($action=='loggedin') {
    $_SESSION['logged'] = 1;
    box('Message', 'You are logged in', 'success');
}    
else 
{
echo '    
    <form action="login.php?action=loggedin" style="text-align: center;" method="POST">
        <label>Username</label>
        <input type="text" class="input-medium" name="user">
        <label>Password</label>
        <input type="text" class="input-medium" name="password">
        <div><button type="submit" class="btn btn-primary">LOGIN</button></div>
    </form>
';
}?>
    <hr>
<?php foot(); ?>
</div>    
</body>
</html>
<?php mysql_close($connection); ?>