<?php
session_start();
	
require ("connect.php");


 if (isset($_POST['name'])) {
    $guest_name = $mysqli->real_escape_string($_POST['name']);

}else{
		die("Please, insert your name! ");
	}
	
if (isset($_POST['loginame'])) {
    $login_name = $mysqli->real_escape_string($_POST['loginame']);
    }else{
		die("Please, insert a Login Name");

	}

if (isset($_POST['email']) && strpos($_POST['email'],'@') !== false) {
    $email = $mysqli->real_escape_string($_POST['email']);
}else{
		die("Please, enter your email!");
	}

if (isset($_POST['msg'])) {
    $message = $mysqli->real_escape_string($_POST['msg']);
    }else{
		die("Please, leave a message =)");

	}

$exist = $mysqli->prepare("SELECT message FROM Guest WHERE loginName = ?");
$exist -> bind_param('s', $login_name);
$exist -> execute();	
$exist ->store_result();
$size = $exist -> num_rows;
if($size == 0){
 $stmt = $mysqli->prepare("INSERT INTO Guest(guestName, loginName, email, message) Values(?,?,?,?)");
            $stmt->bind_param('ssss', $guest_name, $login_name, $email, $message );
            $stmt->execute();	
            $stmt->close();
            $mysqli->close();
            header('Location: index.html');
	}
else { 
$exist -> bind_result($ms);
$exist -> fetch();
echo "$ms";
		}
?>