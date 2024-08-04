<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class PedidoCompra
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function crear_detalle($cantidad, $precio, $id_producto, $id_pedido)
	{
		$sql = "INSERT INTO pedido_compra(cantidad,precio,producto_id,pedido_id)
		VALUES(:cantidad,:precio,:producto_id,:pedido_id)";
		$variables = array(
			':cantidad' 	=> $cantidad,
			':precio' 		=> $precio,
			':producto_id'	=> $id_producto,
			':pedido_id' 	=> $id_pedido
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function ver_detalle($id_pedido)
	{
		$sql = "
			SELECT 
			p.cantidad,
			p.precio,
			pro.nombre AS producto,
			pro.concentracion,
			l.nombre AS laboratorio,
			s.nombre AS subtipo,
			pre.nombre AS presentacion
			FROM pedido_compra p
			JOIN producto pro ON pro.id=p.producto_id
			JOIN laboratorio l ON  l.id=pro.id_laboratorio
			JOIN subtipo_producto s ON s.id=pro.id_subtipo_producto
			JOIN presentacion pre ON pre.id=pro.id_presentacion
			WHERE p.pedido_id=:id_pedido
		";
		$variables = array(
			':id_pedido' 	=> $id_pedido,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function eliminar($id)
	{
		$sql = "DELETE FROM pedido_compra
				WHERE pedido_id=:pedido_id
		";
		$variables = array(
			':pedido_id' => $id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
