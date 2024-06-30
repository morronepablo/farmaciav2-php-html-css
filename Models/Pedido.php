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
}
