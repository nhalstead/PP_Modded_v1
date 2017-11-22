<?php
require_once("../include/class.user.php");
$user = new User();
if (!$user->get_session()){
	//header("Location: ../login/login.php");
}
else if (isset($_GET['q'])){
	//$user->user_logout();
	//header("Location: ../login/login.php");
}
$uid = $_SESSION['uid'];
$userData = $user->get_user_by_id($uid);

switch($user->fetch_role($uid)){
	case "PUBLIC":
		echo "Welcome Pubic User. You should not be seeing this btw!";
	break;
	
	case "GUEST": 
		echo "Welcome Guest!";
	break;
	
	case "MEMBER":
		echo "Hello Memeber!";
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