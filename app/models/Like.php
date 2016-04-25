<?php

/**
* Clase que acompaña a las preguntas y contiene sus likes.
**/
class Like {

 	/** Id del like en la BD **/
	public $id;
	/** Id de la pregunta en la BD **/
	public $id_pregunta;
	/** Id del usuario en la BD **/
	public $uid;
	/** Autor del like **/
	public $author;
	/** Fecha del like **/
	public $date;
	/** Texto de la pregunta **/
	public $text;

	/**
	* Guarda los likes de una pregunta
	*
	* @return void
	*/
	public function save(){
		$db = new DB;
		$db->run('INSERT INTO "like" (id_pregunta, uid, author, date) VALUES (?,?,?,NOW())',
				array($this->id_pregunta,$this->uid, $this->author));
	}

	/**
	* Aumenta los likes de una pregunta en uno.
	*
	* @param 	string	$id 	identificador de la pregunta.
	* @return 	int 	$likes 	Likes de la pregunta.
	**/
	public static function getLikes($id){
		$db = new DB;
		$db->run('SELECT * FROM "like" WHERE id_pregunta=?', array($id));
		$likes = $db->data();
		return count($likes)+1;
	}

	/**
	* Comprueba si el id del usuario ya ha dado like a la pregunta
	*
	* @param 	string 	$author_id 		Identificador de usuario
	* @param 	string 	$id_pregunta 	Identificador de pregunta
	* @return 	boolean 				True si es el autor
	**/

	public static function isSetLike($author_id, $id_pregunta){
		$db = new DB;
		$db->run('SELECT * FROM "like" WHERE uid=? AND id_pregunta=?', array($author_id,$id_pregunta));
		$author = $db->data();
		return (!empty($author)) ? true : false;
	}

	/**
	* Comprueba si el id del usuario se corresponde con el id de la pregunta.
	*
	* @param 	string 	$author_id 		Identificador usuario
	* @param 	string 	$id 			Identificador de la pregunta
	* @return 	boolean 				Devuelve true si es el autor
	**/
	public static function ownLike($author_id,$id){
		$db = new DB;
		$db->run('SELECT * FROM pregunta WHERE uid=? AND id=?', array($author_id,$id));
		$author_pregunta = $db->data();
		return (!empty($author_pregunta)) ? true : false;
	}

	/**
	* Obtiene el id de una pregunta en función del texto.
	*
	* @param 	string $texto 	Contenido que buscar en la pregunta
	* @return 	string $pregunta  Id de la pregunta que se corresponde con $texto
	**/
	public static function getId($texto){
		$db = new DB;
		$db->run('SELECT * FROM pregunta WHERE text=?', array($texto));
		$pregunta = $db->data();
		return $pregunta[0]['id'];
	}

}
