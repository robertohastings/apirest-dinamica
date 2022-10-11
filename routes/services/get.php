<?php
/*Lo manda llamar routes.php*/
require_once "controllers/get.controller.php";

$table = explode('?', $routesArray[1])[0];

/*
echo '<pre>'; print_r($table); echo '</pre>';

return
*/

$select = $_GET['select'] ?? "*";

/*
echo '<pre>'; print_r($_GET['equalTo']); echo '</pre>';

return;
*/

$response = new GetController();

/*Peticiones GET con Filtro*/
if(isset($_GET['linkTo']) && isset($_GET['equalTo'])){
	
	
	$response -> getDataFilter($table, $select, $_GET['linkTo'], $_GET['equalTo']);

}else{

	/*Peticion GET sin Filtro*/
	$response -> getData($table, $select);
}





