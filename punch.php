<?php
session_start();
if(!isset($_SESSION["username"]))
{
	//$conn->close();
	header('Location: index.php');	
	//echo $_SESSION["username"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" rel="stylesheet" type="text/css">
<title>EMH &mdash; Horodateur</title>

<script>
    var now = new Date(<?php echo time() * 1000 ?>);
    function startInterval(){  
        setInterval('updateTime();', 1000);  
    }
    startInterval();//start it right away
    function updateTime(){
        var nowMS = now.getTime();
        nowMS += 1000;
        now.setTime(nowMS);
        var clock = document.getElementById('horloge');
        if(clock){
            clock.innerHTML = now.toTimeString().slice(0, -14);//adjust to suit
			
        }
    } 
	
	function Confirm()
	{
	  var x = confirm("COMFIRMEZ LA SAISIE ");
	  if (x)
		  return true;
	  else
		return false;
	}
	
	function quitter()
	{
		alert(sfsf);
		
	}

</script>


<?php
    Function d1() {  
        $time1 = Time();  
        $date1 = date("h:i:s A",$time1);  
        echo $date1;  
    }
	
	
?> 

<?php

ini_set("date.timezone", "America/New_York");

include_once "../inc/connexion.php";

$punch_in = $_POST["punch_in"];
$punch_out = $_POST["punch_out"];


$id_staff = $_GET["id_staff"];
$msg = "";

if ($punch_in == 1 )
{
	
	$sql_check = "SELECT punch_status FROM fd_clock WHERE id_staff=" . $id_staff . " ORDER BY punch_time DESC LIMIT 1";
	
	$result = $conn->query($sql_check);
	if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		echo $row["punch_status"];
		if($row["punch_status"]==1)
		{
			$msg = "VOUS AVEZ DÉJÀ SAISI UNE ENTRÉE. <br/>CONTACTEZ VOTRE ADMINISTRATEUR.";
		}
		
		else
		{
			$sql = "INSERT INTO fd_clock (id_staff, punch_time, punch_status) VALUES (" . $id_staff . ", '" . date('Y/m/d H:i') . "', '1')";
			if ($conn->query($sql) === TRUE) {
    		//echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		}

	}
	else
		{
			$sql = "INSERT INTO fd_clock (id_staff, punch_time, punch_status) VALUES (" . $id_staff . ", '" . date('Y/m/d H:i') . "', '1')";
			if ($conn->query($sql) === TRUE) {
    		//echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		
    
}
if ($punch_out == 2 )
{
	
	$sql_check = "SELECT punch_status FROM fd_clock WHERE id_staff=" . $id_staff . " ORDER BY punch_time DESC LIMIT 1";
	
	$result = $conn->query($sql_check);
	if ($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
		echo $row["punch_status"];
		if($row["punch_status"]==2)
		{
			$msg = "VOUS AVEZ DÉJÀ SAISI UNE SORTIE.<br/> CONTACTEZ VOTRE ADMINISTRATEUR.";
		}
		
		else
		{
			$sql = "INSERT INTO fd_clock (id_staff, punch_time, punch_status, pause) VALUES (" . $id_staff . ", '" . date('Y/m/d H:i') . "', '2', '1')";
			if ($conn->query($sql) === TRUE) {
    		//echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		}

	}
	else
		{
			$sql = "INSERT INTO fd_clock (id_staff, punch_time, punch_status, pause) VALUES (" . $id_staff . ", '" . date('Y/m/d H:i') . "', '2', '1')";
			if ($conn->query($sql) === TRUE) {
    		//echo "New record created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
    
}
?>

</head>

<body>

<div id="page">

<img src="http://www.emcqc.com/EMHQC/wp-content/uploads/2015/10/Logo_EMH.png" width="100%" style="margin-bottom:20px;">

<div id="profil">
<?php 
$emp_img = "http://ekarnal.com/wp-content/uploads/misc/no-male-300x300.jpg"; 
$sql = "SELECT nom, prenom, photo FROM fd_contact WHERE uid = " . $id_staff ;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	if($row["photo"]) $emp_img = "http://www.emcqc.com/ext/images/photo/" . $row['photo'];; 
		$emp_nom = $row['nom'];
		$emp_prenom = $row['prenom'];
	}
}
?>


<img src="<?php echo $emp_img; ?>" width="150" /><br />
<div style="text-transform:uppercase"><?php echo $emp_prenom . " " . $emp_nom; ?></div>

<hr />

</div>
<hr />
<?php date_default_timezone_set("America/Montreal"); ?>
<?php //echo date("Y-m-d") . date("h:i:sa"); ?>
<?php 

echo date("Y/m/d H:i");
?>

<hr />
<div id="horloge"></div> 

<hr />



<div align="center">

<form action="" method="post" name="frmHoro" id="frmHoro" target="_self" >

<input name="date_time" type="hidden" value="" />

<button name="punch_in" value="1" type="submit" id="punch_in" Onclick="Confirm()" >ENTRÉE</button>
<hr />

<button name="punch_out" value="2" type="submit" id="punch_out" Onclick="Confirm()">SORTIE</button>
<hr />
<?php

if ($msg != "") { ?>

<div id="msgbox">
<?php echo $msg; ?>
</div>
	
<?php }

//$sql = "SELECT * FROM fd_clock WHERE id_staff = " . $id_staff . " AND punch_time > DATE_ADD(NOW(), INTERVAL -1 DAY)" ; 
$sql = "SELECT * FROM fd_clock WHERE id_staff = " . $id_staff . " AND punch_time > CURDATE()" ; 


$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
	$time_out = $row["punch_time"];
	$status = $row["punch_status"];
	$lbl_stat = "Entrée : ";
	if($status == 2) $lbl_stat = "Sortie : ";
	
	$time_out = strtotime($time_out);
	$time_out = date( 'Y-m-d H:i', $time_out );
	echo $lbl_stat . $time_out . "<br/>"; 
	}
}
?>
<hr />
<button name="punch_quit" value="X" type="button" id="punch_quit" onclick="location.href='http://www.emcqc.com/ext/horodateur/index.php'" >QUITTER</button>

</form>

</div>
 

</div> 

<?php $conn->close(); ?>

</body>
</html>