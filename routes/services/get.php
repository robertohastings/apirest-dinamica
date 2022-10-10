<?php

require_once "controllers/get.controller.php";

$table = $routesArray[1];
$response = GetController::getData($table);
echo '<pre>'; print_r($response); echo '</pre>';



return;

$json = array(
	'status' => 202,
	'result' => 'Solicitud GET'
);

echo json_encode($json, http_response_code($json["status"]));