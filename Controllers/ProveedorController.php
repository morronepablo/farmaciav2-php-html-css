<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Proveedor.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$proveedor = new Proveedor();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='obtener_proveedores'){
	$json = array();
	$proveedor->obtener_proveedores();
	foreach ($proveedor->objetos as $objeto) {
		$json[] = array(
			'id'		=> openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	=> $objeto->nombre,
			'telefono'	=> $objeto->telefono,
			'correo'	=> $objeto->correo,
			'direccion'	=> $objeto->direccion,
			'avatar'	=> $objeto->avatar,
			'nombre'	=> $objeto->nombre,
			'nombre'	=> $objeto->nombre,
			'nombre'	=> $objeto->nombre,
			'nombre'	=> $objeto->nombre,
			'estado' 	=> $objeto->estado
		);
	}
	echo json_encode($json);
}

else if($_POST['funcion']=='crear_proveedor'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre 	= $_POST['nombre'];
		$telefono 	= $_POST['telefono'];
		$correo 	= $_POST['correo'];
		$direccion 	= $_POST['direccion'];
		$proveedor->encontrar_proveedor($nombre);
		if(empty($proveedor->objetos)) {
			$proveedor->crear($nombre, $telefono, $correo, $direccion);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_prov';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);

	echo json_encode($json);
}

else if($_POST['funcion']=='editar_proveedor'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$nombre 	= $_POST['nombre_edit'];
		$telefono 	= $_POST['telefono_edit'];
		$correo 	= $_POST['correo_edit'];
		$direccion 	= $_POST['direccion_edit'];
		$id 		= $_POST['id_proveedor'];
		$formateado	= str_replace(' ', '+', $id);
		$id_proveedor = openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_proveedor)) {
			$proveedor->encontrar_proveedor($nombre);
			if(empty($proveedor->objetos)) {
				$proveedor->editar($id_proveedor, $nombre);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_tip';
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
		$id_tipo	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_tipo)) {
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
}

else if($_POST['funcion']=='activar'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id'];
		$formateado		= str_replace(' ', '+', $id);
		$id_tipo	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_tipo)) {
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

?>