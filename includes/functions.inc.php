<?php
function pageHead($title = 'DomainAgent') {
    echo '
<!DOCTYPE html>
<html>
<head>
    <link href="css/bootstrap-combined.min.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-2.0.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$title.'</title>
</head>
';
}

function headerHere($title = 'Dashboard', $content = 'Here you can overview all your domains and registrars') {
    echo '
    <a href="#top" id="toTop"></a>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="./index.php">DomainAgent</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class=""><a href="index.php"><i class="icon-home"></i> Home</a></li>
              <li class=""><a href="domains.php"><i class="icon-briefcase"></i> Domains</a></li>
              <li class=""><a href="registrars.php"><i class="icon-folder-open"></i> Registrars</a></li>
              <li class=""><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
            </ul>
            <div class="pull-right">
                <ul class="nav pull-right">
                  <li><a href="logout.php"><i class="icon-off"></i> Logout</a></li>
                </ul>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <header class="jumbotron" id="overview" style="padding-top: 50px; background-color:#368EE0;color:#fff;">
      <div class="container">
        <h1>'.$title.'</h1>
        <p class="lead">'.$content.'.</p>
      </div>
    </header>
';
}
function footerHere() {
    echo '
    <footer>
        <div class="container" style="padding: 15px;text-align: center;">
            Visit DomainAgent <a href="http://dagent.org">homepage</a> or <a href="https://github.com/mprz/DomainAgent">GitHub</a>. Copyright &copy; 2013 mprz.
        </div>
    </footer>
';
}
?>