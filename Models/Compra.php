<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Compra
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function crear_compra($codigo, $nota, $vencimiento, $total, $id_comprobante, $id_estado, $id_proveedor, $id_pedido)
	{
		$sql = "CALL crear_compra(:codigo,:nota,:fecha_vencimiento,:total,:comprobante_id,:id_estado_pago,:id_proveedor,:pedido_id)";
		$variables = array(
			':codigo' => $codigo,
			':nota' => $nota,
			':fecha_vencimiento' => $vencimiento,
			':total' => $total,
			':comprobante_id' => $id_comprobante,
			':id_estado_pago' => $id_estado,
			':id_proveedor' => $id_proveedor,
			':pedido_id' => $id_pedido,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function obtener_compras()
	{
		$sql = "
			SELECT 
				c.id,
				c.codigo,
				c.nota,
				c.fecha_creacion,
				c.fecha_vencimiento,
				c.total,
				c.comprobante_id,
				co.nombre AS comprobante,
				c.id_estado_pago,
				e.nombre AS estado,
				c.id_proveedor,
				p.nombre AS proveedor,
				c.pedido_id
			FROM compra c
			JOIN comprobante co ON c.comprobante_id=co.id
			JOIN estado_pago e ON c.id_estado_pago=e.id
			JOIN proveedor p ON c.id_proveedor=p.id
			ORDER BY c.fecha_creacion DESC
		";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function pagar($id_compra)
	{
		$sql = "UPDATE compra SET id_estado_pago=3
		WHERE id=:id";
		$variables = array(
			':id' => $id_compra,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function validar_compra_venta($id)
	{
		$sql = "
			SELECT * FROM movimiento 
			WHERE compra_id=:id
			AND tipo_movimiento_id=2
		";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}
