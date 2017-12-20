<?php 
session_start();
    include_once 'include/class.user.php';
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
		<link rel="stylesheet" href="assets/css/bootstrap.css"/>  
		<link rel="stylesheet" href="assets/css/custom.css"/> 
	</head>
	<body>
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
				<a class="navbar-left" href="home.php">Home</a>
				<?php
					// Offer the Admin Page if Admin
					if($user->has_role($uid, "MODERATOR") || $user->has_role($uid, "Admin")){
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
				
				<br>Full name: <?php echo ucwords($userData['fname']); ?>
				<br>Last name: <?php echo ucwords($userData['lname']); ?>
				<br>Email: <?php echo $userData['uemail']; ?>
			</div>
			<div class="col-md-4">
			   <h1>
				<center>
					<br>Hello <?php echo $userData['fname']; ?>
					<br>Status: <?php echo $user->get_status($uid); ?>
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
</html>