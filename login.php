<?php
ob_start();
session_start();
include "connection.php";
 
if (isset($_POST["login"])) 
{
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password)) 
    {
        echo '<div class="alert alert-danger">Both fields must be filled out</div>';
    } 
    else 
    {
        $res = mysqli_query($link, "select * from registration where username='$username' && password='$password'");
        $count = mysqli_num_rows($res);

        if ($count == 0) 
        {
            echo '<div class="alert alert-danger">Invalid Username or Password</div>';
        } 
        else 
        {
            $_SESSION['username'] = $username;
            header("Location: quiz.html");
        }
    }
}
?>


<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>QuizSwirl-Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="login.css">
</head>

<body>
<div class="name">Quiz Login</div>
	<div class="error-pagewrap">
		<div class="error-page-int">
			<div class="text-center m-b-md custom-login">
				<h3>LOGIN</h3>
			</div>
			<div class="content-error">
				<div class="hpanel">
                    <div class="panel-body">
                        <form action="" name="form1" method="post">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" placeholder="e.g. Steve67" title="Please enter you username" required="" value="" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" title="Please enter your password" placeholder="******" required="" value="" name="password" id="password" class="form-control">
                            </div>
                            <button type="submit" name="login" class="btn btn-success btn-block loginbtn">Login</button>
                            <a class="btn btn-default btn-block" href="register.php">Sign Up</a>
                            <div class="alert alert-danger" id="failure" style="margin-top: 10px; <?php if ($count == 0) echo 'display: block;'; else echo 'display: none;'; ?>">
                                <strong>Does not match!</strong> Invalid Username or Password
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>   
    </div>
</body>
</html>