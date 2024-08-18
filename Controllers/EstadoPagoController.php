<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/EstadoPago.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$estado_pago = new EstadoPago();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'obtener_condicion_pago') {
	$json = array();
	$estado_pago->obtener_condicion_pago();
	foreach ($estado_pago->objetos as $objeto) {
		$json[] = array(
			'id'		=> openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	=> $objeto->nombre,
		);
	}
	echo json_encode($json);
}
