<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: ../index.php');
	die();
}
require_once __DIR__ . '/../tabele/Uloga.php';
$naziv = $_POST['naziv'];
$prioritet = $_POST['prioritet'];
$id = $_POST['uloga_id'];
Uloga::izmeni($id, $naziv, $prioritet);

header('Location: ../admin.php?strana=uloge');