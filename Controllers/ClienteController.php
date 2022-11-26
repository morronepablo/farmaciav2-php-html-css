<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Cliente.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$cliente = new Cliente();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='editar_datos'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$telefono 		= $_POST['telefono'];
		$residencia 	= $_POST['residencia'];
		$direccion 		= $_POST['direccion'];
		$correo 		= $_POST['correo'];
		$sexo 			= $_POST['sexo'];
		$adicional 		= $_POST['adicional'];
		$formateado		= str_replace(' ', '+', $residencia);
		$id_residencia	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_residencia)) {
			$usuario->editar_datos($id_usuario,$telefono,$id_residencia,$direccion,$correo,$sexo,$adicional);
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
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='obtener_clientes'){
	$json = array();
	$cliente->obtener_clientes();
	foreach ($cliente->objetos as $objeto) {
		$nacimiento = new DateTime($objeto->edad);
		$fecha_actual = date('d-m-Y');
		$fecha_actual = new DateTime();
		$edad = $nacimiento->diff($fecha_actual);
		$edad_years = $edad->y;
		$json[] = array(
			'id'		 		=>	openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	 		=>	$objeto->nombre,
			'apellido'	 		=>	$objeto->apellido,
			'edad'		 		=>	$edad_years,
			'dni'		 		=>	$objeto->dni,
			'telefono'   		=>	$objeto->telefono,
			'correo'	 		=>	$objeto->correo,
			'sexo'		 		=>	$objeto->sexo,
			'adicional'	 		=>	$objeto->adicional,
			'avatar'	 		=>	$objeto->avatar,
			'estado'	 		=>	$objeto->estado,
			'id_tipo_sesion'	=>  $_SESSION['id_tipo']
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='crear_usuario'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario = $_SESSION['id'];
		$nombre		= $_POST['nombre'];
		$apellido	= $_POST['apellido'];
		$edad		= $_POST['nacimiento'];
		$dni		= $_POST['dni'];
		$contrasena	= $_POST['password'];
		$telefono	= $_POST['telefono'];
		$residencia	= $_POST['residencia'];
		$direccion	= $_POST['direccion'];
		$correo		= $_POST['correo'];
		$sexo		= $_POST['sexo'];
		$adicional	= $_POST['adicional'];

		$formateado		= str_replace(' ', '+', $residencia);
		$id_localidad	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_localidad)) {
			$usuario->login($dni);
			if(empty($usuario->objetos)) {
				$usuario->crear($nombre, $apellido, $edad, $dni, $contrasena, $telefono, $id_localidad, $direccion, $correo, $sexo, $adicional);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_usuario';
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
	$jsonstring = json_encode($json);
	echo $jsonstring;
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


?>
