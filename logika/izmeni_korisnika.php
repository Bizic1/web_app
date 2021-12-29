<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: ../index.php');
	die();
}
require_once __DIR__ . '/../tabele/Korisnik.php';
$ime_prezime = $_POST['ime_prezime'];
$username= $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$uloga_id = $_POST['uloga_id'];

if(empty($_POST['uloga_id'])) {
	$uloga_id = null;
} else {
	$uloga_id = $_POST['uloga_id'];
}
$id = $_POST['korisnik_id'];
if(!empty($password))
{
$password = hash('sha512', $password);
Korisnik::izmeni($id, $ime_prezime, $username, $email, $password, $uloga_id);
}
else {
Korisnik::izmeni_bez_passworda($id, $ime_prezime, $username, $email, $uloga_id);
}

header('Location: ../admin.php?strana=korisnici');