<?php
include_once "../inc/connexion.php";
session_start(); // Starting Session

$error=''; // Variable To Store Error Message

if(isset($_SESSION['username']))
unset($_SESSION['username']);

if (!empty($_SERVER["HTTP_CLIENT_IP"]))
{
 //check for ip from share internet
 $ip = $_SERVER["HTTP_CLIENT_IP"];
}
elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
{
 // Check for the Proxy User
 $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
}
else
{
 $ip = $_SERVER["REMOTE_ADDR"];
}

//$sqlip = "SELECT ip_num FROM fd_horo_ip WHERE ip_num = '" . $ip . "'";
$sqlip = "SELECT ip_num FROM fd_horo_ip";
$result = $conn->query($sqlip);

if ($result->num_rows > 0) {
	//echo "Accès authorisé" . "<br/>";

if (isset($_POST['submit'])) {
	
	
if (empty($_POST['username']) || empty($_POST['password'])) {

}

else
{
		
// Define $username and $password
$username=trim($_POST['username']);
$password=trim($_POST['password']);

$_SESSION["username"] = $username;
//echo $_SESSION["username"];


// SQL query to fetch information of registerd users and finds user match.
$sql = "SELECT uid, nip FROM fd_contact WHERE uid = '" . $username . "' AND nip = '" . $password . "' AND staff=1" ;
//echo $sql;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
	while($row = $result->fetch_assoc()) {
		$uid = $row["uid"];
		header('Location: punch.php?id_staff='.$uid);    
	}
} else {
    echo "Invalide!";
}
	
}
}

} else {
	echo "Accès refusé!";
}

$conn->close();
?>
