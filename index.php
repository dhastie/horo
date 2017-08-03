<?php
include('login.php'); // Includes Login Script

?>
<!DOCTYPE html>
<html>
<head>
<title>EMC &ndash; HORODATEUR</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page" style="background-color:#000; color:#fff;">
<img src="http://www.emcqc.com/EMHQC/wp-content/uploads/2015/10/Logo_EMH.png" width="100%">
<h2>HORODATEUR</h2>
<div id="login">

<form id="frmHoro" action="" method="post">
<label>ID : </label>
<input id="name" name="username"  type="text" value=" ">
<hr/>
<label>NIP : </label>
<input id="password" name="password"  type="password" >
<hr style="margin-bottom:20px;"/>
<div align="center"><input name="submit" type="submit" value="Login" style="background-color:#8fb757;width:50%; color:#fff;"></div>
<span><?php echo $error; ?></span>
</form>
</div>
</div>
</body>
</html>