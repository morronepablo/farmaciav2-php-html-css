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
}
