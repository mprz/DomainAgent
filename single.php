<?php
require_once (__DIR__ . '/includes/includes.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
    die("Redirecting to login.php");
}
$d = new Domains();
$r = new Registrars();
// let's see if there's id in the url
if (isset($_GET['id']) &&($_GET['id'])!='')
    $id=$_GET['id'];
else
    // we will set it to -1 so we can indicate error later
    $id=-1;
// now let's see if this is an update
if (isset($_POST['action']) && $_POST['action']=='update') {
    // yes! an update
    $domain['dom_id']       = $_POST['dom_id'];
    $domain['dom_name']     = $_POST['dom_name'];
    $domain['dom_reg_id']   = $_POST['dom_reg_id'];
    $domain['dom_reg_date'] = $_POST['dom_reg_date'];
    $domain['dom_exp_date'] = $_POST['dom_exp_date'];
    $domain['dom_comment']  = $_POST['dom_comment'];
    // let's trigger a value so we can print result later on
    if ($d->update($domain))
        $updated = true;
    else
        $updated = false;
}
pageHead();
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
                <?php
                // did we just perform an update?
                if (isset($updated))
                {
                    if ($updated)
                        box('Domain updated','Domain details has been successfully updated','success');
                    else
                        box('Error','Something went wrong while updating the domain','error');
                }
                if ($id>=0  && $d->get($id)>-1)
                {
                    echo'
                <div class="row">
                    <div class="span8">
                        <div class="row">
                            <div class="span5">
                                <form class="form-horizontal" action="single.php?id='.$id.'" method="post">
                                    <fieldset>
                                        <input type="hidden" name="dom_id" value="'.$d->get($id)['dom_id'].'">
                                        <input type="hidden" name="action" value="update">
                                        <div class="control-group">
                                            <label class="control-label">Domain name</label>
                                            <div class="controls">
                                                <input type="text" class="input-medium input-block-level input-xlarge" name="dom_name" value="'.$d->get($id)['dom_name'].'">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Registrar</label>
                                            <div class="controls">
                                                <select name="dom_reg_id" class="input-xlarge">
                                                    <option value="'.$d->get($id)['dom_reg_id'].'">'.$r->get($d->get($id)['dom_reg_id'])['reg_name'].' /CURRENT/</option>';
                                                    foreach($r->fetchAll() as $row) {
                                                    echo 
'                                                   <option value="'.$row['reg_id'].'">'.$row['reg_name'].'</option>';    
                                                    }
                                                    echo '
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Registration date</label>
                                            <div class="controls">
                                                <input type="text" class="input-block-level datepicker input-xlarge" name="dom_reg_date" value="'.$d->get($id)['dom_reg_date'].'">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Expiration date</label>
                                            <div class="controls">
                                                <input type="text" class="input-block-level datepicker input-xlarge" name="dom_exp_date" value="'.$d->get($id)['dom_exp_date'].'">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Comments</label>
                                            <div class="controls">
                                                <textarea class="input-xlarge" rows="7" name="dom_comment">'.$d->get($id)['dom_comment'].'</textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls">
                                                <a class="btn btn-primary" href="domains.php"><i class="icon-backward"></i>Back</a>
                                                <button type="submit" class="btn btn-warning"><i class="icon-edit"></i> Update</button>
                                                <a class="btn btn-danger" href="delete.php?id='.$id.'"><i class="icon-trash icon-white"></i><span>Delete</span></a>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                            <div class="span3">
                                <img src="http://s.wordpress.com/mshots/v1/http%3A%2F%2F'.$d->get($id)['dom_name'].'%2F?w=250" alt="Thumbnail" />
                            </div>
                        </div>
                    </div>
                </div>
';
                }
                else
                    // hacking attempt? direct access to this file is not allowed
                    box('Hmmmm....','Something does not add up, are you sure you know what you are doing?','warning')
                ?>
            </div>
        </div>
    </div>
    <?php footerHere(); ?>
    <script>$('.datepicker').datepicker();</script>
</body>
</html>