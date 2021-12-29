<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: index.php');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		table, tr, td {
			border: solid 1px #000;
			border-collapse: collapse;
		}
		table img {
			max-width:100px;
		}
		table td {
			padding:0.2em 0.5em;
		}
		td.sadrzaj {
			width:600px;
		}
	</style>
</head>
<body>
	<a href="logika/logout.php">Odjavi se</a>
<nav>
	<ul>
		<li><a href="admin.php?strana=uloge">Uloge</a></li>
		<li><a href="admin.php?strana=korisnici">Korisnici</a></li>
		<li><a href="admin.php?strana=meni">Meni</a></li>
		<li><a href="admin.php?strana=stranice">Stranice</a></li>
		<li><a href="stranica.php">Obicni korisnik</a></li>
	</ul>
</nav>	
<hr>
<?php if(isset($_GET['strana'])): ?>
    <?php if($_GET['strana'] === 'uloge'): ?>
	<?php require_once __DIR__ . '/administracija/uloge.php'; ?>
	<?php elseif($_GET['strana'] === 'korisnici'): ?>
	<?php require_once __DIR__ . '/administracija/korisnici.php'; ?>
	<?php elseif($_GET['strana'] === 'meni'): ?>
	<?php require_once __DIR__ . '/administracija/meni.php'; ?>
	<?php elseif($_GET['strana'] === 'stranice'): ?>
	<?php require_once __DIR__ . '/administracija/stranice.php'; ?>

	<?php endif ?>
<?php endif ?>
</body>
</html>