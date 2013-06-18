<?php
require_once (__DIR__ . '/includes/includes.php');
require_once ('includes/classes/PasswordHash.php');
$hasher = new PasswordHash(8, TRUE); // initialize the PHPass class

if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}

if ($_POST['op'] === 'change') {
    $db=DB::getConnection();
    $newpass = $_POST['newpass'];
    $hash = $hasher->HashPassword($newpass);
    $query=$db->prepare("UPDATE users SET user_pass=:user_pass WHERE user_id=1");
    $query->execute(array('user_pass' => $hash ));
    $info='Password changed';
}

$d = new Domains();
$r = new Registrars();
pageHead();
?>
<body>
<?php headerHere(); ?>
    <div class="container top30">
        <div class="row">
            <div class="span3">
                <ul class="nav nav-tabs nav-stacked sidebar">
                    <li class=""><a href="index.php"><i class="icon-home"></i> Home</a></li>
                    <li class=""><a href="domains.php"><i class="icon-briefcase"></i> Domains<span class="badge badge-info"><? echo $d->numTotal(); ?></span></a></li>
                    <li class=""><a href="registrars.php"><i class="icon-folder-open"></i> Registrars<span class="badge badge-info"><? echo $r->getTotal(); ?></span></a></li>
                    <li class="divider"></li>
                    <li class="active"><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
                    <li class=""><a href="new.php"><i class="icon-plus-sign"></i> Add new</a></li>
                </ul>
            </div>
            <div class="span9">
                <?php if (isset($info)) {
                    box('Info', 'Password has been changed', 'info');
                } ?>
                <form action="settings.php" method="POST">
                    <input type="hidden" name="op" value="change">
                    New password:<br>
                    <input type="password" name="newpass" size="60"><br>
                    <input type="submit" value="Change password">
                </form>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>