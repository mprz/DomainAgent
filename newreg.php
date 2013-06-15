<?php
require_once (__DIR__.'/includes/config.inc.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}
$d = new Domains();
$r = new Registrars();
if (isset($_GET['id']) && $_GET['id']!='')
    $id = $_GET['id'];
else
    $id = -1;
pageHead();
?>
<body>
<?php headerHere('Registrars', 'Adding new registrar, fill all the fields'); ?>
    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="span3">
                <ul class="nav nav-tabs nav-stacked sidebar">
                    <li class=""><a href="index.php"><i class="icon-home"></i> Home</a></li>
                    <li class=""><a href="domains.php"><i class="icon-briefcase"></i> Domains<span class="badge badge-info"><? echo $d->numTotal(); ?></span></a></li>
                    <li class="active"><a href="registrars.php"><i class="icon-folder-open"></i> Registrars<span class="badge badge-info"><? echo $r->getTotal(); ?></span></a></li>
                    <li class="divider"></li>
                    <li class=""><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
                    <li class=""><a href="new.php"><i class="icon-plus-sign"></i> Add new</a></li>
                </ul>
            </div>
            <div class="span9">
                <form class="form-horizontal" action="newreg.php" method="post">
                    <fieldset>
                        <input type="hidden" name="action" value="update">

                        <div class="control-group">
                            <label class="control-label">Registrar name</label>
                            <div class="controls">
                                <input type="text" class="input-medium input-block-level input-xlarge" name="reg_name" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Registrar link</label>
                            <div class="controls">
                                <input type="text" class="input-medium input-block-level input-xlarge" name="reg_link" value="">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Comments</label>
                            <div class="controls">
                                <textarea class="input-xlarge" rows="7" name="reg_comment"></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <a class="btn btn-primary" href="registrars.php"><i class="icon-backward"></i>Back</a>
                                <button type="submit" class="btn btn-warning"><i class="icon-edit"></i> Insert</button>
                            </div>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>