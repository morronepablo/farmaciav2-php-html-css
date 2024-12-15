<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Movimiento
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function crear($cantidad, $precio_venta, $precio_compra, $fecha_vencimiento, $lote, $compra_id, $venta_id, $producto_id, $tipo_movimiento_id)
	{
		$sql = "INSERT INTO movimiento(cantidad,cantidad_res,precio_venta,precio_compra,fecha_vencimiento,lote,compra_id,venta_id,producto_id,tipo_movimiento_id)
		VALUES(:cantidad,:cantidad_res,:precio_venta,:precio_compra,:fecha_vencimiento,:lote,:compra_id,:venta_id,:producto_id,:tipo_movimiento_id)";
		$variables = array(
			':cantidad' 			=> $cantidad,
			':cantidad_res' 		=> $cantidad,
			':precio_venta'			=> $precio_venta,
			':precio_compra'		=> $precio_compra,
			':fecha_vencimiento'	=> $fecha_vencimiento,
			':lote' 				=> $lote,
			':compra_id' 			=> $compra_id,
			':venta_id' 			=> $venta_id,
			':producto_id' 			=> $producto_id,
			':tipo_movimiento_id' 	=> $tipo_movimiento_id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function eliminar($id_compra)
	{
		$sql = "
			DELETE 
			FROM movimiento 
			WHERE compra_id=:compra_id
			AND tipo_movimiento_id=1
		";
		$variables = array(
			':compra_id' => $id_compra,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
