<?php 
session_start();
	require_once('../include/class.user.php');
	$user = new User();
	$uid = $_SESSION['uid'];
	if (!$user->get_session()){
	   header("Location: ../login/login.php");
	}
	if (isset($_GET['q'])){
		$user->user_logout();
		header("Location: ../login/login.php");
	}
	
	
	
	if(isset($_POST['Submit'])) {		
		require_once ('../include/Member.php');
		$user = new User;
		$member = new Member($mysqli, $user);
		$member->upsert(c($_POST["fname"]), c($_POST["lname"]), c($_POST["email"]), c($_POST["address"]), c($_POST["zipcode"]), c($_POST["city"]), c($_POST["phone"]), $_SESSION['uid']);
		$_SESSION['UPDATE'] = true;
		if(mysqli_errno($mysqli)){
			echo mysqli_error($mysqli);
			exit();
		}
		header("Location: ".$_SERVER['PHP_SELF']);
	}
	else {
		unset($_SESSION['UPDATE']);
	}
	
	function doTell(&$in, $default = ""){
		return isset($in)?$in:$default;
	}
	
	$userData = $user->get_user_by_id($uid);
?>
<?php include ("head.php");?>
<center>
    <a href="../login/home.php">Back</a>
</center> 
<body>
   <div class="container">
<div class="row">
<div class="col-md-10 ">
<?php include ("formData.php");?>
   <script>
  function valider(f){
	if(f.fname.value ==""){
	alert("Enter First Name");
	f.fname.focus();
	return false;
	}
	
	if(f.lname.value ==""){
	alert("Enter Last Name");
	f.lname.focus();
	return false;
	}
	
	var atpos = f.email.value.indexOf("@");
	var dotpos = f.email.value.lastIndexOf(".");
	
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=f.email.value.length){
	alert("Please enter a valid email fx dragonball@love.dk");
	f.email.focus();
	return false;
	}
	
	if(f.address.value ==""){
	alert("Enter Full Address fx Capitalcity 201 3c");
	f.address.focus();
	return false;
	}

	if(f.zipcode.value ==""){
	alert("Please Enter A Valid Zip Code fx 2730");
	f.zipcode.focus();
	return false;
	}


	if(isNaN(f.zipcode.value)){
	alert("Zipcode can only have numbers");
	f.zipcode.focus();
	return false;
	}

	if(f.zipcode.value.length < 4 || f.zipcode.value.length > 4){
	alert("Please Enter zipcode with 4 Digits");
	f.zipcode.focus();
	return false;
	}
	
	if(f.city.value ==""){
	alert("Please Enter A city");
	f.city.focus();
	return false;
	}
	
		if(f.phone.value ==""){
	alert("Please Enter A Valid Number");
	f.phone.focus();
	return false;
	}


	if(isNaN(f.phone.value)){
	alert("Enter Phone with numbers only");
	f.phone.focus();
	return false;
	}

	if(f.phone.value.length < 8 || f.phone.value.length > 8){
	alert("Please Enter 8 Digits fx 44444444");
	f.phone.focus();
	return false;
	}
	
	return true;
}
</script>
</div>
   </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>