<?php

/* Mostrar errores */
ini_set("display_errors", 1);
ini_set("log_errors", 1);
ini_set("error_log", "C:xampp/htdocs/apirest-dinamica/php_error_log");





/*echo '<pre>'; print_r(Connection::infoDatabase()["database"]); echo '</pre>';*/
/*Para probar la connection*/
/*
require_once "models/connection.php";
echo '<pre>'; print_r(Connection::connect()); echo '</pre>';
return;
*/

/*Requerimientos*/
require_once "controllers/route_controller.php";

$index = new RoutesController();
$index -> index();