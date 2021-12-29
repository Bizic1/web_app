<?php
require_once __DIR__ . '/Tabela.php';
require_once __DIR__ . '/Korisnik.php';
require_once __DIR__ . '/Stranica.php';

class Komentar extends Tabela {
	public $id;
	public $komentar;
	public $korisnik_id;
	public $stranica_id;
	public $vreme;

    public function formatirano_vreme() {
    	return date('d.m.Y. H:i', strtotime($this->vreme));
    }

	public function getKorisnik(){
		return Korisnik::getById($this->korisnik_id, 'korisnici', 'Korisnik');
	}

	public function getStranica() {
		return Stranica::getById($this->stranica_id, 'stranice', 'Stranica');
	}

	public static function upisi_komentar($korisnik_id, $stranica_id, $komentar) {
	$db = Database::getInstance();
	$query = 'INSERT INTO komentari (korisnik_id, stranica_id, komentar) ' .
	'VALUES (:kid, :sid, :k)';
	$params = [
    ':kid' => $korisnik_id,
    ':sid' => $stranica_id,
    ':k' => $komentar
	];

	$db->insert('Komentar', $query, $params);

	$id = $db->lastInsertId();
	$komentar = self::getById($id, 'komentari', 'Komentar');
	return $komentar;
	}
	public static function getAllByStranicaId($stranica_id) {
		$db = Database::getInstance();

		$query = 'SELECT * FROM komentari ' .
		'WHERE stranica_id = :sid '.
		'ORDER BY vreme DESC';
		$params = [
        ':sid' => $stranica_id
		];

		return $db->select('Komentar', $query, $params);
	}

	public static function obrisi($id){
    $db = Database::getInstance();
    $query = 'DELETE FROM komentari WHERE id = :id';
    $params = [
     ':id' => $id
    ];

    $db->delete($query, $params);
	}
}