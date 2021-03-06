<?php
session_start();
require_once('include/class.user.php');
$user = User::getInstance();

if ($user->get_session() && !isset($_GET['q'])){
	echo "User is Logged in.";
	echo "Click <a href=\"?q\">Here</a> to Logout!";
	exit();
}
if (isset($_GET['q'])){
	$user->user_logout();
	header( "Refresh:2; url=login.php", true, 303);
	echo "Ok, You are OUT! Bye, See you next time!";
	exit();
}


function i(&$i, $n = "Data") { if(isset($i) && $i !== "") { return $i; } else { die("Missing ".$n."!"); } }

if (isset($_POST['submit'])) {
		$P = $_POST;
	    $login = $user->check_login( i($P['emailusername']), i($P['password']) );
	    if($login == true) {
			if($user->has_role($_SESSION['uid'], "ADMIN")){
				header("Location: adminPage.php");
			} else {
                header("Location: home.php");
            }
	    } else {
	        // Login Failed
	        echo 'Wrong username or password';
	    }
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OOP Login Module</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
  </head>

  <body>
    <div class="container">
      <h1>Login Here</h1>
      <center>Admin: Name: spar - Code spar</center>
      <center>Member: Name: hej - Code 1234</center>
      <center>Member2: Name: test - Code 1234</center>
      <form action="" method="POST" name="login">
        <table class="table " width="400">
          <tr>
            <th>UserName or Email:</th>
            <td>
              <input type="text" name="emailusername" required>
            </td>
          </tr>
          <tr>
            <th>Password:</th>
            <td>
              <input type="password" name="password" required>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
            Remember me&nbsp;&nbsp;<input id="checkBox" type="checkbox"></input><br>
            <div class="ned">
            <form action="adminPage.php">
              <input class="btn" type="submit" name="submit" value="Login" onclick="return(submitlogin());">
              </form>
              <a class="hoejre" href="forgotpassword.php">forgot password?</a>
              </div>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><a href="register/registration.php">Register new user</a></td>
          </tr>
        </table>
      </form>
    </div>
    <script>
		function submitlogin() {
			var form = document.login;
				if (form.emailusername.value == "") {
				  alert("Enter email or username.");
				  return false;
				} else if (form.password.value == "") {
				  alert("Enter password.");
				  return false;
				}
		}
    </script>
  </body>
</html>
