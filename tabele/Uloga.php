<?php
require_once __DIR__ . '/Tabela.php';
class Uloga extends Tabela {
	public $id;
	public $naziv;
	public $prioritet;

	public static function getByName($naziv) {
		$db = Database::getInstance();

		$query = 'SELECT * ' .
		         'FROM uloge '.
		         'WHERE naziv = :n';

		 $params = [
		 ':n' => $naziv
		 ];       

		 $uloge = $db->select('Uloga', $query, $params);

		 foreach($uloge as $uloga) {
		 	return $uloga;
		 }
		 return null;

	}

	public static function getAll() {
		$db = Database::getInstance();
		$query = 'SELECT * FROM uloge';

		return $db->select('Uloga', $query);
	}


	public static function snimi($naziv, $prioritet) {
		$db = Database::getInstance();

		$query = 'INSERT INTO uloge (naziv, prioritet) ' .
		'VALUES (:n, :p)';

		$params = [
        ':n' => $naziv,
        ':p' => $prioritet
		];

		$id = $db->insert('Uloga', $query, $params);

		return self::getById($id, 'uloge', 'Uloga');
	}

	public static function obrisi($id){
    $db = Database::getInstance();
    $query = 'DELETE FROM uloge WHERE id = :id';
    $params = [
     ':id' => $id
    ];

    $db->delete($query, $params);
	}

	public static function izmeni($id, $naziv, $prioritet) {
		$db = Database::getInstance();
		$query = 'UPDATE uloge '.
		'SET naziv = :n, prioritet = :p '.
		'WHERE id = :id';

	    $params = [
        ':id' => $id,
        ':n' => $naziv,
        ':p' => $prioritet
	    ];

	    $db->update('Uloga', $query, $params);

	    return self::getById('$id', 'uloge', 'Uloga');
	}
}