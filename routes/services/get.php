<?php
/*Lo manda llamar routes.php*/
require_once "controllers/get.controller.php";

$table = explode('?', $routesArray[1])[0];

/*
echo '<pre>'; print_r($table); echo '</pre>';

return
*/

$select = $_GET['select'] ?? "*";
$orderBy = $_GET['orderBy'] ?? null;
$orderMode = $_GET['orderMode'] ?? null;
$startAt = $_GET['startAt'] ?? null;
$endAt = $_GET['endAt'] ?? null;

/*
echo '<pre>'; print_r($_GET['equalTo']); echo '</pre>';

return;
*/

$response = new GetController();

/*Peticiones GET con Filtro*/
if(isset($_GET['linkTo']) && isset($_GET['equalTo']) && !isset($_GET['rel']) && !isset($_GET['type']) ){
	
	
	$response -> getDataFilter($table, $select, $_GET['linkTo'], $_GET['equalTo'], $orderBy, $orderMode, $startAt, $endAt);


}else if(isset($_GET['rel']) && isset($_GET['type']) && $table == "relations" && !isset($_GET['linkTo']) && !isset($_GET['equalTo'])){
	/*Peticiones Get sin filtro entre tablas relacionadas*/

	$response -> getRelData($_GET['rel'], $_GET['type'], $select, $orderBy, $orderMode, $startAt, $endAt);

}else if(isset($_GET['rel']) && isset($_GET['type']) && $table == "relations" && isset($_GET['linkTo']) && isset($_GET['equalTo'])){
	/*Peticiones Get con filtro entre tablas relacionadas*/

	$response -> getRelDataFilter($_GET['rel'], $_GET['type'], $select, $_GET['linkTo'], $_GET['equalTo'], $orderBy, $orderMode, $startAt, $endAt);

}else{

	/*Peticion GET sin Filtro*/
	$response -> getData($table, $select, $orderBy, $orderMode, $startAt, $endAt);
}





