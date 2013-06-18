<?php
require_once (__DIR__ . '/includes/includes.php');
require_once ('includes/classes/PasswordHash.php');
$hasher = new PasswordHash(8, TRUE); // initialize the PHPass class

if(!empty($_POST))
{
    try
    {
        $conn = DB::getConnection()->prepare("SELECT user_name, user_pass
                                              FROM users
                                              WHERE user_name = :username");
        $result = $conn->execute(array(':username' => $_POST['username']));
    }
    catch(PDOException $ex)
    {
        die('Cannot retrieve user data.');
    }
    $login_ok = false;
    $row = $conn->fetch();
    if($row)
    {
        $password=$_POST['password'];
        $hashed=$row['user_pass'];
        if ($hasher->CheckPassword($password, $hashed)) {
            $login_ok=true;
        }
    }
    if($login_ok)
    {
        $_SESSION['user'] = $row;
        header("Location: index.php");
        die("Redirecting to: index.php");
    }
    else
    {
        $comment='Error: wrong username or password';
    }
}
?>
<html>
<head>
    <title>DomainAgent - Login</title>
</head>
<body>
    <div style="width:300px; margin: 0 auto; text-align: center; margin-top: 50px;">
        <h1>Login</h1>
        <?php if (isset($comment)) echo $comment.'<br/><br/>'; ?>
        <form action="login.php" method="post">
            Username:<br />
            <input type="text" name="username" value="" />
            <br /><br />
            Password:<br />
            <input type="password" name="password" value="" />
            <br /><br />
            <input type="submit" value="Login" />
        </form>
    </div>
</body>