<?php
require_once (__DIR__ . '/includes/includes.php');
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
    <?php headerHere('Domains', 'Here you can browse all your domains and see if they require attention'); ?>
    <div class="container top30">
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
            <div class="span9">
                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1" data-toggle="tab"><i class="icon-list"></i> All <span class="badge badge-info"><?php echo $d->numTotal(); ?></span></a></li>
                        <li><a href="#tab2" data-toggle="tab">Good <span class="label label-success"><?php echo $d->numGood(); ?></span></a></li>
                        <li><a href="#tab3" data-toggle="tab">Expiring <span class="label label-warning"><?php echo $d->numExpiring(); ?></span></a></li>
                        <li><a href="#tab4" data-toggle="tab">Expired <span class="label label-important"><?php echo $d->numExpired(); ?></span></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Domain name</th>
                                    <th>Registrar</th>
                                    <th>Days left</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($d->numTotal()>0){
                                        foreach($domains as $row) {
                                            $dom=$r->get($row['dom_reg_id']);
                                            echo '
                                    <tr>
                                        <td><a href="single.php?id='.$row['dom_id'].'">'.$row['dom_name'].'</a></td>
                                        <td><a href="registrar.php?id='.$row['dom_reg_id'].'">'.$dom['reg_name'].'</a></td>
                                        <td>'.$row['dom_days_left'].'</td>
                                        <td>
                                            <a href="http://'.$row['dom_name'].'"><i class="icon-share"></i></a>
                                            <a href="single.php?id='.$row['dom_id'].'" alt="Details"><i class="icon-edit"></i></a>
                                            <a href="delete.php?id='.$row['dom_id'].'"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>';
                                        }
                                    }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Domain name</th>
                                    <th>Registrar</th>
                                    <th>Days left</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($d->numGood()>0) {
                                    foreach($domains as $row) {
                                        $dom=$r->get($row['dom_reg_id']);
                                        echo '
                                    <tr>
                                        <td><a href="single.php?id='.$row['dom_id'].'">'.$row['dom_name'].'</a></td>
                                        <td><a href="registrar.php?id='.$row['dom_reg_id'].'">'.$dom['reg_name'].'</a></td>
                                        <td>'.$row['dom_days_left'].'</td>
                                        <td>
                                            <a href="http://'.$row['dom_name'].'"><i class="icon-share"></i></a>
                                            <a href="single.php?id='.$row['dom_id'].'" alt="Details"><i class="icon-edit"></i></a>
                                            <a href="delete.php?id='.$row['dom_id'].'"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>';
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab3">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Domain name</th>
                                    <th>Registrar</th>
                                    <th>Days left</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($d->numExpiring()>0)
                                {
                                    foreach($domains as $row) {
                                        $dom=$r->get($row['dom_reg_id']);
                                        echo '
                                    <tr>
                                        <td><a href="single.php?id='.$row['dom_id'].'">'.$row['dom_name'].'</a></td>
                                        <td><a href="registrar.php?id='.$row['dom_reg_id'].'">'.$dom['reg_name'].'</a></td>
                                        <td>'.$row['dom_days_left'].'</td>
                                        <td>
                                            <a href="http://'.$row['dom_name'].'"><i class="icon-share"></i></a>
                                            <a href="single.php?id='.$row['dom_id'].'" alt="Details"><i class="icon-edit"></i></a>
                                            <a href="delete.php?id='.$row['dom_id'].'"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>';
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab4">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Domain name</th>
                                    <th>Registrar</th>
                                    <th>Days left</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($d->numExpired()>0) {
                                    foreach($domains as $row) {
                                        $dom=$r->get($row['dom_reg_id']);
                                        echo '
                                    <tr>
                                        <td><a href="single.php?id='.$row['dom_id'].'">'.$row['dom_name'].'</a></td>
                                        <td><a href="registrar.php?id='.$row['dom_reg_id'].'">'.$dom['reg_name'].'</a></td>
                                        <td>'.$row['dom_days_left'].'</td>
                                        <td>
                                            <a href="http://'.$row['dom_name'].'"><i class="icon-share"></i></a>
                                            <a href="single.php?id='.$row['dom_id'].'" alt="Details"><i class="icon-edit"></i></a>
                                            <a href="delete.php?id='.$row['dom_id'].'"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>';
                                    }
                                }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="new.php" class="btn btn-large btn-info">Add new</a>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
</body>
</html>