<?php 
require_once('../include/class.user.php');
$user = new User();
// Checking for user logged in or not
    /*if (!$user->get_session())
    {
       header("location:index.php");
    }*/
if (isset($_POST['submit'])){
	$fname = strip_tags(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
	$lname = strip_tags(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING));
	$uname = strip_tags(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING));
	$uemail = strip_tags(filter_input(INPUT_POST, 'uemail', FILTER_SANITIZE_EMAIL));
	$upass = strip_tags(filter_input(INPUT_POST, 'upass', FILTER_SANITIZE_STRING));
	$register = $user->reg_user($fname, $lname, $uname, $uemail, $upass);
	
	if ($register) {
		// Registration Success
		echo "<div class='textcenter'>Registration successful <a href='../login/login.php'>Click here</a> to login</div>";
	} else {
		// Registration Failed
		echo "<div class='textcenter'>Registration failed. Email or Username already exits please try again.</div>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../assets/css/custom.css" />
  </head>

  <body>
    <div id="container" class="container">
      <h1>Registration Here</h1>
      <form action="" method="post" name="reg">
        <table class="table">
          <tr>
            <th>Full Name:</th>
            <td>
              <input type="text" name="fname" required>
            </td>
          </tr>
          <tr>
            <th>Last Name:</th>
            <td>
              <input type="text" name="lname" required>
            </td>
          </tr>
          <tr>
            <th>User Name:</th>
            <td>
              <input type="text" name="uname" required>
            </td>
          </tr>
          <tr>
            <th>Email:</th>
            <td>
              <input type="email" name="uemail" required>
            </td>
          </tr>
          <tr>
            <th>Password:</th>
            <td>
              <input type="password" name="upass" required>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <input class="btn" type="submit" name="submit" value="Register" onclick="return(submitreg());">
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><a href="../login/login.php">Already registered? Click Here!</a></td>
          </tr>

        </table>
      </form>
    </div>

    <script>
      function submitreg() {
        var form = document.reg;
        if (form.name.value == "") {
			alert("Enter name.");
			return false;
        } else if (form.uname.value == "") {
			alert("Enter username.");
			return false;
        } else if (form.upass.value == "") {
			alert("Enter password.");
			return false;
        } else if (form.uemail.value == "") {
			alert("Enter email.");
			return false;
        }
      }
    </script>
  </body>
</html>