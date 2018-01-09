<?php
session_start();
require_once('include/class.user.php');
$user = User::getInstance();
$uid = $_SESSION['uid'];

if (!$user->get_session()){
    header("Location: home.php");
	exit(); # Stop Loading
}
//$userData = $user->get_user_by_id($uid);
$userData = User::getUser();

// Check User Perms
if(!$user->has_role($uid, array("ADMIN", "MODERATOR") )){
  header("Location: home.php");
}

$role_level = 0;
$role = $user->fetch_role($uid);
switch(strtoupper($role)){
	case "MODERATOR":
		// Authorized
	break;

	case "ADMIN":
		// Authorized
	break;

	default:
		http_response_code(403);
		header("Location: home.php");
	exit(); # Stop Loading
	break;
}
?>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
</head>
<body>
  <link rel="stylesheet" href="assets/css/custom_admin.css"/>
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
			<a class="navbar-left" href="home.php">Home</a>
			<?php
				// Offer the Admin Page if Admin
				if($user->has_role($uid, array("ADMIN", "MODERATOR") )){
					echo '<a class="navbar-left" href="adminPage.php">Mgr Page</a>';
				}
			?>
			<a class="navbar-right" href="home.php?q=logout">LOGOUT</a>
	  </div>
	</nav>
	<br>
	<div class="row margin">
		<div class="col-md-4">
			<img src="assets/images/vegeta.jpg" alt="welcome"/><br>
			<br><b>
				<?php
					if($user->has_role($uid, "ADMIN")){
						echo "Welcome Admin!";
					}
					else if($user->has_role($uid, "MODERATOR")) {
						echo "Welcome Mod!";
					}
					else {
						echo "Welcome User!";
					}
				?>
			</b>

			<br>First Name: <?php echo ucwords($userData['fname']); ?>
			<br>Last Name: <?php echo ucwords($userData['lname']); ?>
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
			<a href="adminPage_users.php">View Users</a><br>
			<a href="adminPage_users.php?edit">Edit Users</a><br>
			<a href="adminPage_users.php?reg">New Users</a><br>
		</div>
	</div>
	<div style="padding-left:50px;">
		<a href="<?php echo PROJECT_URL ?>"><?php echo PROJECT_NAME ?></a><br>
		<a href="mailto:<?php echo PROJECT_EMAIL ?>"><?php echo PROJECT_EMAIL ?></a>
	</div>
</body>
