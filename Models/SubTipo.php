<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class SubTipo
{
	var $objetos;
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

	function editar($id_tipo, $nombre)
	{
		$sql = "UPDATE tipo_producto SET nombre=:nombre WHERE id=:id_tipo";
		$variables = array(
			':nombre'	=> $nombre,
			':id_tipo'	=> $id_tipo,
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

	function eliminar($id_tipo)
	{
		$sql = "UPDATE tipo_producto 
				SET estado=:estado
				WHERE id=:id_tipo";
		$variables = array(
			':id_tipo'	=> $id_tipo,
			':estado' 	=> 'I',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function activar($id_tipo)
	{
		$sql = "UPDATE tipo_producto 
				SET estado=:estado
				WHERE id=:id_tipo";
		$variables = array(
			':id_tipo'	=> $id_tipo,
			':estado' 	=> 'A',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
