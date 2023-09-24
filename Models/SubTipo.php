<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class SubTipo
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function obtener_subtipos()
	{
		$sql = "SELECT sp.id,
				sp.nombre,
				sp.estado,
				t.nombre as tipo,
				t.id as id_tipo
				FROM subtipo_producto sp
			  	JOIN tipo_producto t ON t.id=sp.id_tipo_producto ORDER BY t.nombre";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function encontrar_subtipo($nombre)
	{
		$sql = "SELECT *
			  FROM subtipo_producto
			  WHERE nombre=:nombre";
		$variables = array(
			':nombre' => $nombre
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function encontrar_subtipo_editar($nombre, $id_subtipo)
	{
		$sql = "SELECT *
			  FROM subtipo_producto
			  WHERE nombre=:nombre AND id!=:id";
		$variables = array(
			':nombre'	=> $nombre,
			':id' 		=> $id_subtipo
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function crear($nombre, $id_tipo)
	{
		$sql = "INSERT INTO subtipo_producto(nombre, id_tipo_producto)
				VALUES(:nombre, :id_tipo_producto)";
		$variables = array(
			':nombre' => $nombre,
			':id_tipo_producto' => $id_tipo,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function editar($id_subtipo, $nombre, $id_tipo)
	{
		$sql = "UPDATE subtipo_producto SET nombre=:nombre, id_tipo_producto=:id_tipo WHERE id=:id_subtipo";
		$variables = array(
			':nombre'		=> $nombre,
			':id_tipo'		=> $id_tipo,
			':id_subtipo'	=> $id_subtipo
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

	function eliminar($id_subtipo)
	{
		$sql = "UPDATE subtipo_producto 
				SET estado=:estado
				WHERE id=:id_subtipo";
		$variables = array(
			':id_subtipo'	=> $id_subtipo,
			':estado' 		=> 'I',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function activar($id_subtipo)
	{
		$sql = "UPDATE subtipo_producto 
				SET estado=:estado
				WHERE id=:id_subtipo";
		$variables = array(
			':id_subtipo'	=> $id_subtipo,
			':estado' 		=> 'A',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
