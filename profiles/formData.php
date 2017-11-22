<div class="col-md-10">
<form class="form-horizontal" method="post" action="" onsubmit="return valider(this)">
	<input type="hidden" name="uid" value="<?php echo $userData['uid']; ?>">
	<fieldset> 
		<center>
			<legend>User Profile (All Feilds Required)<?php echo doTell($_SESSION['UPDATE'])?" (Updated)":""; ?></legend>
		</center>
		<div class="form-group">
			<label class="col-md-4 control-label" for="fname">Full name</label>  
			<div class="col-md-4">
				<div class="input-group">
				   <div class="input-group-addon">
						<i class="fa fa-user"></i>
				   </div>
				   <input id="fname" name="fname" type="text" placeholder="" value="<?php echo doTell($userData['fname']); ?>" class="form-control input-md">
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
					<input id="lname" name="lname" type="text" placeholder="" value="<?php echo doTell($userData['lname']); ?>" class="form-control input-md">
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
					<input id="email" name="email" type="text" placeholder="" value="<?php echo doTell($userData['uemail']); ?>" class="form-control input-md">  
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
				   <input id="address" name="address" type="text" placeholder="" value="<?php echo doTell($userData['address']); ?>" class="form-control input-md">
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
					<input id="zipcode" name="zipcode" type="text" placeholder="" maxlength="4" value="<?php echo doTell($userData['zipcode']); ?>" class="form-control input-md">
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
					<input id="city" name="city" type="text" placeholder="" value="<?php echo doTell($userData['city']); ?>" class="form-control input-md">   
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
					<input id="phone" name="phone" type="text" placeholder="" maxlength="8" value=" <?php echo doTell($userData['phone']); ?>" class="form-control input-md">   
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