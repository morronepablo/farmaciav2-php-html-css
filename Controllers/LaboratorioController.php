<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Laboratorio.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$laboratorio = new Laboratorio();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='obtener_laboratorios'){
	$json = array();
	$laboratorio->obtener_laboratorios();
	foreach ($laboratorio->objetos as $objeto) {
		$json[] = array(
			'id'		=> openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	=> $objeto->nombre,
			'estado' 	=> $objeto->estado,
			'avatar' 	=> $objeto->avatar,
		);
	}
	echo json_encode($json);
}

else if($_POST['funcion']=='crear_laboratorio'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre = $_POST['nombre'];
		$laboratorio->encontrar_laboratorio($nombre);
		if(empty($laboratorio->objetos)) {
			$laboratorio->crear($nombre);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_lab';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);

	echo json_encode($json);
}

else if($_POST['funcion']=='editar_laboratorio'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre 	= $_POST['nombre_edit'];
		$id 		= $_POST['id_laboratorio'];
		$formateado	= str_replace(' ', '+', $id);
		$id_laboratorio	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_laboratorio)) {
			$laboratorio->encontrar_laboratorio($nombre);
			if(empty($laboratorio->objetos)) {
				$laboratorio->editar($id_laboratorio, $nombre);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_lab';
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

else if($_POST['funcion']=='editar_avatar'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id_laboratorio_avatar'];
		$formateado		= str_replace(' ', '+', $id);
		$id_laboratorio	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_laboratorio)) {
			$nombre = uniqid().'-'.$_FILES['avatar_edit']['name'];
			$ruta = $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/img/laboratorios/'.$nombre;
			move_uploaded_file($_FILES['avatar_edit']['tmp_name'], $ruta);
			$laboratorio->obtener_laboratorio_id($id_laboratorio);
			$avatar = $laboratorio->objetos[0]->avatar;
			if($avatar != 'lab_default.png') {
				unlink($_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/img/laboratorios/'.$avatar);
			}
			$laboratorio->editar_avatar($id_laboratorio, $nombre);
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

else if($_POST['funcion']=='eliminar'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_laboratorio	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_laboratorio)) {
			$laboratorio->eliminar($id_laboratorio);
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
		$id_laboratorio	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_laboratorio)) {
			$laboratorio->activar($id_laboratorio);
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


