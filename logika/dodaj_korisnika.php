<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: ../index.php');
	die();
}
require_once __DIR__ . '/../tabele/Korisnik.php';
$ime_prezime = $_POST['ime_prezime'];
$username = $_POST['username'];
$password = $_POST['password'];
$password = hash('sha512', $password);
$uloga_id = $_POST['uloga_id'];
$email = $_POST['email'];

Korisnik::register($username, $password, $email, $ime_prezime, $uloga_id);
header('Location: ../admin.php?strana=korisnici');