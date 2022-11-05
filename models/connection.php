<?php


class Connection{

	/*Información de la base de datos*/
	static public function infoDatabase(){

		$infoDB = array(
			"database" => "database-1",
			"user" => "root",
			"pass" => ""
		);

		return $infoDB;
	}

	/*Conexión a la base de datos*/
	static public function connect(){
		try{
			$link = new PDO(
				"mysql:host=localhost;dbname=".Connection::infoDatabase()["database"],
				Connection::infoDatabase()["user"],
				Connection::infoDatabase()["pass"]
			);

			$link->exec("set names utf8");

		}catch(PDOException $e){
			die("Error: ".$e->getMessage());
		}
		return $link;
	}

	/*Validar existencia de una tabla en la DB*/
	static public function getColumnData($table, $columns){

		//Traer el nombre de la base de datos
		$database = Connection::infoDatabase()["database"];

		//Traer todas las columnas de una tabla
		$validate = Connection::connect()
		->query("SELECT COLUMN_NAME AS item FROM information_schema.columns WHERE table_schema = '$database' AND table_name = '$table'")
		->fetchALL(PDO::FETCH_OBJ);

		//Validamos existencia de la tabla
		if (empty($validate)){
			return null;
		}else{
			//Ajuste a solicitud a columnas globales
			if ($columns[0] == "*"){
				array_shift($columns);
			}

			//Validar existencia de columnas

			$sum = 0;

			foreach ($validate as $key => $value) {

				//in_array($value->item, $columns)
				//echo '<pre>'; print_r(in_array($value->item, $columns)); echo '</pre>';

				$sum += in_array($value->item, $columns);
				
				
			}
			//echo '<pre>'; print_r($sum); echo '</pre>';

			//count($column);
			//echo '<pre>'; print_r(count($columns)); echo '</pre>';

			return $sum == count($columns) ? $validate : null;
		}

	}
}