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
            return $this->insert($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid);
        }
    }
    protected function insert($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid){
        $query  = "INSERT INTO `users` (`fname`, `lname`, `uemail`, `address`, `zipcode`, `city`, `phone`, `fk_users_id`) 
        VALUES ('$fname', '$lname', '$email', '$address', '$zipcode', '$city', '$phone', '$uid')";
        $result = $this->db->query($query) or die($this->db->error);
        return $this->db->insert_id;
    }
    protected function update($fname, $lname, $email, $address, $zipcode, $city, $phone, $uid){
        $query = "UPDATE users AS u
                       ON u.uid = u.fk_users_id 
            SET u.fname = '$fname',
                u.lname = '$lname',
                u.uemail  = '$email',
                u.address = '$address',
                u.zipcode = '$zipcode',
                u.city = '$city',
                u.phone = '$phone'
           WHERE u.uid = $uid";
        return $this->db->query($query);
    }
}