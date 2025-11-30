<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/EstadoPago.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$estado_pago = new EstadoPago();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'registrar_venta') {
	$datos 			= json_decode($_POST['datos']);
	$cliente 		= $datos->cliente;
	$formateado		= str_replace(' ', '+', $cliente);
	$cliente		= openssl_decrypt($formateado, CODE, KEY);
	$comprobante	= $datos->comprobante;
	$formateado		= str_replace(' ', '+', $comprobante);
	$comprobante	= openssl_decrypt($formateado, CODE, KEY);
	$descuento 		= $datos->descuento;
	$grabada 		= $datos->grabada;
	$iva 			= $datos->iva;
	$total 			= $datos->total;
	$recibe 		= $datos->recibe;
	$cambio 		= $datos->cambio;
	$productos 		= $datos->productos;
	$mensaje		= '';
	//var_dump($cliente, $comprobante, $descuento, $grabada, $iva, $total, $recibe, $cambio, $productos);
	if (is_numeric($cliente) && is_numeric($comprobante)) {
		$mensaje = 'success';
	} else {
		$mensaje = 'error_decrypt';
	}
	echo json_encode(array('mensaje' => $mensaje));
}
