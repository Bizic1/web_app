<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Promena lozinke</title>
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
<form action="logika/promeni_lozinku.php" method="post">
<input type="text" name="username" placeholder="Korisnicko ime">
<input type="password" name="old_password" placeholder="Stara lozinka">
<input type="password" name="new_password" placeholder="Nova lozinka">
<input type="password" name="new_password_repeat" placeholder="Ponovite novu lozinku">
<input type="submit" value="Promeni lozinku">	
<?php if(isset($_GET['error'])) { ?>
<p id="error">Pogresno korisnicko ime ili stara lozinka.</p>
<?php }?>
</form>
</body>
</html>