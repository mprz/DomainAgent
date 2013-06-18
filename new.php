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
if (isset($_POST['action']) && $_POST['action']=='new')
{
    $domain['dom_name']     =$_POST['dom_name'];
    $domain['dom_reg_id']   =$_POST['dom_reg_id'];
    $domain['dom_reg_date'] =$_POST['dom_reg_date'];
    $domain['dom_exp_date'] =$_POST['dom_exp_date'];
    $domain['dom_comment']  =$_POST['dom_comment'];
    if ($d->insert($domain))
        $added=true;
    else
        $added=false;
}
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
                    <li class=""><a href="settings.php"><i class="icon-wrench"></i> Settings</a></li>
                    <li class="active"><a href="new.php"><i class="icon-plus-sign"></i> Add new</a></li>
                </ul>
            </div>
            <div class="span9">
                <div class="row">
                    <div class="span8">
                        <?php if (isset($added)) {
                            if ($added)
                                box('Success', 'Domain has been successfully added to the database', 'success');
                            else
                                box('Error', 'Something went wrong when adding a domain', 'error');
                        } ?>
                        <div class="row">
                            <div class="span5">
                                <form class="form-horizontal" action="new.php" method="post">
                                    <fieldset>
                                        <input type="hidden" name="action" value="new" />
                                        <div class="control-group">
                                            <label class="control-label">Domain name</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium input-block-level input-xlarge" name="dom_name" value="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Registrar</label>
                                            <div class="controls">
                                                <select name="dom_reg_id" class="input-xlarge">
                                                    <?php 
                                                    foreach($r->fetchAll() as $row) {
                                                    echo '<option value="'.$row['reg_id'].'">'.$row['reg_name'].'</option>
                                                    ';    
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Registration date</label>
                                            <div class="controls">
                                                <input type="text" class="input-block-level datepicker input-xlarge" data-date-format="yyyy-mm-dd" name="dom_reg_date" value="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Expiration date</label>
                                            <div class="controls">
                                                <input type="text" class="input-block-level datepicker input-xlarge" data-date-format="yyyy-mm-dd" name="dom_exp_date" value="">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Comments</label>
                                            <div class="controls">
                                                <textarea class="input-xlarge" rows="7" name="dom_comment"></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <a class="btn btn-primary" href="domains.php"><i class="icon-backward"></i>Back</a>
                                                <button type="submit" class="btn btn-warning"><i class="icon-edit"></i> New domain</button>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="span3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
    <script>$('.datepicker').datepicker();</script>
</body>
</html>