<?php
require_once (__DIR__ . '/includes/includes.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}
$d = new Domains();
$r = new Registrars();

if (isset($_POST['action']) && $_POST['action']=='new') {
    $error='';
    if (empty($_POST['reg_name'])) $error = '<li>Registrar name</li>';
    if (empty($_POST['reg_link'])) $error = $error.'<li>Link to the website</li>';
    if ($error=='') {
        $registrar['reg_name'] = $_POST['reg_name'];
        $registrar['reg_link'] = $_POST['reg_link'];
        if (!empty($_POST['reg_comment']))
            $registrar['reg_comment'] = $_POST['reg_comment'];
        else
            $registrar['reg_comment'] = '';
        $r->insert($registrar);
    }
}
pageHead();
?>
<body>
<?php headerHere('Registrars', 'Adding new registrar, fill all the fields'); ?>
    <div class="container top30">
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
                <?php if ($error!='') box('Error:', 'You are missing the following information: <ul>'.$error.'</ul>', 'error'); ?>
                <form class="form-horizontal" action="newreg.php" method="post">
                    <fieldset>
                        <input type="hidden" name="action" value="new">
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