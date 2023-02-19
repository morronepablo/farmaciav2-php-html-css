<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Cliente.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$cliente = new Cliente();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='editar_cliente'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		//$id_usuario 	= $_SESSION['id'];
		$telefono 		= $_POST['telefono_edit'];
		$correo		 	= $_POST['correo_edit'];
		$adicional 		= $_POST['adicional_edit'];
		$id				= $_POST['id_usuario'];
		$formateado		= str_replace(' ', '+', $id);
		$id_cliente		= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_cliente)) {
			$cliente->editar($id_cliente,$telefono,$correo,$adicional);
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

else if($_POST['funcion']=='crear_cliente'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre		= $_POST['nombre'];
		$apellido	= $_POST['apellido'];
		$edad		= $_POST['nacimiento'];
		$dni		= $_POST['dni'];
		$telefono	= $_POST['telefono'];
		$correo		= $_POST['correo'];
		$sexo		= $_POST['sexo'];
		$adicional	= $_POST['adicional'];
		$cliente->encontrar_cliente($dni);
		if(empty($cliente->objetos)) {
			$cliente->crear($nombre, $apellido, $edad, $dni, $telefono, $correo, $sexo, $adicional);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_cliente';
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

else if($_POST['funcion']=='eliminar_cliente'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		//$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_cliente		= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_cliente)) {
			$cliente->eliminar($id_cliente);
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

else if($_POST['funcion']=='activar_cliente'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		//$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_cliente		= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_cliente)) {
			$cliente->activar($id_cliente);
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

?>
