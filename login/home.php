<?php 
session_start();
    include_once '../include/class.user.php';
    $user = new User();

    $uid = $_SESSION['uid'];

    if (!$user->get_session()){
       header("Location: login.php");
    }

    if (isset($_GET['q'])){
        $user->user_logout();
        header("Location: login.php");
    }
	$userData = $user->get_user_by_id($uid);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css"/>  
	<link rel="stylesheet" href="../assets/css/custom.css"/> 
  </head><br>
	<center>
        <a href="home.php?q=logout">LOGOUT</a>
	</center>
	<br>
	<div class="row margin">
		<div class="col-md-4">
			<img src="../assets/images/vegeta.jpg" alt="ProfilePicture"/><br>
			<br>Full name: <?php echo $userData['fname']; ?>
			<br>Last name: <?php echo $userData['lname']; ?>
			<br>Email: <?php echo $userData['uemail']; ?>
		</div>
		<div class="col-md-4">
		   <h1>
			<center>
			<br>Status: <?php echo $user->get_status($uid); ?>
			<br>Hello <?php echo $userData['fname']; ?>
			</center>
		  </h1>
	   </div>
		<div class="col-md-4">
			<a href="../profiles/profiles.php">Edit Profile</a><br>
			<a href="../password/password.php">Change Password</a><br>
			<a href="../imagePage.php/imagePage.php">Upload Picture</a>
		</div>
	</div>
	<a id="footer" href="mailto:<?php echo PROJECT_EMAIL ?>"></a> <?php echo PROJECT_NAME ?> <a href="#"<?php echo PROJECT_URL ?></a>
</html>