<?php

require_once "connection.php";

class GetModel{

	/*Peticion GET sin Filtro*/
	static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt){

		/*Sin ordenar y sin limitar datos*/
		$sql = "SELECT $select FROM $table";

		
		/*Ordenar datos sin limites*/
		if($orderBy != null && $orderMode != null && $startAt == null && $endAt == null){
			$sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode";
		}

		/*Ordenar datos con limites*/
		if($orderBy != null && $orderMode != null && $startAt != null && $endAt != null){
			$sql = "SELECT $select FROM $table ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
		}	

		/*Sin ordenar y con limitar datos*/
		if($orderBy == null && $orderMode == null && $startAt != null && $endAt != null){
			$sql = "SELECT $select FROM $table LIMIT $startAt, $endAt";
		}				

		$stmt = Connection::connect()->prepare($sql);

		$stmt -> execute();

		return $stmt -> fetchALL(PDO::FETCH_CLASS);

	}

	/*Peticiones GET con Filtro*/
	static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){

		$linkToArray = explode(",", $linkTo); 
		$equalToArray = explode("_", $equalTo);

		$linkText = "";

		if(count($linkToArray)>1){
			foreach ($linkToArray as $key => $value) {
				if($key > 0){
					$linkText .= "AND ".$value." = :".$value." ";
				}
			}
		}

		/*Sin ordenar y sin limitar datos*/
		$sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkText";

		/*Ordenar datos sin limites*/
		if($orderBy != null && $orderMode != null && $startAt == null && $endAt == null){
			$sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkText ORDER BY $orderBy $orderMode";
		}	

		/*Ordenar datos con limites*/
		if($orderBy != null && $orderMode != null && $startAt != null && $endAt != null){
			$sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
		}	

		/*Sin ordenar y con limitar datos*/
		if($orderBy != null && $orderMode != null && $startAt != null && $endAt != null){
			$sql = "SELECT $select FROM $table WHERE $linkToArray[0] = :$linkToArray[0] $linkText LIMIT $startAt, $endAt";
		}	

		$stmt = Connection::connect()->prepare($sql);

		foreach ($linkToArray as $key => $value) {

			$stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);

		}		

		$stmt -> execute();

		return $stmt -> fetchALL(PDO::FETCH_CLASS);

	}	

	/*Peticion GET sin Filtro entre tablas relacionadas*/
	static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt){

		$relArray = explode(",", $rel);
		$typeArray = explode(",", $type);

		$innerJoinText = "";

		if(count($relArray)>1){

			foreach ($relArray as $key => $value) {

				if($key > 0){
					$innerJoinText .= "INNER JOIN ".$value." ON ".$relArray[0].".id_".$typeArray[$key]."_".$typeArray[0] ." = ".$value.".id_".$typeArray[$key]." ";					
				}
			}	

			/*Sin ordenar y sin limitar datos*/
			$sql = "SELECT $select FROM $relArray[0] $innerJoinText";

			
			/*Ordenar datos sin limites*/
			if($orderBy != null && $orderMode != null && $startAt == null && $endAt == null){
				$sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode";
			}

			/*Ordenar datos con limites*/
			if($orderBy != null && $orderMode != null && $startAt != null && $endAt != null){
				$sql = "SELECT $select FROM $relArray[0] $innerJoinText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
			}	

			/*Sin ordenar y con limitar datos*/
			if($orderBy == null && $orderMode == null && $startAt != null && $endAt != null){
				$sql = "SELECT $select FROM $relArray[0] $innerJoinText LIMIT $startAt, $endAt";
			}				

			$stmt = Connection::connect()->prepare($sql);

			$stmt -> execute();

			return $stmt -> fetchALL(PDO::FETCH_CLASS);
		}else{
			return null;
		}

	}

	/*Peticion GET con Filtro entre tablas relacionadas*/
	static public function getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){

		/*Organizo los filtros*/
		$linkToArray = explode(",", $linkTo); 
		$equalToArray = explode("_", $equalTo);

		$linkText = "";

		if(count($linkToArray)>1){
			foreach ($linkToArray as $key => $value) {
				if($key > 0){
					$linkText .= "AND ".$value." = :".$value." ";
				}
			}
		}

		/*Organizo las relaciones*/
		$relArray = explode(",", $rel);
		$typeArray = explode(",", $type);

		$innerJoinText = "";

		if(count($relArray)>1){

			foreach ($relArray as $key => $value) {

				if($key > 0){
					$innerJoinText .= "INNER JOIN ".$value." ON ".$relArray[0].".id_".$typeArray[$key]."_".$typeArray[0] ." = ".$value.".id_".$typeArray[$key]." ";					
				}
			}	

			/*Sin ordenar y sin limitar datos*/
			$sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkText";

			
			/*Ordenar datos sin limites*/
			if($orderBy != null && $orderMode != null && $startAt == null && $endAt == null){
				$sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkText ORDER BY $orderBy $orderMode";
			}

			/*Ordenar datos con limites*/
			if($orderBy != null && $orderMode != null && $startAt != null && $endAt != null){
				$sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
			}	

			/*Sin ordenar y con limitar datos*/
			if($orderBy == null && $orderMode == null && $startAt != null && $endAt != null){
				$sql = "SELECT $select FROM $relArray[0] $innerJoinText WHERE $linkToArray[0] = :$linkToArray[0] $linkText LIMIT $startAt, $endAt";
			}				

			$stmt = Connection::connect()->prepare($sql);

			foreach ($linkToArray as $key => $value) {

				$stmt -> bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR);

			}			

			$stmt -> execute();

			return $stmt -> fetchALL(PDO::FETCH_CLASS);
		}else{
			return null;
		}

	}

	/*Peticiones Get para el buscador sin relaciones*/
	static public function getRelDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt){

		$linkToArray = explode(",", $linkTo); 
		$searchArray = explode("_", $search);

		$linkText = "";

		if(count($linkToArray)>1){
			foreach ($linkToArray as $key => $value) {
				if($key > 0){
					$linkText .= "AND ".$value." = :".$value." ";
				}
			}
		}

		/*Sin ordenar y sin limitar datos*/
		$sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchArray[0]%' $linkText";

		
		/*Ordenar datos sin limites*/
		if($orderBy != null && $orderMode != null && $startAt == null && $endAt == null){
			$sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchArray[0]%' $linkText ORDER BY $orderBy $orderMode";
		}

		/*Ordenar datos con limites*/
		if($orderBy != null && $orderMode != null && $startAt != null && $endAt != null){
			$sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchArray[0]%' $linkText ORDER BY $orderBy $orderMode LIMIT $startAt, $endAt";
		}	

		/*Sin ordenar y con limitar datos*/
		if($orderBy == null && $orderMode == null && $startAt != null && $endAt != null){
			$sql = "SELECT $select FROM $table WHERE $linkToArray[0] LIKE '%$searchArray[0]%' $linkText LIMIT $startAt, $endAt";
			
		}	

/*		echo '<pre>'; print_r($sql); echo '</pre>';
		return;	*/	

		$stmt = Connection::connect()->prepare($sql);

		foreach ($linkToArray as $key => $value) {
			if($key > 0){
				$stmt -> bindParam(":".$value, $searchArray[$key], PDO::PARAM_STR);
			}
		}	

		$stmt -> execute();

		return $stmt -> fetchALL(PDO::FETCH_CLASS);
		
	}

}