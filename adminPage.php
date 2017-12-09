<?php 
session_start();
require_once('include/class.user.php');
$user = new User();
$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("location: login.php");
	exit(); # Stop Loading
}

if (isset($_GET['q'])){
    $user->user_logout();
    header("location: login.php");
	exit(); # Stop Loading
}
$userData = $user->get_user_by_id($uid);

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
	
	case "PUBLIC":
		http_response_code(500);
		echo "Please contact support, You Account has no perms!";
		echo "<br><a href='home.php'>Click to go Home!</a>";
		exit();
	break;
	default:
		http_response_code(500);
		echo "Programming Error! User has no case!";
		exit();
	break;
}
?>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
			<a class="navbar-left" href="home.php">Home</a>
			<?php
				// Offer the Admin Page if Admin
				if($user->has_role($uid, "ADMIN")){
					echo '<a class="navbar-left" href="adminPage.php">Admin Page</a>';
				}
			?>
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
		   <h1>
			<center>
				<br>Welcome <?php echo ucwords($userData['fname']); ?>
			</center>
		  </h1>
	   </div>
		<div class="col-md-4">
			<a href="profiles.php">Edit Profile</a><br>
			<a href="password.php">Change Password</a><br>
			<a href="imagePage.php">Upload Picture</a>
		</div>
	</div>
	<div style="padding-left:50px;">
		<a href="<?php echo PROJECT_URL ?>"><?php echo PROJECT_NAME ?></a><br>
		<a href="mailto:<?php echo PROJECT_EMAIL ?>"><?php echo PROJECT_EMAIL ?></a>
	</div>
</body>