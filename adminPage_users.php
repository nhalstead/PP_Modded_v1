<?php 
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
	
	function doTell(&$in, $default = ""){ return isset($in)?$in:$default; }
	
	if(isset($_GET['reg'])) { $_SESSION['user_reg'] = true; header("Location: registration.php"); exit(); }
	
	$editMode = false;
	if(isset($_GET['edit'])) {
		$editMode = true;
	}
	
?>
<head>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" integrity="sha256-NuCn4IvuZXdBaFKJOAcsU2Q3ZpwbdFisd5dux4jkQ5w=" crossorigin="anonymous">
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
	<div class="container">
		<div class="row">
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">First Name</th>
				  <th scope="col">Last Name</th>
				  <th scope="col">Username</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
					$usersList = $user->fetch_all_users();
					
					foreach($usersList as $i => $userI ){
						
						echo "<tr>";
							echo "<th scope=\"row\">".$userI['uid']."</th>";
							echo "<td>".$userI['fname']."</td>";
							echo "<td>".$userI['lname']."</td>";
							echo "<td>".$userI['uname']."</td>";
						echo "</tr>";
					}
				?>
			  </tbody>
			</table>
	   </div>
	</div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>