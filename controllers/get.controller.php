<?php

require_once "models/get.model.php";

class GetController{

	/*Peticion GET sin Filtro*/
	static public function getData($table, $select){

		$response = GetModel::getData($table, $select);

		$return = new GetController();
		$return -> fnResponse($response);

	}

	/*Peticiones GET con Filtro*/
	static public function getDataFilter($table, $select, $linkTo, $equalTo){

		$response = GetModel::getDataFilter($table, $select, $linkTo, $equalTo);

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