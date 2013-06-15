<?php
require_once (__DIR__.'/includes/config.inc.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
};
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
                    <li class=""><a href="index.php"><i class="icon-home"></i> Home</a></li>
                    <li class=""><a href="domains.php"><i class="icon-briefcase"></i> Domains<span class="badge badge-info"><? echo $d->numTotal(); ?></span></a></li>
                    <li class="active"><a href="registrars.php"><i class="icon-folder-open"></i> Registrars<span class="badge badge-info"><? echo $r->getTotal(); ?></span></a></li>
                    <li class="divider"></li>
                    <li class=""><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
                    <li class=""><a href="new.php"><i class="icon-plus-sign"></i> Add new</a></li>
                </ul>
            </div>
            <div class="span9">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Link</th>
                        <th>Domains</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($r->fetchAll() as $row) {
                    echo '
                    <tr>
                        <td><a href="registrar.php?id='.$row['reg_id'].'">'.$row['reg_name'].'</a></td>
                        <td><a href="http://'.$row['reg_link'].'">'.$row['reg_link'].'</a></td>
                        <td>'.$row['reg_num_dom'].'</td>
                        <td><a href="http://'.$row['reg_link'].'"><i class="icon-share"></i></a> <a href="registrar.php?id='.$row['reg_id'].'" alt="Details"><i class="icon-edit"></i></a> <a href="delreg.php?id='.$row['reg_id'].'"><i class="icon-trash"></i></a></td></td>
                    </tr>
';
                    }
                    ?>
                    </tbody>
                </table>
                <a href="newreg.php" class="btn btn-large btn-info">New registrar</a>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>