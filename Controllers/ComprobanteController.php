<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Comprobante.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$comprobante = new Comprobante();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'obtener_comprobantes') {
	$json = array();
	$comprobante->obtener_comprobantes();
	foreach ($comprobante->objetos as $objeto) {
		$json[] = array(
			'id'		=> openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	=> $objeto->nombre,
		);
	}
	echo json_encode($json);
}
