<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Tipo.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$tipo = new Tipo();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='obtener_tipos'){
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
}

else if($_POST['funcion']=='crear_presentacion'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre = $_POST['nombre'];
		$presentacion->encontrar_presentacion($nombre);
		if(empty($presentacion->objetos)) {
			$presentacion->crear($nombre);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_pre';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);

	echo json_encode($json);
}

else if($_POST['funcion']=='editar_presentacion'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre 	= $_POST['nombre_edit'];
		$id 		= $_POST['id_presentacion'];
		$formateado	= str_replace(' ', '+', $id);
		$id_presentacion	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_presentacion)) {
			$presentacion->encontrar_presentacion($nombre);
			if(empty($presentacion->objetos)) {
				$presentacion->editar($id_presentacion, $nombre);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_pre';
			}
		} else  {
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

else if($_POST['funcion']=='eliminar'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_presentacion	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_presentacion)) {
			$presentacion->eliminar($id_presentacion);
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

else if($_POST['funcion']=='activar'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_presentacion	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_presentacion)) {
			$presentacion->activar($id_presentacion);
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

?>