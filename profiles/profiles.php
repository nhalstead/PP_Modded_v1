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
$userData = $user->get_user_by_id($uid);
?>
<head>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha256-3dkvEK0WLHRJ7/Csr0BZjAWxERc5WH7bdeUya2aXxdU= sha512-+L4yy6FRcDGbXJ9mPG8MT/3UCDzwR9gPeyFNMCtInsol++5m3bk2bXWKdZjvybmohrAsn3Ua5x8gfLnbE1YkOg==" crossorigin="anonymous">
    <!-- Bootstrap Core CSS -->
<!--     <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
    <style>
    body {
        padding-top: 70px;
    }
    .othertop{margin-top:10px;}
    </style>
</head>
<center>
    <a href="../login/home.php">Back</a>
</center> 
<body>
   <div class="container">
<div class="row">
<div class="col-md-10 ">
<form class="form-horizontal" method="post">
	<input type="hidden" name="uid" value="<?php echo $userData['uid']; ?>">
<fieldset> 
<center>
<legend>User profile form requirement</legend>
</center>
<div class="form-group">
  <label class="col-md-4 control-label" for="fname">Full name</label>  
  <div class="col-md-4">
 <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user">
        </i>
       </div>
       <input id="fname" name="fname" type="text" placeholder="" value="<?php echo $userData['fname']; ?>" class="form-control input-md">
      </div>
  </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label" for="lname">Last name</label>  
  <div class="col-md-4">
 <div class="input-group">
       <div class="input-group-addon">
        <i class="fa fa-user"></i>
       </div>
       <input id="lname" name="lname" type="text" placeholder="" value="<?php echo $userData['lname']; ?>" class="form-control input-md">
      </div>
  </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email Address</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-envelope"></i>        
       </div>
    <input id="email" name="email" type="text" placeholder="" value="<?php echo $userData['uemail']; ?>" class="form-control input-md">  
      </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="address">Address</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-address-card" aria-hidden="true"></i> 
       </div>
   <input id="address" name="address" type="text" placeholder="" value="<?php echo $userData['address']; ?>" class="form-control input-md">
      </div>   
  </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label" for="zipcode">Zipcode</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-sticky-note-o"></i>
        
       </div>
   <input id="zipcode" name="zipcode" type="text" placeholder="" value="<?php echo $userData['zipcode']; ?>" class="form-control input-md">
    
      </div>   
  </div>
</div>
    
<div class="form-group">
  <label class="col-md-4 control-label" for="city">City</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-building"></i>       
       </div>
    <input id="city" name="city" type="text" placeholder="" value="<?php echo $userData['city']; ?>" class="form-control input-md">   
      </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="phone">Phone Number</label>  
  <div class="col-md-4">
  <div class="input-group">
       <div class="input-group-addon">
     <i class="fa fa-phone"></i>       
       </div>
    <input id="phone" name="phone" type="text" placeholder="" value="+45 <?php echo $userData['phone']; ?>" class="form-control input-md">   
      </div>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" ></label>  
  <div class="col-md-4">
  <input class="btn btn-success" type="submit" value="Submit" name="Submit">
  </div>
</div>
</fieldset>
</form>
</div>
<div class="col-md-2 hidden-xs">
<img src="http://websamplenow.com/30/userprofile/images/avatar.jpg" class="img-responsive img-thumbnail ">
  </div>
</div>
   </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>