<?php 
session_start();
require_once('../include/class.user.php');
$user = new User();
    if (!$user->get_session()){
       header("Location: ../login/login.php");
    }
    else if (isset($_GET['q'])){
        $user->user_logout();
        header("Location: ../login/login.php");
    }
$uid = $_SESSION['uid'];
$userData = $user->get_user_by_id($uid);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  </head>

  <body>
    <div id="container" class="container">
      <div id="header">
        <a href="home.php?q=logout">LOGOUT</a>
      </div>
      <div id="main-body">
        <br/>
        <br/>
		  <center>
    <a href="../login/home.php">Back</a>
</center> 
        <br/>
        <br/>
		<center>
			<h1>
			<br>
			<br>Status: <?php echo $user->get_status($uid); ?> <!-- same as echo -->
			<br>Hello <?php echo $userData['fname']; ?></h1>
			
			<div class="form-group">
	  <label class="col-md-4 control-label" for="upass">Old Password</label>  
	  <div class="col-md-4">
	 <div class="input-group">
		   <div class="input-group-addon">
			<i class="fa fa-user">
			</i>
		   </div>
		   <input id="upass" name="upass" type="text" placeholder="" value="" class="form-control input-md">
		  </div>
	  </div>
	</div>

	<div class="form-group">
	  <label class="col-md-4 control-label" for="npass">New Password</label>  
	  <div class="col-md-4">
	 <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user"></i>
       </div>
       <input id="npass" name="npass" type="text" placeholder="" value="" class="form-control input-md">
      </div>
  </div>
</div>
		</center>
		<img src="../assets/images/vegeta.jpg" alt="welcome"/><br>
		<br>Full name: <?php echo $userData['fname']; ?>
		<br>Last name: <?php echo $userData['lname']; ?>
		<br>Email: <?php echo $userData['uemail']; ?>
      </div>
      <div id="footer"></div>
    </div>
  </body>

</html>