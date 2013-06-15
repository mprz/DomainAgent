<?php
require_once (__DIR__ . '/includes/includes.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}
$d = new Domains();
$r = new Registrars();
pageHead();
?>
<body>
    <?php headerHere(); ?>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="span3">
                <ul class="nav nav-tabs nav-stacked sidebar">
                    <li class="active"><a href="index.php"><i class="icon-home"></i> Home</a></li>
                    <li class=""><a href="domains.php"><i class="icon-briefcase"></i> Domains<span class="badge badge-info"><? echo $d->numTotal(); ?></span></a></li>
                    <li class=""><a href="registrars.php"><i class="icon-folder-open"></i> Registrars<span class="badge badge-info"><? echo $r->getTotal(); ?></span></a></li>
                    <li class="divider"></li>
                    <li class=""><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
                    <li class=""><a href="new.php"><i class="icon-plus-sign"></i> Add new</a></li>
                </ul>
            </div>
            <div class="span9">
                <div class="row">
                    <div class="span3 blue rounded"><h2><?php echo $d->numTotal(); ?></h2><p>DOMAINS</p>
                    </div>
                    <div class="span3 orange rounded"><h2><?php echo $d->numExpiring(); ?></h2><p>EXPIRING</p>
                    </div>
                    <div class="span3 red rounded"><h2><?php echo $d->numExpired(); ?></h2><p>EXPIRED</p>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px;">
                    <div class="span6 purple rounded"><h2><?php echo $r->getTotal(); ?></h2><p>REGISTRARS</p>
                    </div>
                    <div class="span3 green rounded"><h2><?php echo $d->numGood(); ?></h2><p>GOOD</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>