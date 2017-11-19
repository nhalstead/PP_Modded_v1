<?php 
require_once("db_config.php");
class User {
	protected $db;
	public function __construct(){
		$this->db = new DB_con();
		$this->db = $this->db->ret_obj();
	}
	
	/*
	 * For Registration
	 */
	public function reg_user($fname,$lname,$username,$email,$password){
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
		$password = sha1($password);
		
		$query = "SELECT uid, fk_role_id from users WHERE uemail='$emailusername' or uname='$emailusername' and upass='$password'";
		
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
			$query = "SELECT role_name FROM roles 
			INNER JOIN users ON fk_role_id = role_id
			WHERE uid = $uid";
			
			$result = $this->db->query($query) or die($this->db->error);        
			$user_data = $result->fetch_array(MYSQLI_ASSOC);
			if ($user_data) {
				$role = $user_data['role_name'];
			} else {
				$role = 'TRIAL';
			}
			return $role;
	}

    function fetch_role($uid) {
        if(isset($_SESSION['role_id'])) {
			// User Session Exists
				$query = "SELECT role_name FROM roles INNER JOIN users ON fk_role_id = role_id WHERE uid = $uid";
				$result = $this->db->query($query) or die($this->db->error);
				$user_data = $result->fetch_array(MYSQLI_ASSOC);
				//echo $user_data['role_name'];
			// RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row
			if(!empty($user_data)){
				return strtoupper($user_data['role_name']);
			} else {
				return "GUEST";
			}
        }
		// If no User Session Exists
		return "GUEST";
    }
	
	public function get_profile($uid){
            $query = "SELECT members.mem_id, users.uid
            FROM members
            INNER JOIN users ON members.fk_users_id = users.uid
            WHERE uid = $uid";
            
            $result = $this->db->query($query) or die($this->db->error);        
            $user_data = $result->fetch_array(MYSQLI_ASSOC);
        
    }
	
	public function get_user_by_id($id){
        $query = "SELECT * FROM users WHERE uid = " . (int) $id . " LIMIT 1";
        $result = $this->db->query($query) or die($this->db->error);
        return $result->fetch_assoc();
    }
    
    /*** starting the session ***/
    public function get_session(){
        return $_SESSION['login'];
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

if(isset($_POST['Submit'])) {		
	require_once ('Member.php');
	$user = new User;
	$member = new Member($mysqli, $user);
	$member->upsert(c($_POST["fname"]), c($_POST["lname"]), c($_POST["email"]), c($_POST["address"]), c($_POST["zipcode"]), c($_POST["city"]), c($_POST["phone"]), $_SESSION['uid']);
	exit();
}
