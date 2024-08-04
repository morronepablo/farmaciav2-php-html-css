<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Pedido
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function crear_pedido($descripcion, $total, $proveedor)
	{
		$sql = "CALL crear_obtener_id_pedido(:proveedor,:descripcion,:total)";
		$variables = array(
			':descripcion' => $descripcion,
			':total' => $total,
			':proveedor' => $proveedor,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function obtener_pedidos()
	{
		$sql = "
			SELECT
			p.id,
			p.descripcion,
			p.estado,
			p.estado_proceso,
			p.fecha_creacion,
			p.total,
			p.id_proveedor,
			pr.nombre AS	proveedor
			FROM	pedido p
			JOIN	proveedor pr ON	p.id_proveedor = pr.id
			ORDER BY	p.fecha_creacion DESC;
		";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function eliminar($id)
	{
		$sql = "DELETE FROM pedido
				WHERE id=:id
		";
		$variables = array(
			':id' => $id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
