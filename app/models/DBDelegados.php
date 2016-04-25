<?php

/**
* Clase que contiene métodos para acceder a la BD de Delegados.
**/
class DBDelegados {

	/**
	* Obtiene el rol de un usuario de la BD.
	*
	* @param  string $nia 		nia del usuario a buscar
	* @return string $data 	rol del usuario en la BD.
	**/
	public static function getRol($nia) {
		$db = new DB(SQL_DB_DELEGADOS);
		$db->run('SELECT permisos.rol FROM permisos LEFT JOIN personas ON personas.id = permisos.id
				where personas.nia = ? AND permisos.app_id = 3;',array($nia));
		$data = $db->data();
		return $data[0]['rol'];
	}
}