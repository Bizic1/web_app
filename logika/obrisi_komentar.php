<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: ../index.php');
	die();
}
require_once __DIR__ . '/../tabele/Komentar.php';
try {
Komentar::obrisi($_GET['id']);
header('Location: ../stranica.php');
} catch(Exception $ex) {
	header('Location: ../stranica.php');
}