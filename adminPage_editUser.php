<?php
require_once('include/class.user.php');
$user = User::getInstance();
	if (!$user->get_session()){
	   header("Location: login.php");
	}
$uid = $_SESSION['uid'];
$userData = $user->get_user_by_id($uid);

// Check User Perms
if(!$user->has_role($uid, array("ADMIN", "MODERATOR") )){
  header("Location: home.php");
}

// Grab User Account by the ID, Check if it Exists and setup.
	$userI = $user->get_user_by_id($_GET['uid']); // Grab User Listing that will be edited.
	if(empty($userI)){
		echo "User not found! Please go back and specify and real user!";
		if(isset($_GET['url'])){
			header('Location: '.urldecode($_GET['url']));
		}
		exit();
	}

// Do the Update if Presented with the Needed Data.
if (isset($_POST['submit'])){
	$uid = strip_tags(filter_input(INPUT_POST, 'uidUpdate', FILTER_SANITIZE_STRING));
	$fname = strip_tags(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
	$lname = strip_tags(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING));
	$uname = strip_tags(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING));
	$uemail = strip_tags(filter_input(INPUT_POST, 'uemail', FILTER_SANITIZE_EMAIL));
	$upass = strip_tags(filter_input(INPUT_POST, 'upass', FILTER_SANITIZE_STRING));
	$register = $user->update_user($uid, $fname, $lname, $username, $email, $address, $zipcode, $city, $phone);

	if ($register) {
		// Registration Success
		echo "<div class='textcenter'>Upadate Successful!</div>";
		if(isset($_GET['url'])){
			header('Location: '.urldecode($_GET['url']));
		}
	} else {
		// Registration Failed
		echo "<div class='textcenter'>Update failed!</div>";
	}
}


function doTell(&$in, $default = ""){ return isset($in)?$in:$default; }

?>
<head>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" integrity="sha256-NuCn4IvuZXdBaFKJOAcsU2Q3ZpwbdFisd5dux4jkQ5w=" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css"/>
		<link rel="stylesheet" href="assets/css/custom.css"/>
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

	<div class="container">
		<h1>Update User Account</h1>
		<form action="" method="POST" name="reg">
			<table class="table">
				<tr>
					<th>Full Name:</th>
					<td>
						<input type="text" name="fname" value="<?php echo $userI['fname'] ?>" required>
					</td>
				</tr>
				<tr>
					<th>Last Name:</th>
					<td>
						<input type="text" name="lname" value="<?php echo $userI['lname'] ?>" required>
					</td>
				</tr>
				<tr>
					<th>User Name:</th>
					<td>
						<input type="text" name="uname" value="<?php echo $userI['uname'] ?>" required>
					</td>
				</tr>
				<tr>
					<th>Email:</th>
					<td>
						<input type="email" name="uemail" value="<?php echo $userI['uemail'] ?>" required>
					</td>
				</tr>
				<tr>
					<th>Password:</th>
					<td>
						<input type="password" name="upass" value="************" required>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input class="btn" type="submit" name="submit" value="Update" onclick="return(submitreg());">
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						(You are Editing a User)
						<?php echo '<input type="hidden" name="uidUpdate" value="'.$_GET['uid'].'">'; ?>
						<script>/* Enable navigation prompt*/ window.onbeforeunload = function() { return false; };</script>
					</td>
				</tr>
			</table>
		</form>
	</div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
