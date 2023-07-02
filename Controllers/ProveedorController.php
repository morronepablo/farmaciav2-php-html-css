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
		$nombre 		= $_POST['nombre_edit'];
		$telefono_edit 	= $_POST['telefono_edit'];
		$correo_edit 	= $_POST['correo_edit'];
		$direccion_edit = $_POST['direccion_edit'];
		$avatar 		= $_FILES['avatar_edit']['name'];
		$id 			= $_POST['id_proveedor'];
		$formateado		= str_replace(' ', '+', $id);
		$id_proveedor 	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_proveedor)) {
			$proveedor->encontrar_proveedor_1($nombre, $id_proveedor);
			if(empty($proveedor->objetos)) {
				if($avatar != '') {
					$nombre_avatar	= uniqid().'-'.$_FILES['avatar_edit']['name'];
					$ruta			= $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/img/proveedores/'.$nombre_avatar;
					move_uploaded_file($_FILES['avatar_edit']['tmp_name'],$ruta);
					$proveedor->obtener_proveedor($id_proveedor);
					$avatar_actual 	= $proveedor->objetos[0]->avatar;
					if($avatar_actual != 'prov_default.png') {
						unlink($_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/img/proveedores/'.$avatar_actual);
					}
					$proveedor->editar_avatar($id_proveedor, $nombre, $telefono_edit, $correo_edit, $direccion_edit, $nombre_avatar);
				} else {
					$proveedor->editar($id_proveedor, $nombre, $telefono_edit, $correo_edit, $direccion_edit);
				}
				$mensaje = 'success';
			} else {
				$mensaje = 'error_prov';
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
		$id_proveedor	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_proveedor)) {
			$proveedor->eliminar($id_proveedor);
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
		$id_proveedor	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_proveedor)) {
			$proveedor->activar($id_proveedor);
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