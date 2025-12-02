<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Movimiento.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Venta.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$movimiento = new Movimiento();
$venta 		= new Venta();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'registrar_venta') {
	$usuario			= $_SESSION['id'];
	$datos 				= json_decode($_POST['datos']);
	$cliente 			= $datos->cliente;
	$formateado			= str_replace(' ', '+', $cliente);
	$cliente			= openssl_decrypt($formateado, CODE, KEY);
	$comprobante		= $datos->comprobante;
	$formateado			= str_replace(' ', '+', $comprobante);
	$comprobante		= openssl_decrypt($formateado, CODE, KEY);
	$descuento 			= $datos->descuento;
	$grabada 			= $datos->grabada;
	$iva 				= $datos->iva;
	$total 				= $datos->total;
	$recibe 			= $datos->recibe;
	$cambio 			= $datos->cambio;
	$productos 			= $datos->productos;
	$mensaje			= '';
	$mensaje_productos	= '';
	$bandera			= 0;
	//var_dump($cliente, $comprobante, $descuento, $grabada, $iva, $total, $recibe, $cambio, $productos);
	if (is_numeric($cliente) && is_numeric($comprobante)) {
		foreach ($productos as $producto) {
			$cantidad = $producto->cantidad;
			$formateado		= str_replace(' ', '+', $producto->id);
			$id_producto	= openssl_decrypt($formateado, CODE, KEY);
			@$producto->id	= $id_producto;
			$stock_real		= 0;
			$movimiento->obtener_stock_sin_vencer($id_producto);
			if (!empty($movimiento->objetos[0]->total)) {
				$stock_real = $movimiento->objetos[0]->total;
			}
			if ($stock_real < $cantidad) {
				$mensaje_productos .= 'El producto ' . $producto->nombre . ' tiene ' . $stock_real . ' de stock. ';
				$bandera++;
			}
		}
		if ($bandera == 0) {
			//$venta->crear($grabada, $descuento, $iva, $total, $comprobante, $cliente);
			var_dump($grabada, $descuento, $iva, $total, $comprobante, $cliente);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_cantidad_falsa';
		}
	} else {
		$mensaje = 'error_decrypt';
	}
	echo json_encode(array('mensaje' => $mensaje, 'mensaje_producto' => $mensaje_productos));
}
