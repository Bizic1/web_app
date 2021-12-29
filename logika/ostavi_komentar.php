<?php
session_start();

if(!isset($_SESSION['korisnik_id'])){
	header('Location: ../index.php');
	die();
}
if(!isset($_POST['komentar'])){
	header('Location: ../stranica.php');
	die();
}

$korisnik_id = $_SESSION['korisnik_id'];
$stranica_id = $_POST['stranica_id'];
$komentar = $_POST['komentar'];


require_once __DIR__ . '/../tabele/Komentar.php';
require_once __DIR__ . '/../tabele/Korisnik.php';
require_once __DIR__ . '/../tabele/Stranica.php';
require_once __DIR__ . '/../tabele/Meni.php';

$komentar = Komentar::upisi_komentar($korisnik_id, $stranica_id, $komentar);
$korisnik = Korisnik::getById($korisnik_id, 'korisnici', 'korisnik');
$stranica = Stranica::getById($stranica_id, 'stranice', 'Stranica');
$meni = Meni::getById($stranica->meni_id, 'meni', 'Meni');

if(isset($_POST['ajax'])){
echo '{"komentar":"'. $komentar->komentar.'",'.
'"autor":"'.$korisnik->ime_prezime.'",'.
'"vreme":"'.$komentar->formatirano_vreme().'"}';
}
else {
header('Location: ../stranica.php?slug='.$meni->slug);
}