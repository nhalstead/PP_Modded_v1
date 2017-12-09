<?php 
require_once("db_config.php");
class User {
	protected $db;
	public function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}
	
	protected function cleanMyStuff(&$in = ""){
		$in = mysqli_real_escape_string($this->db, $in);
	}
	
	/*
	 * For Registration
	 */
	public function reg_user($fname,$lname,$username,$email,$password){
		$this->cleanMyStuff($fname);
		$this->cleanMyStuff($lname);
		$this->cleanMyStuff($username);
		$this->cleanMyStuff($email);
		$this->cleanMyStuff($password);
		
		$password = sha1($password);
		//Check if the Username or Email is already in use by another User.
		$query = "SELECT * FROM users WHERE uname='$username' OR uemail='$email'";
		$result = $this->db->query($query) or die($this->db->error);
		$count_row = $result->num_rows;
		
		//If the Username & the Email are not used already then register the account.
		if($count_row == 0){
			$query = "INSERT INTO users SET fname='$fname', lname='$lname', uname='$username', upass='$password', uemail='$email'";
			$result = $this->db->query($query) or die($this->db->error);
			return true;
		} else {
			return false;
		}
	}   
	
	/*
	 * For Login Processes
	 */
	public function check_login($emailusername, $password){
		$this->cleanMyStuff($emailusername);
		$this->cleanMyStuff($password);
		$password = sha1($password);
		
		$query = "SELECT uid FROM users WHERE uemail='$emailusername' OR uname='$emailusername' AND upass='$password'";
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
			$role = 'PUBLIC';
		}
		return $role;
	}

    function fetch_role($uid) {
		$this->cleanMyStuff($udi);
		// User Session Exists
			$query = "SELECT * FROM  `roles` INNER JOIN  `roles_and_permissions` ON 
				`roles_and_permissions`.`permission_id` =  `roles`.`role_id` WHERE 
				`uid` = ".$uid." ORDER BY  `roles_and_permissions`.`weight` DESC  LIMIT 0 , 30";
			$result = $this->db->query($query) or die($this->db->error);
			$user_data = $result->fetch_array(MYSQLI_ASSOC);
			//echo $user_data['role_name'];
		// RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row
		if(!empty($user_data)){
			return strtoupper($user_data['role_name']);
		} else {
			return "PUBLIC";
		}
    }
	
	/**
	 * Get All of the Roles the User has Assigned to them.
	 */
    function fetch_roles($uid) {
		$user_data = array();
		$query = "SELECT * FROM  `roles` INNER JOIN  `roles_and_permissions` ON 
			`roles_and_permissions`.`permission_id` =  `roles`.`role_id` WHERE 
			`uid` = ".$uid." ORDER BY  `roles_and_permissions`.`weight` DESC  LIMIT 0 , 30";
		// User Session Exists
			$result = $this->db->query($query) or die($this->db->error);
			while($tmp = $result->fetch_array(MYSQLI_ASSOC)){
				$user_data[] = $tmp['role_name'];
			}
		// RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row
		if(!empty($user_data)){
			return $user_data;
		} else {
			return array("PUBLIC");
		}
    }
	
	public function has_role($uid, $role = "GUEST"){
		$roles = $this->fetch_roles($uid);
		return in_array($role, $roles);
	}
	
	public function get_profile($uid){
		$query = "SELECT * FROM users WHERE uid = $uid";
		$result = $this->db->query($query) or die($this->db->error);        
		$user_data = $result->fetch_array(MYSQLI_ASSOC);
	}
	
	public function get_user_by_id($id){
        $query = "SELECT * FROM users WHERE uid = " . (int) $id . " LIMIT 1";
        $result = $this->db->query($query) or die($this->db->error);
        return $result->fetch_assoc();
    }
    
    /*** Starting the session ***/
    public function get_session(){
		if(isset($_SESSION['login'])){
			return $_SESSION['login'];
		}
		else {
			return false;
		}
	}
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