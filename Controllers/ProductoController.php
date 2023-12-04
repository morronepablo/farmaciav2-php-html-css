<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Producto.php';
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Util/Config/config.php';
require_once('../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

session_start();
$producto = new Producto();
if ($_POST['funcion'] == 'obtener_productos') {
	$producto->obtener_productos();
	$json = array();
	foreach ($producto->objetos as $objeto) {
		$producto->obtener_stock($objeto->id);
		$stock = $producto->objetos[0]->total;
		$json[] = array(
			'id'				 => openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'			 => $objeto->nombre,
			'concentracion'		 => $objeto->concentracion,
			'precio'			 => $objeto->precio,
			'stock'				 => $stock,
			'laboratorio'		 => $objeto->laboratorio,
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
		$producto->obtener_stock($objeto->id);
		$stock = $producto->objetos[0]->total;
		$json[] = array(
			'id'				 => openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'			 => $objeto->nombre,
			'concentracion'		 => $objeto->concentracion,
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
		$concentracion 		= $_POST['concentracion'];
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
			/*if (empty($proveedor->objetos)) {
				$proveedor->crear($nombre, $telefono, $correo, $direccion);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_prov';
			}*/
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
}
