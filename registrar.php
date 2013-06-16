<?php
require_once (__DIR__ . '/includes/includes.php');
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
<?php headerHere('Registrars', 'Here you can oversee the registrars, edit their details or add a new one'); ?>
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
            <?php
            if ($id<0) {
                if (!isset($_POST['action']))
                {
                    box('Huh?', 'Something went wrong', 'error');
                } else
                {
                    if ($_POST['action']=='delete')
                    {
                        echo 'delete registrar';
                    }
                    elseif ($_POST['action']=='update')
                    {
                        echo 'update registrar';
                    }
                    else
                    {
                        box('Huh?', 'Something went wrong', 'error');
                    }
                }
            } elseif ($id>=0 && $r->get($id)) {
                $registrar=$r->get($id);
                echo '
                <div class="row">
                    <div class="span5">
                        <form class="form-horizontal" action="registrar.php" method="post">
                            <fieldset>
                                <input type="hidden" name="action" value="update">
                                    <div class="control-group">
                                        <label class="control-label">Registrar name</label>
                                        <div class="controls">
                                            <input type="text" class="input-medium input-block-level input-xlarge" name="RegName" value="'.$registrar['reg_name'].'">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Registrar link</label>
                                        <div class="controls">
                                            <input type="text" class="input-medium input-block-level input-xlarge" name="RegLink" value="'.$registrar['reg_link'].'">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Comments</label>
                                        <div class="controls">
                                            <textarea class="input-xlarge" rows="7" name="RegComment">'.$registrar['reg_comment'].'</textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                            <div class="span1 offset1"><a class="btn btn-primary" href="registrars.php"><i class="icon-backward"></i>Back</a></div>
                                            <div class="span1"><button type="submit" class="btn btn-warning"><i class="icon-edit"></i> Update</button></div>
                                            <div class="span1"><a class="btn btn-danger" href="delreg.php?id='.$id.'"><i class="icon-trash icon-white"></i><span>Delete</span></a></div>
                                    </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="span4">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Domains</th>
                                </tr>
                            </thead>
                            <tbody>
';
                foreach ($d->fetchAll() as $row) {
                    if ($row['dom_reg_id']==$id) {
                        echo '
                                <tr>
                                    <td><a href="single.php?id='.$row['dom_id'].'">'.$row['dom_name'].'</a></td>
                                </tr>
';
                    }
                }
                echo '
                            </tbody>
                        </table>
                    </div>
                </div>
                ';
            } elseif ($id>=0 && !$r->get($id))
                box('Huh?', 'Something went wrong, are you trying to hack me?', 'error');
            ?>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>