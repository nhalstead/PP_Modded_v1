<?php
require_once("db_config.php");
class User {
	protected $db;
	public $id = null;
	private static $instance = null;

	/**
	 * Create an Instace of the User Class and Return it.
	 * @return User
	 */
	public static function getInstance(){
		if(self::$instance == null){
			self::$instance = new User();
		}
		return self::$instance;
	}

	/**
	 * Get the Currrent User Session and return the User Data.
	 * @return array|bool Array of the User Data or false if none exists.
	 */
	public static function getUser($i = null){
		// If Given a User Session, Check and Use it.
		if($i !== null && $i instanceof User){
			$use = $i;
		}
		else{
			$use = self::getInstance();
		}

		// If the Session is Valid, Pull the User Data otherwise return false.
		if(isset($_SESSION['uid'])){
			return $use->get_user_by_id($_SESSION['uid']);
		}
		else {
			return false;
		}
	}

	/**
	 * Override the current Value of the Instance.
	 */
	public static function setInstance($i){
		self::$instance = $i;
	}

	/**
	 * Check the Instance Var in the Class.
	 * @return bool If Instance is defined.
	 */
	public static function hasInstance(){
		if(isset(self::$instance) && self::$instance !== null){
			return true;
		}
		return false;
	}

	/**
	 * Update User Account Details
	 * @return bool If the Update was Good.
	 */
	public static function updateUser($uid, $fname, $lname, $username, $email, $password) {
		$i = self::getInstance();
		return $i->update_user($uid, $fname, $lname, $username, $email, $password);
	}

	/**
	 * Update User Account Profile Details
	 * @return bool If the Update was Good.
	 */
	public static function updateProfile($uid, $fname, $lname, $email, $address, $zipcode, $city, $phone) {
		$i = self::getInstance();
		return $i->update_profile($uid, $fname, $lname, $email, $address, $zipcode, $city, $phone);
	}

