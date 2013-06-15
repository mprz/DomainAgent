<?php
require_once (__DIR__ . '/includes/includes.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}
$d = new Domains();
$r = new Registrars();
// check if we're deleting a domain
if (isset($_GET['id']) && $_GET['id']!='')
{
    if (isset($_POST['action'])&&$_POST['action']=='delete')
        $confirmed = true;
    else
        $confirmed = false;
    $id = $_GET['id'];
}
else
    $id = -1;
pageHead();
?>
<body>
<?php headerHere('Delete', 'Make sure you know what you are doing'); ?>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="span3">
                <ul class="nav nav-tabs nav-stacked sidebar">
                    <li class=""><a href="index.php"><i class="icon-home"></i> Home</a></li>
                    <li class="active"><a href="domains.php"><i class="icon-briefcase"></i> Domains<span class="badge badge-info"><? echo $d->numTotal(); ?></span></a></li>
                    <li class=""><a href="registrars.php"><i class="icon-folder-open"></i> Registrars<span class="badge badge-info"><? echo $r->getTotal(); ?></span></a></li>
                    <li class="divider"></li>
                    <li class=""><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
                    <li class=""><a href="new.php"><i class="icon-plus-sign"></i> Add new</a></li>
                </ul>
            </div>
            <div class="span9" style="text-align: center;">
                <?php
                if ($id>=0) {
                    if ($confirmed) {
                        if ($d->delete($id))
                            box('Success','Domain has been successfully deleted','info');
                        else
                            box('Oh boy','Something went terribly wrong','warning');
                    }
                    else {
                        echo '<h3>You are about to delete</h3><br><h2>'.$d->get($id)['dom_name'].'</h2>';
                        echo '
                        <form class="form-horizontal" action="delete.php?id='.$id.'" method="post">
                            <input type="hidden" name="action" value="delete">
                            <div style="text-align:center;"><button type="submit" class="btn btn-warning"><i class="icon-edit"></i> Delete</button></div>
                        </form>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>