<?php 
session_start();
if(isset($_SESSION['korisnik_admin_id'])) {
	header('Location: admin.php');
	die();
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Login</title>
	<style>
		form {
			width:50%;
			min-width: 300px;
			border: solid 2px #999;
			padding:30px;
			margin: auto;
		}
		input {
			padding:5px;
			width:100%;
			display:block;
			box-sizing: border-box;

		}
	</style>
</head>
<body>
<form action="logika/prijavi_se.php" method="post">
<input type="text" name="username" placeholder="Korisnicko ime">
<input type="password" name="password" placeholder="Lozinka">
<input type="hidden" name="admin_login" value="true">
<input type="submit" value="Prijavi se">	
<?php if(isset($_GET['error'])) { ?>
<p id="error">Pogresno korisnicko ime/lozinka</p>
<?php } ?>
</form>
</body>
</html>