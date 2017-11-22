<?php
class Member {
    /** @var mysqli */
    protected $db;
    /** @var User */
    protected $user;
    public function __construct(mysqli $db, User $user){
        $this->db = $db;
        $this->user = $user;
    }

    public function upsert($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid){
        $user = $this->user->get_profile($uid);
        if (empty($user)) {
            return $this->update($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid);
        }
    }
    // protected function insert($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid){
        // $query  = "INSERT INTO `users` (`fname`, `lname`, `uemail`, `address`, `zipcode`, `city`, `phone`, `fk_users_id`) 
        // VALUES ('$fname', '$lname', '$email', '$address', '$zipcode', '$city', '$phone', '$uid')";
        // $result = $this->db->query($query) or die("(Member.php) SQL ERROR: ".$this->db->error);
        // return $this->db->insert_id;
    // }
    protected function update($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid){
		$this->cleanMyStuff($fname);
		$this->cleanMyStuff($lname);
		$this->cleanMyStuff($email);
		$this->cleanMyStuff($address);
		$this->cleanMyStuff($zipcode);
		$this->cleanMyStuff($city);
		$this->cleanMyStuff($phone);
		$this->cleanMyStuff($uid);
		
        $query = "UPDATE users AS u
            SET u.uemail  = '$email',
				u.fname = '$fname',
                u.lname = '$lname',
                u.address = '$address',
                u.zipcode = '$zipcode',
                u.city = '$city',
                u.phone = '$phone'
           WHERE u.uid = $uid";
        return $this->db->query($query);
    }
	
	protected function cleanMyStuff(&$in = ""){
		$in = mysqli_real_escape_string($this->db, $in);
	}
}