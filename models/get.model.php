<?php

require_once "connection.php";

class GetModel{

	/*Peticion GET sin Filtro*/
	static public function getData($table, $select){

		$sql = "SELECT $select FROM $table";

		$stmt = Connection::connect()->prepare($sql);

		$stmt -> execute();

		return $stmt -> fetchALL(PDO::FETCH_CLASS);

	}

	/*Peticiones GET con Filtro*/
	static public function getDataFilter($table, $select, $linkTo, $equalTo){

		$sql = "SELECT $select FROM $table WHERE $linkTo = :$linkTo";

		$stmt = Connection::connect()->prepare($sql);

		$stmt -> bindParam(":".$linkTo, $equalTo, PDO::PARAM:STR);

		$stmt -> execute();

		return $stmt -> fetchALL(PDO::FETCH_CLASS);

	}	
}