	public function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if(!class_exists("DB_con")){
			throw new Exception('DB_con Class does NOT Exist! Please Load the Class to Operate!');
		}
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}

	protected function cleanMyStuff(&$in = ""){
		$in = mysqli_real_escape_string($this->db, $in);
	}

	/**
	 * For Registration, Create new User
	 * @return bool If the User was Created
	 */
	public function reg_user($fname, $lname, $username, $email, $password){
		$this->cleanMyStuff($fname);
		$this->cleanMyStuff($lname);
		$this->cleanMyStuff($username);
		$this->cleanMyStuff($email);
		$this->cleanMyStuff($password);

		$password = sha1($password);
		// Check if the Username or Email is already in use by another User.
		$query = "SELECT * FROM `users` WHERE `uname`='$username' OR `uemail`='$email'";
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;

		// If the Username & the Email are not used already then register the account.
		if($count_row == 0){
			$query = "INSERT INTO `users` SET `fname` = '$fname', `lname` = '$lname', `uname` = '$username', `upass` = '$password', `uemail` = '$email'";
			$result = $this->db->query($query) or die($this->db->error);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * For Admins, Update the User Account
	 * @see reg_user
	 * @return bool If the User was Updated
	 */
	public function update_profile($uid, $fname, $lname, $email, $address, $zipcode, $city, $phone){
		$this->cleanMyStuff($uid);
		$this->cleanMyStuff($fname);
		$this->cleanMyStuff($lname);
		$this->cleanMyStuff($email);
		$this->cleanMyStuff($address);
		$this->cleanMyStuff($zipcode);
		$this->cleanMyStuff($city);
		$this->cleanMyStuff($phone);

		$password = sha1($password);
		// Check if the UID is registerd.
		$query = "SELECT * FROM `users` WHERE `uid`='$uid'";
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;

		// If the Username & the Email are not used already then register the account.
		if($count_row !== 0){
			$query = "UPDATE  `users` SET  `fname` = '$fname', `lname` = '$lname', `uname` = '$username', `upass` = '$password', `uemail` = '$email' WHERE  `uid` ='$uid'";
			$result = $this->db->query($query) or die($this->db->error);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * For Users, Update Profile
	 * @see reg_user
	 * @return bool If the User was Updated
	 */
	public function update_user($uid, $fname, $lname, $username, $email, $password){
		$this->cleanMyStuff($uid);
		$this->cleanMyStuff($fname);
		$this->cleanMyStuff($lname);
		$this->cleanMyStuff($username);
		$this->cleanMyStuff($email);
		$this->cleanMyStuff($password);

		$password = sha1($password);
		// Check if the UID is registerd.
		$query = "SELECT * FROM `users` WHERE `uid`='$uid'";
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;

		// If the Username & the Email are not used already then register the account.
		if($count_row !== 0){
			$query = "UPDATE  `users` SET  `fname` = '$fname', `lname` = '$lname', `uname` = '$username', `upass` = '$password', `uemail` = '$email' WHERE  `uid` ='$uid'";
			$result = $this->db->query($query) or die($this->db->error);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * For Users, Update Password
	 * @see reg_user
	 * @return bool If the User was Updated
	 */
	public function update_password($uid, $username, $password){
		$this->cleanMyStuff($uid);
		$this->cleanMyStuff($username);
		$this->cleanMyStuff($password);

		$password = sha1($password);
		// Check if the UID is registerd.
		$query = "SELECT * FROM `users` WHERE `uid`='$uid'";
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;

		// If the Username & the Email are not used already then register the account.
		if($count_row !== 0){
			$query = "UPDATE  `users` SET  `fname` = '$fname', `lname` = '$lname', `uname` = '$username', `upass` = '$password', `uemail` = '$email' WHERE  `uid` ='$uid'";
			$result = $this->db->query($query) or die($this->db->error);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * For Users, Check if Passwords Match
	 * @return bool If the Password Matched
	 */
	public function match_password($uid, $username, $password){
		$this->cleanMyStuff($uid);
		$this->cleanMyStuff($username);
		$this->cleanMyStuff($password);

		$password = sha1($password);
		// Check if the UID is registerd.
		$query = "SELECT * FROM `users` WHERE `uid`='$uid'";
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;

		// If the Username & the Email are not used already then register the account.
		if($count_row !== 0){
			$query = "UPDATE  `users` SET  `fname` = '$fname', `lname` = '$lname', `uname` = '$username', `upass` = '$password', `uemail` = '$email' WHERE  `uid` ='$uid'";
			$result = $this->db->query($query) or die($this->db->error);
			return true;
		} else {
			return false;
		}
	}


	/**
	 * For Login Processes, Create the Session and store it.
	 * @return bool If User can Login
	 */
	public function check_login($emailusername, $password){
		$this->cleanMyStuff($emailusername);
		$this->cleanMyStuff($password);
		$password = sha1($password);

		$query = "SELECT `uid` FROM `users` WHERE `uemail`='$emailusername' OR `uname`='$emailusername' AND `upass`='$password'";
		$result = $this->db->query($query) or die($this->db->error);
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		$count_row = $result->num_rows;

		if ($count_row == 1) {
				unset($_SESSION['permissions']);
				$_SESSION['login'] = true; // this login var will use for the session thing
				$_SESSION['uid'] = $user_data['uid'];
				$_SESSION['role_id'] = $user_data['fk_role_id'];
				return true;
		}
		else{
			return false;
		}
	}

	/**
	 * Return the Current Status of the User's Profile
	 * @see fetch_role
	 * @return string User Highest Role
	 */
	public function get_status($uid){
		$this->cleanMyStuff($uid);
		$query = "SELECT * FROM  `roles` INNER JOIN  `roles_and_permissions` ON
				`roles_and_permissions`.`permission_id` =  `roles`.`role_id` WHERE
				`uid` = ".$uid." ORDER BY  `roles_and_permissions`.`weight` DESC  LIMIT 0 , 30";
		$result = $this->db->query($query) or die($this->db->error);
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
		if ($user_data) {
			$role = $user_data['role_name'];
		} else {
			$role = 'GUEST';
		}
		return $role;
	}

	/**
	 * Gets the Primary Role of the User's Account
	 * @return string User Highest Role (In Upper Format)
	 */
  public function fetch_role($uid) {
		$this->cleanMyStuff($udi);
		// User Session Exists
			$query = "SELECT * FROM  `roles` INNER JOIN  `roles_and_permissions` ON
				`roles_and_permissions`.`permission_id` =  `roles`.`role_id` WHERE
				`uid` = ".$uid." ORDER BY  `roles_and_permissions`.`weight` DESC  LIMIT 0 , 30";
			$result = $this->db->query($query) or die($this->db->error);
			$user_data = $result->fetch_array(MYSQLI_ASSOC);
		if(!empty($user_data)){
			return strtoupper($user_data['role_name']);
		} else {
			return "GUEST";
		}
  }

	/**
	 * Get All of the Roles the User has Assigned to them.
	 * @return array Role List
	 */
	function fetch_roles($uid) {
		$user_data = array();
		$query = "SELECT * FROM  `roles` INNER JOIN  `roles_and_permissions` ON
			`roles_and_permissions`.`permission_id` =  `roles`.`role_id` WHERE
			`uid` = ".$uid." ORDER BY  `roles_and_permissions`.`weight` DESC  LIMIT 0 , 30";
		// User Session Exists
			$result = $this->db->query($query) or die($this->db->error);
			while($tmp = $result->fetch_array(MYSQLI_ASSOC)){
				$user_data[] = strtoupper($tmp['role_name']);
			}
		// RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row
		if(!empty($user_data)){
			return $user_data;
		} else {
			return array("GUEST");
		}
  }

	/**
	 * Get All of the Users in the Database.
	 * @return array $user_data
	 */
  public function fetch_all_users() {
		$user_data = array();
		$query = "SELECT * FROM  `users`WHERE `uid` != 0 ORDER BY `uid` DESC  LIMIT 0 , 30";
		// User Session Exists
			$result = $this->db->query($query) or die($this->db->error);
			while($tmp = $result->fetch_array(MYSQLI_ASSOC)){
				unset($tmp['upass']); // Make it safe
				$user_data[] = $tmp;
			}
		return $user_data;
  }

	/**
	 * Get All of the Users in the Database THAT HAVE ROLES.
	 * @return array $user_data
	 */
  public function fetch_all_users_wr() {
		$user_data = array();
		$query = "SELECT * FROM  `users` INNER JOIN  `roles_and_permissions` ON
			`roles_and_permissions`.`uid` =  `users`.`uid` WHERE
			`users`.`uid` != 0 ORDER BY  `roles_and_permissions`.`weight` DESC  LIMIT 0 , 30";
		// User Session Exists
			$result = $this->db->query($query) or die($this->db->error);
			while($tmp = $result->fetch_array(MYSQLI_ASSOC)){
				$user_data[] = $tmprole_name;
			}
		return $user_data;
  }

	/**
	 * Check to See if the User has a Specific Role
	 * @return bool in_array
	 */
	public function has_role($uid, $roleIn = "GUEST"){
		if(is_array($roleIn)){
				$rolesGet = $this->fetch_roles($uid);
				foreach($roleIn as $r){
					if(in_array($r, $rolesGet)) {
						return true;
					}
				}
				return false;
		}
		else{
			$rolesGet = $this->fetch_roles($uid);
			return in_array($roleIn, $rolesGet);
		}
	}

	/**
	 * Get the User By Id.
   * @return array MySQL Profile
	 */
	public function get_user_by_id($id){
    $query = "SELECT * FROM `users` WHERE `uid` = " . (int) $id . " LIMIT 1";
    $result = $this->db->query($query) or die($this->db->error);
    return $result->fetch_assoc();
  }

  /**
	 * Starting the Session
	 * @return bool false
	 * @return string User Login
	 */
  public function get_session(){
		if(isset($_SESSION['login'])){
			return $_SESSION['login'];
		}
		else {
			return false;
		}
	}

	/**
	 * Do a Cleanup of the Session
	 */
  public function user_logout() {
		$_SESSION['login'] = FALSE;
		unset($_SESSION);
		session_destroy();
	}
}


function clean($in = ""){
	global $mysqli;
	return mysqli_real_escape_string($mysqli, $in);
}
function c($in = ""){ return clean($in); }

?>
