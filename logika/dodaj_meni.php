<?php
session_start();
if(!isset($_SESSION['korisnik_admin_id'])){
	header('Location: ../index.php');
	die();
}
require_once __DIR__ . '/../tabele/Meni.php';
$natpis = $_POST['natpis'];
if(empty($_POST['slug']))
{
$slug = null;
}
else {
$slug = $_POST['slug'];	
}

if(empty($_POST['url'])){
$url = null;
}
else {
$url = $_POST['url'];
}

Meni::snimi($natpis, $slug, $url);
header('Location: ../admin.php?strana=meni');