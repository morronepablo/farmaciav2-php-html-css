<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Movimiento.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$movimiento = new Movimiento();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'ver_detalle') {
	$detalles = array();
	$mensaje = '';
	if (!empty($_SESSION['id'])) {

		$id		 		= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_compra	 	= openssl_decrypt($formateado, CODE, KEY);

		$movimiento->ver_detalle($id_compra);
		foreach ($movimiento->objetos as $objeto) {
			$detalles[] = array(
				'cantidad' 			=> $objeto->cantidad,
				'precio_compra' 	=> $objeto->precio_compra,
				'lote' 				=> $objeto->lote,
				'fecha_vencimiento' => $objeto->fecha_vencimiento,
				'producto' 			=> str_replace("***", "%", $objeto->producto),
				'concentracion' 	=> str_replace("***", "%", $objeto->concentracion),
				'laboratorio' 		=> $objeto->laboratorio,
				'subtipo' 			=> $objeto->subtipo,
				'presentacion' 		=> $objeto->presentacion
			);
		}

		if (is_numeric($id_compra)) {

			$mensaje = 'success';
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje,
		'data'		=>	$detalles
	);

	echo json_encode($json);
}
