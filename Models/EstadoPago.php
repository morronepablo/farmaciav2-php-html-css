<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class EstadoPago
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function obtener_condicion_pago()
	{
		$sql = "SELECT * FROM estado_pago";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}
