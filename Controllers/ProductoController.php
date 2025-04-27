<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Producto.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Movimiento.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
require_once('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

$producto = new Producto();
$movimiento = new Movimiento();
session_start();
if ($_POST['funcion'] == 'obtener_productos') {
	$producto->obtener_productos();
	$json = array();
	foreach ($producto->objetos as $objeto) {
		$movimiento->obtener_stock_sin_vencer($objeto->id);
		$stock = 0;
		if (!empty($movimiento->objetos[0]->total)) {
			$stock = $movimiento->objetos[0]->total;
		}
		$json[] = array(
			'id'				 => openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'			 => str_replace('***', '%', $objeto->nombre),
			'concentracion'		 => str_replace('***', '%', $objeto->concentracion),
			'precio'			 => $objeto->precio,
			'stock'				 => $stock,
			'laboratorio'		 => $objeto->laboratorio,
			'tipo'			 	 => $objeto->tipo,
			'subtipo'			 => $objeto->subtipo,
			'presentacion'		 => $objeto->presentacion,
			'avatar'			 => $objeto->avatar,
			'fracciones'		 => $objeto->fracciones,
			'codigo'			 => $objeto->codigo,
			'registro_sanitario' => $objeto->registro_sanitario,
			'fecha_creacion'	 => $objeto->fecha_creacion,
			'fecha_edicion'		 => $objeto->fecha_edicion
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
} else if ($_POST['funcion'] == 'obtener_gestion_productos') {
	$producto->obtener_gestion_productos();
	$json = array();
	foreach ($producto->objetos as $objeto) {
		$movimiento->obtener_stock($objeto->id);
		$stock = 0;
		if (!empty($movimiento->objetos)) {
			$stock = $movimiento->objetos[0]->total;
		}
		$json[] = array(
			'id'				 => openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'			 => str_replace('***', '%', $objeto->nombre),
			'concentracion'		 => str_replace('***', '%', $objeto->concentracion),
			'precio'			 => $objeto->precio,
			'stock'				 => $stock,
			'laboratorio'		 => $objeto->laboratorio,
			'id_laboratorio'	 => openssl_encrypt($objeto->id_laboratorio, CODE, KEY),
			'subtipo'			 => $objeto->subtipo,
			'id_subtipo'	 	 => openssl_encrypt($objeto->id_subtipo, CODE, KEY),
			'presentacion'		 => $objeto->presentacion,
			'id_presentacion'	 => openssl_encrypt($objeto->id_presentacion, CODE, KEY),
			'estado'			 => $objeto->estado,
			'avatar'			 => $objeto->avatar,
			'fracciones'		 => $objeto->fracciones,
			'codigo'			 => $objeto->codigo,
			'registro_sanitario' => $objeto->registro_sanitario,
			'fecha_creacion'	 => $objeto->fecha_creacion,
			'fecha_edicion'		 => $objeto->fecha_edicion
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
} else if ($_POST['funcion'] == 'crear_producto') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$codigo 			= $_POST['codigo'];
		$nombre 			= $_POST['nombre'];
		$nombre				= str_replace('%', '***', $nombre);
		$concentracion 		= $_POST['concentracion'];
		$concentracion		= str_replace('%', '***', $concentracion);
		$subtipo 			= $_POST['subtipo'];
		$formateado			= str_replace(' ', '+', $subtipo);
		$id_subtipo			= openssl_decrypt($formateado, CODE, KEY);
		$presentacion 		= $_POST['presentacion'];
		$formateado			= str_replace(' ', '+', $presentacion);
		$id_presentacion	= openssl_decrypt($formateado, CODE, KEY);
		$fraccion 			= $_POST['fraccion'];
		$sanitario 			= $_POST['sanitario'];
		$precio 			= $_POST['precio'];
		$laboratorio 		= $_POST['laboratorio'];
		$formateado			= str_replace(' ', '+', $laboratorio);
		$id_laboratorio		= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_subtipo) && is_numeric($id_presentacion) && is_numeric($id_laboratorio)) {
			$producto->encontrar_producto($codigo);

			if (empty($producto->objetos)) {
				$producto->crear($codigo, $nombre, $concentracion, $fraccion, $sanitario, $precio, $id_subtipo, $id_presentacion, $id_laboratorio);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_prod';
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
} else if ($_POST['funcion'] == 'editar_producto') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$id 				= $_POST['id_producto'];
		$formateado			= str_replace(' ', '+', $id);
		$id_producto			= openssl_decrypt($formateado, CODE, KEY);

		$nombre 			= $_POST['nombre_edit'];
		$nombre				= str_replace('%', '***', $nombre);
		$concentracion 		= $_POST['concentracion_edit'];
		$concentracion		= str_replace('%', '***', $concentracion);

		$subtipo 			= $_POST['subtipo_edit'];
		$formateado			= str_replace(' ', '+', $subtipo);
		$id_subtipo			= openssl_decrypt($formateado, CODE, KEY);

		$presentacion 		= $_POST['presentacion_edit'];
		$formateado			= str_replace(' ', '+', $presentacion);
		$id_presentacion	= openssl_decrypt($formateado, CODE, KEY);

		$fraccion 			= $_POST['fraccion_edit'];
		$sanitario 			= $_POST['sanitario_edit'];
		$precio 			= $_POST['precio_edit'];

		$laboratorio 		= $_POST['laboratorio_edit'];
		$formateado			= str_replace(' ', '+', $laboratorio);
		$id_laboratorio		= openssl_decrypt($formateado, CODE, KEY);

		if (is_numeric($id_producto) && is_numeric($id_subtipo)  && is_numeric($id_presentacion) && is_numeric($id_laboratorio)) {
			$producto->encontrar_producto_editar($id_producto, $nombre, $concentracion, $id_subtipo, $id_presentacion, $fraccion, $sanitario, $id_laboratorio);
			if (empty($producto->objetos)) {
				$producto->editar($id_producto, $nombre, $concentracion, $id_subtipo, $id_presentacion, $fraccion, $sanitario, $precio, $id_laboratorio);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_prod';
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
		$id_producto	= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_producto)) {
			$movimiento->obtener_stock($id_producto);
			$stock = 0;
			if (!empty($movimiento->objetos)) {
				$stock = $movimiento->objetos[0]->total;
			}
			if ($stock == 0) {
				$producto->eliminar($id_producto);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_stock';
			}
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
		$id_producto	= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_producto)) {
			$producto->activar($id_producto);
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
} else if ($_POST['funcion'] == 'editar_avatar') {
	$mensaje = '';
	if (!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$id				= $_POST['id_producto_avatar'];
		$formateado		= str_replace(' ', '+', $id);
		$id_producto	= openssl_decrypt($formateado, CODE, KEY);
		if (is_numeric($id_producto)) {
			$nombre		= uniqid() . '-' . $_FILES['avatar_edit']['name'];
			$ruta 		= $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/img/productos/' . $nombre;
			move_uploaded_file($_FILES['avatar_edit']['tmp_name'], $ruta);
			$producto->encontrar_producto_id($id_producto);
			$avatar = $producto->objetos[0]->avatar;
			if ($avatar != 'prod_default.png') {
				unlink($_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/img/productos/' . $avatar);
			}
			$producto->editar_avatar($id_producto, $nombre);
			$mensaje 	= 'success';
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
