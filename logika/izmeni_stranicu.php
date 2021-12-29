<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: ../index.php');
	die();
}
require_once __DIR__ . '/../tabele/Stranica.php';
$naslov = $_POST['naslov'];
$krati_sadrzaj = $_POST['kratki_sadrzaj'];
$sadrzaj = $_POST['sadrzaj'];
$meni_id = $_POST['meni_id'];

if(empty($_FILES['slika']['name'])) {
	$slika = null;
} else {
	require_once __DIR__ .'/../includes/Upload.php';
$upload = Upload::factory('/../slike');
$upload->file($_FILES['slika']);
$upload->set_allowed_mime_types(['jpg/jpeg', 'image/png', 'image/gif']);
$upload->set_max_file_size(2);
$upload->set_filename($_FILES['slika']['name']);
$upload->save();
$slika = 'slike/'.$_FILES['slika']['name'];
}

$id = $_POST['stranica_id'];
Stranica::izmeni($id, $naslov, $kratki_sadrzaj, $sadrzaj, $meni_id, $slika);

header('Location: ../admin.php?strana=stranice');