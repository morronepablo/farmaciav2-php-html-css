<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Laboratorio
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function obtener_laboratorios()
	{
		$sql = "SELECT * FROM laboratorio ORDER BY nombre";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function encontrar_laboratorio($nombre)
	{
		$sql = "SELECT *
			  FROM laboratorio
			  WHERE nombre=:nombre";
		$variables = array(
			':nombre' => $nombre
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function crear($nombre)
	{
		$sql = "INSERT INTO laboratorio(nombre)
				VALUES(:nombre)";
		$variables = array(
			':nombre' => $nombre,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function editar($id_laboratorio, $nombre)
	{
		$sql = "UPDATE laboratorio SET nombre=:nombre WHERE id=:id";
		$variables = array(
			':nombre'	=> $nombre,
			':id' 		=> $id_laboratorio,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function obtener_laboratorio_id($id)
	{
		$sql = "SELECT * FROM laboratorio WHERE id=:id";
		$variables = array(
			':id' => $id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function editar_avatar($id_laboratorio, $nombre)
	{
		$sql = "UPDATE laboratorio 
				SET avatar=:nombre
				WHERE id=:id";
		$variables = array(
			':id' => $id_laboratorio,
			':nombre' => $nombre,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function eliminar($id_laboratorio)
	{
		$sql = "UPDATE laboratorio 
				SET estado=:estado
				WHERE id=:id";
		$variables = array(
			':id' 		=> $id_laboratorio,
			':estado' 	=> 'I',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function activar($id_laboratorio)
	{
		$sql = "UPDATE laboratorio 
				SET estado=:estado
				WHERE id=:id";
		$variables = array(
			':id' 		=> $id_laboratorio,
			':estado' 	=> 'A',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
