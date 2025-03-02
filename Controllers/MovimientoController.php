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
} elseif ($_POST['funcion'] == 'obtener_lotes') {
	$movimiento->obtener_lotes();
	$json = array();
	$fecha_actual = date('Y-m-d H:i:s');
	$fecha_actual = new DateTime($fecha_actual);

	// Truncar la hora de la fecha actual (solo considerar día, mes, año)
	$fecha_actual->setTime(0, 0, 0);

	foreach ($movimiento->objetos as $objeto) {
		$vencimiento = new DateTime($objeto->fecha_vencimiento);

		// Truncar la hora de la fecha de vencimiento (solo considerar día, mes, año)
		$vencimiento->setTime(0, 0, 0);

		if ($vencimiento < $fecha_actual) {
			$diferencia = $fecha_actual->diff($vencimiento);
			$verificado = 0;
		} else {
			$diferencia = $vencimiento->diff($fecha_actual);
			$verificado = 1;
		}

		$year = $diferencia->y;
		$mes = $diferencia->m;
		$dia = $diferencia->d;

		$dias_totales = $diferencia->days;
		if ($verificado == 0 || $dias_totales == 0) { // Si la fecha ya pasó o es hoy, estado = 'danger'
			$estado = 'danger';
		} else {
			if ($dias_totales <= 15) {
				$estado = 'critical'; // 1-15 días
			} else {
				$meses_totales = ($year * 12) + $mes;
				if ($meses_totales <= 5) {
					$estado = 'warning'; // Entre 15 días y 5 meses
				} else {
					$estado = 'light'; // Más de 5 meses
				}
			}
		}

		$json[] = array(
			'id'            => openssl_encrypt($objeto->id, CODE, KEY),
			'compra'        => $objeto->compra,
			'cantidad_res'  => $objeto->cantidad_res,
			'cantidad'      => $objeto->cantidad,
			'precio_compra' => $objeto->precio_compra,
			'lote'          => $objeto->lote,
			'vencimiento'   => $objeto->fecha_vencimiento,
			'producto'      => str_replace("***", "%", $objeto->producto),
			'concentracion' => str_replace("***", "%", $objeto->concentracion),
			'laboratorio'   => $objeto->laboratorio,
			'subtipo'       => $objeto->subtipo,
			'presentacion'  => $objeto->presentacion,
			'estado'        => $estado,
			'year'          => $year,
			'mes'           => $mes,
			'dia'           => $dia,
			'verificado'    => $verificado,
		);
	}

	usort($json, function ($a, $b) use ($fecha_actual) {
		$estadoPrioridad = [
			'danger' => 1,
			'critical' => 2,
			'warning' => 3,
			'light' => 4
		];

		$prioridadA = $estadoPrioridad[$a['estado']];
		$prioridadB = $estadoPrioridad[$b['estado']];

		if ($prioridadA !== $prioridadB) {
			return $prioridadA - $prioridadB;
		}

		$fechaA = new DateTime($a['vencimiento']);
		$fechaB = new DateTime($b['vencimiento']);
		$fechaA->setTime(0, 0, 0);
		$fechaB->setTime(0, 0, 0);

		if ($a['estado'] === 'danger') {
			return $fechaB <=> $fechaA;
		}

		return $fechaA <=> $fechaB;
	});

	echo json_encode($json);
}
