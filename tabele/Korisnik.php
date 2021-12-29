<?php
require_once __DIR__ . '/Tabela.php';
require_once __DIR__ . '/Uloga.php';
class Korisnik extends Tabela {
	public $id;
	public $username;
	public $password;
	public $email;
	public $ime_prezime;

	public function getKorisnik(){
		return Korisnik::getById($this->korisnik_id, 'korisnici', 'Korisnik');
	}

	public function getUloga() {
		return Uloga::getByid($this->uloga_id, 'uloge', 'Uloga');
	}

	public static function register($username, $password, $email, $ime_prezime, $uloga_id = null) {
		$db = Database::getInstance();
		$query = 'INSERT INTO korisnici'.'(username, password, email, ime_prezime, uloga_id)'.
		'VALUES (:u, :p, :e, :i, :uid)';
		$params = [
			':u' => $username,
			':p' => $password,
			':e' => $email,
			':i' => $ime_prezime,
			':uid' => $uloga_id
		];

		try {
			$db->insert('Korisnik', $query, $params);
		} catch(Exception $e){
			return false;
		} 

		return $db->lastInsertId();
	}

	public static function login($username, $password) {
		$db = Database::getInstance();

		$query = 'SELECT * FROM  korisnici ' . 
		'WHERE username = :u AND password = :p';
		$params = [
			':u' => $username,
			':p' => $password
		];

		$korisnici = $db->select('Korisnik', $query, $params);
		foreach ($korisnici as $korisnik) {
			return $korisnik;
		}
		return null;
	}

	public static function change_password($username, $new_password) {
	$db = Database::getInstance();
	$query = 'UPDATE korisnici '.
	'SET password = :p '.
	'WHERE username = :u';

	$params = [
		':p' => $new_password,
		':u' => $username 
	];
		$db->update('Korisnik', $query, $params);
	}
    
    public static function getAll() {
		$db = Database::getInstance();
		$query = 'SELECT * FROM korisnici';

		return $db->select('Korisnik', $query);
	}

	public static function obrisi($id) {
		$db = Database::getInstance();
		$query = 'DELETE FROM korisnici WHERE id = :id';
		$params = [
        ':id' => $id
		];
		$db->delete($query, $params);
	}

	public static function izmeni($id, $ime_prezime, $username, $email, $password, $uloga_id){
		$db = Database::getInstance();
		$query = 'UPDATE korisnici '.
		'SET ime_prezime = :i, username = :u, email = :e, password = :p, uloga_id = :uid '.
		'WHERE id = :id';
		$params = [
        ':id' => $id,
        ':i' => $ime_prezime,
        ':u' => $username,
        ':e' => $email,
        ':p' => $password,
        ':uid' => $uloga_id
		];

		$db->update('Korisnik', $query, $params);

		return self::getById($id, 'korisnici', 'Korisnik');
	}
	public static function izmeni_bez_passworda($id, $ime_prezime, $username, $email, $uloga_id){
		$db = Database::getInstance();
		$query = 'UPDATE korisnici '.
		'SET ime_prezime = :i, username = :u, email = :e, uloga_id = :uid '.
		'WHERE id = :id';
		$params = [
        ':id' => $id,
        ':i' => $ime_prezime,
        ':u' => $username,
        ':e' => $email,
        ':uid' => $uloga_id
		];

		$db->update('Korisnik', $query, $params);

		return self::getById($id, 'korisnici', 'Korisnik');
	}

	}