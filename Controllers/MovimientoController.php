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
	// $movimiento->obtener_lotes();
	// $json = array();
	// $fecha_actual = date('Y-m-d H:i:s');
	// $fecha_actual = new DateTime($fecha_actual);
	// foreach ($movimiento->objetos as $objeto) {
	// 	$vencimiento = new DateTime($objeto->fecha_vencimiento);
	// 	$diferencia = $vencimiento->diff($fecha_actual);
	// 	$year = $diferencia->y;
	// 	$mes = $diferencia->m;
	// 	$dia = $diferencia->d;
	// 	$verificado = $diferencia->invert;
	// 	$estado = 'light';
	// 	if ($verificado == 0) {
	// 		$estado = 'danger';
	// 	} else {
	// 		if ($mes > 5 && $year == 0) {
	// 			$estado = 'light';
	// 		}
	// 		if ($mes <= 5 && $year == 0) {
	// 			$estado = 'warning';
	// 		}
	// 	}
	// 	$json[] = array(
	// 		'id' 			=> openssl_encrypt($objeto->id, CODE, KEY),
	// 		'compra' 		=> $objeto->compra,
	// 		'cantidad_res' 	=> $objeto->cantidad_res,
	// 		'cantidad' 		=> $objeto->cantidad,
	// 		'precio_compra' => $objeto->precio_compra,
	// 		'lote' 			=> $objeto->lote,
	// 		'vencimiento' 	=> $objeto->fecha_vencimiento,
	// 		'producto' 		=> str_replace("***", "%", $objeto->producto),
	// 		'concentracion' => str_replace("***", "%", $objeto->concentracion),
	// 		'laboratorio' 	=> $objeto->laboratorio,
	// 		'subtipo' 		=> $objeto->subtipo,
	// 		'presentacion' 	=> $objeto->presentacion,
	// 		'estado' 		=> $estado,
	// 		'year' 			=> $year,
	// 		'mes' 			=> $mes,
	// 		'dia' 			=> $dia,
	// 	);
	// }

	// $movimiento->obtener_lotes();
	// $json = array();
	// $fecha_actual = date('Y-m-d H:i:s');
	// $fecha_actual = new DateTime($fecha_actual);

	// foreach ($movimiento->objetos as $objeto) {
	// 	$vencimiento = new DateTime($objeto->fecha_vencimiento);
	// 	$diferencia = $vencimiento->diff($fecha_actual);
	// 	$year = $diferencia->y;
	// 	$mes = $diferencia->m;
	// 	$dia = $diferencia->d;
	// 	$verificado = $diferencia->invert; // 0 si la fecha ya pasó, 1 si está en el futuro

	// 	$estado = 'light'; // Valor por defecto

	// 	if ($verificado == 0) {
	// 		// Lote vencido
	// 		$estado = 'danger';
	// 	} else {
	// 		// Lote no vencido, calcular meses totales hasta el vencimiento
	// 		$meses_totales = ($year * 12) + $mes;

	// 		if ($meses_totales <= 5) {
	// 			// 5 meses o menos para vencer
	// 			$estado = 'warning';
	// 		} else {
	// 			// Más de 5 meses para vencer
	// 			$estado = 'light';
	// 		}
	// 	}

	// 	$json[] = array(
	// 		'id'            => openssl_encrypt($objeto->id, CODE, KEY),
	// 		'compra'        => $objeto->compra,
	// 		'cantidad_res'  => $objeto->cantidad_res,
	// 		'cantidad'      => $objeto->cantidad,
	// 		'precio_compra' => $objeto->precio_compra,
	// 		'lote'          => $objeto->lote,
	// 		'vencimiento'   => $objeto->fecha_vencimiento,
	// 		'producto'      => str_replace("***", "%", $objeto->producto),
	// 		'concentracion' => str_replace("***", "%", $objeto->concentracion),
	// 		'laboratorio'   => $objeto->laboratorio,
	// 		'subtipo'       => $objeto->subtipo,
	// 		'presentacion'  => $objeto->presentacion,
	// 		'estado'        => $estado,
	// 		'year'          => $year,
	// 		'mes'           => $mes,
	// 		'dia'           => $dia,
	// 	);
	// }

	$movimiento->obtener_lotes();
	$json = array();
	$fecha_actual = date('Y-m-d H:i:s');
	$fecha_actual = new DateTime($fecha_actual);

	foreach ($movimiento->objetos as $objeto) {
		$vencimiento = new DateTime($objeto->fecha_vencimiento);
		$diferencia = $vencimiento->diff($fecha_actual);
		$year = $diferencia->y;
		$mes = $diferencia->m;
		$dia = $diferencia->d;
		$verificado = $diferencia->invert;

		$estado = 'light';
		if ($verificado == 0) {
			$estado = 'danger';
		} else {
			$meses_totales = ($year * 12) + $mes;
			if ($meses_totales <= 5) {
				$estado = 'warning';
			} else {
				$estado = 'light';
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
		);
	}

	// Ordenar el arreglo $json
	usort($json, function ($a, $b) use ($fecha_actual) {
		// Prioridad por estado: danger > warning > light
		$estadoPrioridad = [
			'danger' => 1,
			'warning' => 2,
			'light' => 3
		];

		$prioridadA = $estadoPrioridad[$a['estado']];
		$prioridadB = $estadoPrioridad[$b['estado']];

		// Si los estados son diferentes, ordenar por prioridad de estado
		if ($prioridadA !== $prioridadB) {
			return $prioridadA - $prioridadB; // Menor prioridad primero (danger > warning > light)
		}

		// Si los estados son iguales, ordenar por fecha de vencimiento
		$fechaA = new DateTime($a['vencimiento']);
		$fechaB = new DateTime($b['vencimiento']);

		// Para los vencidos (danger), ordenar de más recientemente vencido a más antiguo
		if ($a['estado'] === 'danger') {
			return $fechaB <=> $fechaA; // Orden descendente (más reciente primero)
		}

		// Para warning y light, ordenar de más próximo a más lejano
		return $fechaA <=> $fechaB; // Orden ascendente (más próximo primero)
	});

	echo json_encode($json);
}
