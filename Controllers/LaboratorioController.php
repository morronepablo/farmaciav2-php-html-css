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

else if($_POST['funcion']=='eliminar_usuario'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_session = $_SESSION['id'];
		$id			= $_POST['id_usuario'];
		$password	= $_POST['pass'];
		$formateado	= str_replace(' ', '+', $id);
		$id_usuario	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_usuario)) {
			$usuario->obtener_datos($id_session);
			$pass_base	= openssl_decrypt($usuario->objetos[0]->contrasena, CODE, KEY);
			if($pass_base != '') {
				// password de la base encriptado
				if($password == $pass_base) {
					// eliminar usuario
					$usuario->borrar($id_usuario);
					$mensaje = 'success';
				} else {
					$mensaje = 'error_pass';
				}
			} else {
				// password de la base no encriptado
				if($password == $usuario->objetos[0]->contrasena) {
					// eliminar usuario
					$usuario->borrar($id_usuario);
					$mensaje = 'success';
				} else {
					$mensaje = 'error_pass';
				}
			}
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje,
		'funcion'	=>	'eliminar usuario'
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='activar_usuario'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_session = $_SESSION['id'];
		$id			= $_POST['id_usuario'];
		$password	= $_POST['pass'];
		$formateado	= str_replace(' ', '+', $id);
		$id_usuario	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_usuario)) {
			$usuario->obtener_datos($id_session);
			$pass_base	= openssl_decrypt($usuario->objetos[0]->contrasena, CODE, KEY);
			if($pass_base != '') {
				// password de la base encriptado
				if($password == $pass_base) {
					// activar usuario
					$usuario->activar($id_usuario);
					$mensaje = 'success';
				} else {
					$mensaje = 'error_pass';
				}
			} else {
				// password de la base no encriptado
				if($password == $usuario->objetos[0]->contrasena) {
					// activar usuario
					$usuario->activar($id_usuario);
					$mensaje = 'success';
				} else {
					$mensaje = 'error_pass';
				}
			}
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje,
		'funcion'	=>	'activar usuario'
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
