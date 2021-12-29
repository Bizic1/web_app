<?php
require_once __DIR__ . '/Tabela.php';
class Stranica extends Tabela {
	public $id;
	public $naslov;
	public $kratki_sadrzaj;
	public $sadrzaj;
	public $slika;
	public $meni_id;

	public function getMeni(){
		return Meni::getById($this->meni_id, 'meni', 'Meni');
	}

	public static function getByMeniId($meni_id) {
		$db = Database::getInstance();
		$query = 'SELECT * FROM stranice WHERE meni_id = :mid';
		$params = [
			':mid' => $meni_id
		];

		$stranice = $db->select('Stranica', $query, $params);

		foreach($stranice as $stranica)
			return $stranica;

		return null;
	}


	public static function getAll() {
		$db = Database::getInstance();
		$query = 'SELECT * FROM stranice';

		return $db->select('Stranica', $query);
	}

	public static function snimi($naslov, $kratki_sadrzaj, $sadrzaj, $meni_id, $slika){
		$db = Database::getInstance();

		$query = 'INSERT INTO stranice (naslov, kratki_sadrzaj, sadrzaj, meni_id, slika) ' .
		'VALUES (:n, :ks, :s, :mid, :slika)';

		$params = [
			':n' => $naslov,
			':ks' => $kratki_sadrzaj,
			':s' => $sadrzaj,
			':mid' => $meni_id,
			':slika' => $slika
		];

		$id = $db->insert('Stranica', $query, $params);

		return self::getById($id, 'stranice', 'Stranica');
	}

	public static function obrisi($id){
		$db = Database::getInstance();
		$stranica = self::getById($id,'stranice','Stranica');
		$slika = $stranica->slika;
		$s = explode("/", $slika);
		$slika = $s[count($s)-1];
		unlink(__DIR__.'/../slike/'.$slika);
		$query = 'DELETE FROM stranice WHERE id = :id';
		$params = [
			':id' => $id
		];

		$db->delete($query, $params);
	}

	public static function izmeni($id, $naslov, $kratki_sadrzaj, $sadrzaj, $meni_id, $slika) {
		$db = Database::getInstance();
		$stranica = self::getById($id, 'stranice', 'Stranica');
		if($slika !== null) {
			if($stranica->slika !== $slika) {
				$slika_stara = $stranica->slika;
				$s = explode("/", $slika_stara);
				$slika_stara = $s[count($s)-1];
				unlink(__DIR__.'/../slike/'.$slika_stara);
			} else {
				$slika = $stranica->slika;
			}
		}
		$query = 'UPDATE stranice '.
		'SET naslov = :n, kratki_sadrzaj = :ks, sadrzaj = :s, meni_id = :mid, slika = :slika '.
		'WHERE id = :id';
		$params = [
			':id' => $id,
			':n' => $naslov,
			':ks' => $kratki_sadrzaj,
			':s' => $sadrzaj,
			':mid' => $meni_id,
			':slika' => $slika
		];

		$db->update('Stranica', $query, $params);

		return self::getById($id, 'stranice', 'Stranica');
	}
}