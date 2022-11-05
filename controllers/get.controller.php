<?php

require_once "models/get.model.php";

class GetController{

	/*Peticion GET sin Filtro*/
	static public function getData($table, $select, $orderBy, $orderMode, $startAt, $endAt){

		$response = GetModel::getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);

		$return = new GetController();
		$return -> fnResponse($response);

	}

	/*Peticiones GET con Filtro*/
	static public function getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){

		$response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);
		/*echo '<pre>'; print_r($response); echo '</pre>';
		return;*/

		$return = new GetController();
		$return -> fnResponse($response);

	}

	/*Peticiones Get sin filtro entre tablas relacionadas*/
	static public function getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt){

		$response = GetModel::getRelData($rel, $type, $select, $orderBy, $orderMode, $startAt, $endAt);

		$return = new GetController();
		$return -> fnResponse($response);

	}

	/*Peticiones Get con filtro entre tablas relacionadas*/
	static public function getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt){

		$response = GetModel::getRelDataFilter($rel, $type, $select, $linkTo, $equalTo, $orderBy, $orderMode, $startAt, $endAt);

		$return = new GetController();
		$return -> fnResponse($response);

	}	

	/*Peticiones Get para el buscador sin relaciones*/
	static public function getDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt){

		$response = GetModel::getRelDataSearch($table, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt);
/*		echo '<pre>'; print_r($response); echo '</pre>';
		return;*/

		$return = new GetController();
		$return -> fnResponse($response);

	}

	/*Peticiones Get para el buscador con relaciones*/
	static public function getRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt){

		$response = GetModel::getRelDataSearch($rel, $type, $select, $linkTo, $search, $orderBy, $orderMode, $startAt, $endAt);

		$return = new GetController();
		$return -> fnResponse($response);

	}	

	/*Peticiones GET para selección de rangos*/
	static public function getDataRange($table, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo){

		$response = GetModel::getDataRange($table, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

		$return = new GetController();
		$return -> fnResponse($response);

	}

	/*Peticiones GET para selección de rangos con tablas relacionadas*/
	static public function getRelDataRange($rel, $type, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo){

		$response = GetModel::getRelDataRange($rel, $type, $select, $linkTo, $between1, $between2, $orderBy, $orderMode, $startAt, $endAt, $filterTo, $inTo);

		$return = new GetController();
		$return -> fnResponse($response);

	}	


	/*Respuestas del Controlador*/
	public function fnResponse($response){

		if(!empty($response)){

			$json = array(
				'status' => 202,
				'total' => count($response),
				'results' => $response
			);

		}else{
			$json = array(
				'status' => 404,
				'results' => 'Not Found'
			);			
		}

		echo json_encode($json, http_response_code($json["status"]));
	}
}