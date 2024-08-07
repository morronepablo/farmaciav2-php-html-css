<?php
include_once 'conexion.php';
class Estado
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function rellenar_estado()
	{
		$sql = "SELECT * FROM estado_pago";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function obtenerId($nombre)
	{
		$sql = "SELECT * FROM estado_pago WHERE nombre=:nombre";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre' => $nombre));
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}
