<?php 
session_start();
require_once('include/class.user.php');
$user = new User();
    if (!$user->get_session()){
       header("Location: login.php");
    }
    else if (isset($_GET['q'])){
        $user->user_logout();
        header("Location: login.php");
    }
$uid = $_SESSION['uid'];
$userData = $user->get_user_by_id($uid);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" integrity="sha256-NuCn4IvuZXdBaFKJOAcsU2Q3ZpwbdFisd5dux4jkQ5w=" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/custom.css"/> 
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
			<a class="navbar-left" href="home.php">Home</a>
			<a class="navbar-right" href="home.php?q=logout">LOGOUT</a>
	  </div>
	</nav>
	<br>
    <div class="row margin">
		<div class="col-md-4">
			<img src="assets/images/vegeta.jpg" alt="welcome"/><br>
			<br><b><?php echo $user->has_role($uid, "ADMIN")?"Welcome Admin":"Welcome User" ?></b>
			<br>Full name: <?php echo ucwords($userData['fname']); ?>
			<br>Last name: <?php echo ucwords($userData['lname']); ?>
			<br>Email: <?php echo $userData['uemail']; ?>
		</div>
		<div class="col-md-4">
			<center>
				<h1>
					<br>
					<br>Hello <?php echo ucwords($userData['fname']); ?>
				</h1>
				<div class="form-group">
					<label class="col-md-8 control-label" for="upass">Old Password</label>  
					<div class="col-md-8">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user"></i>
							</div>
							<input id="upass" name="upass" type="text" placeholder="" value="" class="form-control input-md">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-8 control-label" for="npass">New Password</label>  
					<div class="col-md-8">
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-user"></i>
							</div>
							<input id="npass" name="npass" type="text" placeholder="" value="" class="form-control input-md">
						</div>
					</div>
				</div>
			</center>
		</div>
	</div>
	<div id="footer"></div>
    </div>
  </body>

</html>