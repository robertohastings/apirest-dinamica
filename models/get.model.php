<?php

require_once "connection.php";

class GetModel{

	static public function getData($table){

		$sql = "SELECT * FROM $table";

		$stmt = Connection::connect()->prepare($sql);

		$stmt -> execute();

		return $stmt -> fetchALL(PDO::FETCH_CLASS);

	}
}