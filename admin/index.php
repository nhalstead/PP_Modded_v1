<?php require_once("../include/class.user.php"); ?>
smartipants

<?php
function fetch_role(){
    $role = "GUEST";
    if(isset($_SESSION['id_user'])){
        // User exists
        $sql = sprintf("SELECT * FROM users WHERE id_user='%s' LIMIT 1",
		mysql_real_escape_string($_SESSION['id_user']));

        // RUN THE MYSQL QUERY TO FETCH THE USER, SAVE INTO $row

        if(!empty($row)){
            $role = $user_row['role'];
        }
    }
    return $role;
}

switch(strtoupper(fetch_role())){
	case "GUEST": 
		echo "Welcome Guest!";
	break;
	
	case "MEMBER":
		echo "Hello Memeber!";
	break;
	
	case "ADMIN":
		echo "Hello Admin!";
	break;
	
	case "":
		http_response_code(500);
		echo "Please contact support, You Account has on perms.";
		exit();
	break;
	default:
		http_response_code(500);
		echo "Programming Error! User has no case!";
		exit();
	break;
}
?>