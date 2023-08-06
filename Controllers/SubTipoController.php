<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/SubTipo.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
$subtipo = new SubTipo();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if ($_POST['funcion'] == 'obtener_subtipos') {
	$json = array();
	$subtipo->obtener_subtipos();
	foreach ($subtipo->objetos as $objeto) {
		$json[] = array(
			'id'		=> openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	=> $objeto->nombre,
			'estado' 	=> $objeto->estado,
			'id_tipo' 	=> openssl_encrypt($objeto->id_tipo, CODE, KEY),
			'tipo' 		=> $objeto->tipo,
		);
	}
	echo json_encode($json);
} else if ($_POST['funcion'] == 'crear_tipo') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$nombre = $_POST['nombre'];
		$tipo->encontrar_tipo($nombre);
		if (empty($tipo->objetos)) {
			$tipo->crear($nombre);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_tip';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);

	echo json_encode($json);
} else if ($_POST['funcion'] == 'editar_tipo') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$nombre 	= $_POST['nombre_edit'];
		$id 		= $_POST['id_tipo'];
		$formateado	= str_replace(' ', '+', $id);
		$id_tipo	= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_tipo)) {
			$tipo->encontrar_tipo($nombre);
			if (empty($tipo->objetos)) {
				$tipo->editar($id_tipo, $nombre);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_tip';
			}
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
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_tipo	= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_tipo)) {
			$tipo->eliminar($id_tipo);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje' => $mensaje
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
} else if ($_POST['funcion'] == 'activar') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_tipo	= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_tipo)) {
			$tipo->activar($id_tipo);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje' => $mensaje
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
