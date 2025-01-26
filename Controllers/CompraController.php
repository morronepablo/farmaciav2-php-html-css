<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Compra.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Pedido.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/PedidoCompra.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Movimiento.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$compra = new Compra();
$pedido = new Pedido();
$pedido_compra = new PedidoCompra();
$movimiento = new Movimiento();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'realizar_compra') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {

		$id		 		= $_POST['id_pedido'];
		$formateado		= str_replace(' ', '+', $id);
		$id_pedido	 	= openssl_decrypt($formateado, CODE, KEY);

		$codigo		 	= $_POST['codigo_compra'];
		$nota		 	= $_POST['nota_compra'];
		$vencimiento	= $_POST['vencimiento_compra'];
		$total		 	= $_POST['total'];
		$comprobante	= $_POST['comprobante_compra'];
		$formateado		= str_replace(' ', '+', $comprobante);
		$id_comprobante	= openssl_decrypt($formateado, CODE, KEY);
		$estado			= $_POST['estado_pago_compra'];
		$formateado		= str_replace(' ', '+', $estado);
		$id_estado		= openssl_decrypt($formateado, CODE, KEY);
		$proveedor		= $_POST['proveedor_compra'];
		$formateado		= str_replace(' ', '+', $proveedor);
		$id_proveedor	= openssl_decrypt($formateado, CODE, KEY);
		$productos		= json_decode($_POST['productos']);

		if (is_numeric($id_pedido) && is_numeric($id_comprobante) && is_numeric($id_estado) && is_numeric($id_proveedor)) {
			$compra->crear_compra($codigo, $nota, $vencimiento, $total, $id_comprobante, $id_estado, $id_proveedor, $id_pedido);
			// obtener el id del pedido creado
			$id_compra = $compra->objetos[0]->id_compra;
			foreach ($productos as $objeto) {
				$formateado		= str_replace(' ', '+', $objeto->id);
				$id_producto	= openssl_decrypt($formateado, CODE, KEY);
				$pedido_compra->crear_detalle($objeto->cantidad, $objeto->precio, $id_producto, $id_pedido);
				$movimiento->crear($objeto->cantidad, 0, $objeto->precio, $objeto->vencimiento, $objeto->lote, $id_compra, '', $id_producto, 1);
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
} else if ($_POST['funcion'] == 'obtener_compras') {
	$compra->obtener_compras();
	//var_dump($compra->objetos);
	$json = array();
	foreach ($compra->objetos as $objeto) {
		$json[] = array(
			'id'				=> openssl_encrypt($objeto->id, CODE, KEY),
			'codigo'			=> $objeto->codigo,
			'nota'				=> $objeto->nota,
			// Formateo de la fecha de creación
			'fecha_creacion'	=> date('d-m-Y h:i:s', strtotime($objeto->fecha_creacion)),
			// Formateo de la fecha de vencimiento si existe
			'fecha_vencimiento'	=> !empty($objeto->fecha_vencimiento) ? date('d-m-Y', strtotime($objeto->fecha_vencimiento)) : null,
			'total'				=> $objeto->total,
			'comprobante_id'	=> openssl_encrypt($objeto->comprobante_id, CODE, KEY),
			'comprobante'		=> $objeto->comprobante,
			'id_estado_pago'	=> openssl_encrypt($objeto->id_estado_pago, CODE, KEY),
			'estado'			=> $objeto->estado,
			'id_proveedor'		=> openssl_encrypt($objeto->id_proveedor, CODE, KEY),
			'proveedor'			=> $objeto->proveedor,
			'pedido_id'			=> openssl_encrypt($objeto->pedido_id, CODE, KEY),
		);
	}

	echo json_encode($json);
} else if ($_POST['funcion'] == 'pagar') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {

		$id 			= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_compra	 	= openssl_decrypt($formateado, CODE, KEY);

		if (is_numeric($id_compra)) {
			$compra->pagar($id_compra);
			// obtener el id del pedido creado

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
} else if ($_POST['funcion'] == 'eliminar') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {

		$id 			= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_compra	 	= openssl_decrypt($formateado, CODE, KEY);

		$pedido_id 		= $_POST['pedido_id'];
		$formateado		= str_replace(' ', '+', $pedido_id);
		$pedido_id	 	= openssl_decrypt($formateado, CODE, KEY);

		if (is_numeric($id_compra) && is_numeric($pedido_id)) {
			$compra->validar_compra_venta($id_compra);
			if (empty($compra->objetos)) {
				$movimiento->eliminar($id_compra);
				$compra->eliminar($id_compra);
				$pedido->cambiar_estado_espera($pedido_id);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_compra';
			}
			// obtener el id del pedido creado


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
} else if ($_POST['funcion'] == 'editar') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {

		$id 			= $_POST['id_compra'];
		$formateado		= str_replace(' ', '+', $id);
		$id_compra	 	= openssl_decrypt($formateado, CODE, KEY);

		$pedido_id 		= $_POST['pedido_id'];
		$formateado		= str_replace(' ', '+', $pedido_id);
		$pedido_id	 	= openssl_decrypt($formateado, CODE, KEY);

		$codigo 		= $_POST['codigo'];
		$nota 			= $_POST['nota'];

		$comprobante 	= $_POST['comprobante'];
		$formateado		= str_replace(' ', '+', $comprobante);
		$comprobante_id	= openssl_decrypt($formateado, CODE, KEY);

		$proveedor 		= $_POST['proveedor'];
		$formateado		= str_replace(' ', '+', $proveedor);
		$id_proveedor	= openssl_decrypt($formateado, CODE, KEY);

		if (is_numeric($id_compra) && is_numeric($pedido_id) && is_numeric($comprobante_id) && is_numeric($id_proveedor)) {
			/*
			$compra->validar_compra_venta($id_compra);
			if (empty($compra->objetos)) {
				$movimiento->eliminar($id_compra);
				$compra->eliminar($id_compra);
				$pedido->cambiar_estado_espera($pedido_id);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_compra';
			}
			*/
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
