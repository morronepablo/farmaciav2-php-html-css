<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Localidad.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$localidad = new Localidad();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='obtener_residencias'){
	$localidad->obtener_residencias();
	$json = array();
	foreach ($localidad->objetos as $objeto) {
		$json[] = $objeto;
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
/*****************************************/

 ?>