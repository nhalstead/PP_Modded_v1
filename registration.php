<?php
require_once('include/class.user.php');
$user = new User();
$user->get_session();
$uid = $_SESSION['uid'];

if (isset($_POST['submit'])){
	$fname = strip_tags(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
	$lname = strip_tags(filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING));
	$uname = strip_tags(filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING));
	$uemail = strip_tags(filter_input(INPUT_POST, 'uemail', FILTER_SANITIZE_EMAIL));
	$upass = strip_tags(filter_input(INPUT_POST, 'upass', FILTER_SANITIZE_STRING));
	$register = $user->reg_user($fname, $lname, $uname, $uemail, $upass);

	if ($register) {
		// Registration Success
		echo "<div class='textcenter'>Registration successful <a href='login.php'>Click here</a> to login</div>";
		if(isset($_POST['man_redirect'])){
			$r = $_POST['man_redirect'];
			header("Location: ".$r);
		}
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="assets/css/custom.css" />
  </head>

  <body>
		<?php
			if(isset($_SESSION['man_redirect'])){
				$navItm = "";
				// Offer the Admin Page if Admin
				echo '<link rel="stylesheet" href="assets/css/custom_admin.css"/>';
				if( $user->has_role($uid, array("ADMIN", "MODERATOR") )){
					$navItm = '<a class="navbar-left" href="adminPage.php">Mgr Page</a>';
				}

				echo '<nav class="navbar navbar-default navbar-fixed-top">
					  <div class="container">
							<a class="navbar-left" href="home.php">Home</a>'.
								$navItm
							.'<a class="navbar-right" href="home.php?q=logout">LOGOUT</a>
					  </div>
					</nav>';
			}
		?>

    <div class="container">
      <h1>Registration Here</h1>
      <form action="" method="POST" name="reg">
        <table class="table">
          <tr>
            <th>First Name:</th>
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
              <input class="btn" type="submit" onclick="window.onbeforeunload = null;" name="submit" value="Register" onclick="return(submitreg());">
            </td>
          </tr>
					<?php
						if(!isset($_SESSION['man_redirect'])){
		          	echo '<tr>
		            	<td>&nbsp;</td>
		            	<td><a href="login.php">Already registered? Click Here!</a></td>
		          	</tr>';
						}
						else {
							echo '<tr>';
								echo '<td>&nbsp;</td><td>';
								echo '(You are Creating a new User, <b>Don\'t Refresh</b>)';
								echo '<input type="hidden" name="man_redirect" value="'.$_SESSION['man_redirect'].'">';
								unset($_SESSION['man_redirect']); // Unset the Session Var.
								echo '<script>/* Enable navigation prompt*/ window.onbeforeunload = function() { return false; };</script>';
							echo '</td></tr>';
						}
					?>
        </table>
      </form>
    </div>

    <script>
      function submitreg() {
        var form = document.reg;
        if (form.name.value == "") {
					alert("Enter Name!");
					return false;
        }
				else if (form.uname.value == "") {
					alert("Enter a Username!");
					return false;
        }
				else if (form.upass.value == "") {
					alert("Enter a Password!");
					return false;
        }
				else if (form.uemail.value == "") {
					alert("Enter an Email Addresss!");
					return false;
        }
      }
    </script>
  </body>
</html>
