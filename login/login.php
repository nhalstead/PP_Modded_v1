<?php 
session_start();
require_once('../include/class.user.php');
$user = new User();

function i(&$i, $n = "Data") { if(isset($i) && $i !== "") { return $i; } else { die("Missing ".$n."!"); } }

if (isset($_POST['submit'])) { 
		$P = $_POST;		
	    $login = $user->check_login( i($P['emailusername']), i($P['password']) );
	    if($login == true) {
            $role_id = strtoupper($user->get_status($_SESSION['uid']));
            //echo $role_id;
			if($role_id == 'admin'){
				header("Location: ../admin/adminPage.php");
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">
  </head>

  <body>
    <div id="container" class="container">
      <h1>Login Here</h1>
      <center>Admin: Name: spar - Code spar</center>
      <center>Member: Name: hej - Code 1234</center>
      <center>Member2: Name: test - Code 1234</center>
      <form action="" method="post" name="login">
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
            <form action="../admin/adminPage.php">
              <input class="btn" type="submit" name="submit" value="Login" onclick="return(submitlogin());">
              </form>
              <a class="hoejre" href="forgotpassword.php">forgot password?</a>
              </div>
            </td> 
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><a href="../register/registration.php">Register new user</a></td>
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