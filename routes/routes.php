<?php

$routesArray = explode('/', $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*Cuando no se hace ninguna petición a la API*/
if(count($routesArray) == 0){
	$json = array(
		'status' => 404,
		'result' => 'Not found'
	);

	echo json_encode($json, http_response_code($json["status"]));

	return;
}

/*echo '<pre>'; print_r($routesArray); echo '</pre>';*/

/*Cuando si se hace petición a la API*/
if(count($routesArray) == 1 && isset($_SERVER['REQUEST_METHOD'])){
	/*Petición GET*/
	if($_SERVER['REQUEST_METHOD'] == "GET"){

		include "services/get.php";

	}
	/*Petición POST*/
	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$json = array(
			'status' => 202,
			'result' => 'Solicitud POST'
		);

		echo json_encode($json, http_response_code($json["status"]));
	}
	/*Petición PUT*/
	if($_SERVER['REQUEST_METHOD'] == "PUT"){

		$json = array(
			'status' => 202,
			'result' => 'Solicitud PUT'
		);

		echo json_encode($json, http_response_code($json["status"]));
	}
	/*Petición DELETE*/
	if($_SERVER['REQUEST_METHOD'] == "DELETE"){

		$json = array(
			'status' => 202,
			'result' => 'Solicitud DELETE'
		);

		echo json_encode($json, http_response_code($json["status"]));
	}
}



