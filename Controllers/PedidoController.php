<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Pedido.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$pedido = new Pedido();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'obtener_pedidos') {
	$json = array();
	$tipo->obtener_tipos();
	foreach ($tipo->objetos as $objeto) {
		$json[] = array(
			'id'		=> openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	=> $objeto->nombre,
			'estado' 	=> $objeto->estado
		);
	}
	echo json_encode($json);
} else if ($_POST['funcion'] == 'crear_pedido') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$proveedor 		= $_POST['proveedor'];
		$formateado		= str_replace(' ', '+', $proveedor);
		$id_proveedor 	= openssl_decrypt($formateado, CODE, KEY);
		$total 			= $_POST['total'];
		$descripcion 	= $_POST['descripcion'];
		$productos		= json_decode($_POST['productos']);
		if (is_numeric($id_proveedor)) {
			$pedido->crear_pedido($descripcion, $total, $id_proveedor);
			// obtener el id del pedido creado
			$id_pedido = $pedido->objetos[0]->id;
			var_dump($id_pedido);
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);

	echo json_encode($json);
}
