<?php 
session_start();
require_once('../include/class.user.php');
$user = new User();
$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("location: ../login/login.php");
	exit(); #Dont Leak any Data Pass this Point.
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location: ../login/login.php");
	exit(); #Dont Leak any Data Pass this Point.
}
$userData = $user->get_user_by_id($uid);
?>

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/custom.css">

<br>
	<center>
        <a href="../login/login.php?q=logout">LOGOUT</a>
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
	<a id="footer" href="mailto:<?php echo PROJECT_EMAIL; ?>"></a> <?php echo PROJECT_NAME; ?> <?php echo PROJECT_URL; ?>
<?php

$role = $user->fetch_role($uid);

switch(strtoupper($role)){
	case "GUEST": 
		echo "Welcome Guest!";
	break;
	
	case "MEMBER":
		echo "Hello Memeber!";
	break;
	
	case "MODERATOR":
		echo "Hello Mod!";
	break;
	
	case "ADMIN":
		echo "Hello Admin!";
	break;
	
	case "":
		http_response_code(500);
		echo "Please contact support, You Account has on perms.";
		exit();
	break;
	default:
		http_response_code(500);
		echo "Programming Error! User has no case!";
		exit();
	break;
}
?>