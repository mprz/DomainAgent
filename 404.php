<?php
require_once (__DIR__.'/includes/config.inc.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}
$d = new Domains();
$r = new Registrars();
$domains    = $d->fetchAll();
$good       = $d->fetchGood();
$expiring   = $d->fetchExpiring();
$expired    = $d->fetchExpired();
pageHead('Domains');
?>
<body>
<?php headerHere('404', 'Something does not add up'); ?>
    <div class="container" style="text-align: center;">
        <div class="hero-unit center">
            <h1>Page Not Found <small><font face="Tahoma" color="red">Error 404</font></small></h1>
            <br />
            <p>The page you requested could not be found, either contact your webmaster or try again. Use your browsers <b>Back</b> button to navigate to the page you have prevously come from</p>
            <p><b>Or you could just press this neat little button:</b></p>
            <a href="index.php" class="btn btn-large btn-info"><i class="icon-home icon-white"></i> Take Me Home</a>
        </div>
     </div>
    <?php footerHere(); ?>
</body>
</html>