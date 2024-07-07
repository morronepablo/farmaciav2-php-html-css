<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Pedido.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/PedidoCompra.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$pedido = new Pedido();
$pedido_compra = new PedidoCompra();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'obtener_pedidos') {
	$json = array();
	$pedido->obtener_pedidos();
	foreach ($pedido->objetos as $objeto) {
		$json[] = array(
			'id'				=> openssl_encrypt($objeto->id, CODE, KEY),
			'descripcion'		=> $objeto->descripcion,
			'fecha_creacion'	=> $objeto->fecha_creacion,
			'total' 			=> $objeto->total,
			'estado' 			=> $objeto->estado,
			'estado_proceso' 	=> $objeto->estado_proceso,
			'proveedor' 		=> $objeto->proveedor,
			'id_proveedor'		=> openssl_encrypt($objeto->id_proveedor, CODE, KEY),
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
			foreach ($productos as $objeto) {
				$formateado		= str_replace(' ', '+', $objeto->id);
				$id_producto 	= openssl_decrypt($formateado, CODE, KEY);
				$pedido_compra->crear_detalle($objeto->cantidad, $objeto->precio, $id_producto, $id_pedido);
			}
			$mensaje = 'success';
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
