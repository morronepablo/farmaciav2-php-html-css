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

	function ver_detalle($id)
	{
		$sql = "
			SELECT 
				m.cantidad,
				m.precio_compra,
				m.lote,
				m.fecha_vencimiento,
				p.nombre AS producto,
				p.concentracion,
				l.nombre AS laboratorio,
				s.nombre AS subtipo,
				pre.nombre AS presentacion 
			FROM movimiento m
			JOIN producto p ON p.id = m.producto_id
			JOIN laboratorio l ON l.id = p.id_laboratorio
			JOIN subtipo_producto s ON s.id = p.id_subtipo_producto
			JOIN presentacion pre ON pre.id = p.id_presentacion
			WHERE m.tipo_movimiento_id=1
			AND m.compra_id=:compra_id
		";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':compra_id' => $id));
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function obtener_lotes()
	{
		$sql = "
			SELECT 
				m.id,
				c.codigo AS compra,
				m.cantidad_res,
				m.cantidad,
				m.precio_compra,
				m.lote,
				m.fecha_vencimiento,
				p.nombre AS producto,
				p.codigo AS codigo_producto,
				p.concentracion,
				l.nombre AS laboratorio,
				s.nombre AS subtipo,
				pre.nombre AS presentacion
			FROM movimiento m
			JOIN compra c ON c.id=m.compra_id
			JOIN producto p ON p.id=m.producto_id
			JOIN laboratorio l ON l.id=p.id_laboratorio
			JOIN subtipo_producto s ON s.id=p.id_subtipo_producto
			JOIN presentacion pre ON pre.id=p.id_presentacion
			WHERE m.tipo_movimiento_id=1
			AND m.estado='A'
			ORDER BY p.nombre ASC
		";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function dar_baja($id)
	{
		$sql = "
			UPDATE movimiento 
			SET cantidad_res = 0,
			estado = 'I'
			WHERE id=:id
		";
		$variables = array(
			':id' => $id,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function editar_cantidad($id, $cantidad)
	{
		$sql = "
			UPDATE movimiento 
			SET cantidad_res = :cantidad
			WHERE id=:id
		";
		$variables = array(
			':id' 		=> $id,
			':cantidad' => $cantidad,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function obtener_stock($id)
	{
		$sql = "
			SELECT SUM(cantidad_res) AS total 
			FROM movimiento
			WHERE producto_id=:id
			AND tipo_movimiento_id=1
			AND estado='A'
			GROUP BY producto_id
		";
		$query = $this->acceso->prepare($sql);
		$query->execute(
			array(':id' => $id)
		);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function obtener_stock_sin_vencer($id)
	{
		$sql = "
			SELECT SUM(cantidad_res) AS total 
			FROM movimiento
			WHERE producto_id=:id
			AND tipo_movimiento_id=1
			AND estado='A'
			AND fecha_vencimiento>DATE(NOW())
			GROUP BY producto_id
		";
		$query = $this->acceso->prepare($sql);
		$query->execute(
			array(':id' => $id)
		);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}
