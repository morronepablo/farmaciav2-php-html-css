<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Cliente
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function obtener_clientes()
	{
		$sql = "SELECT 
			  id, 
			  nombre,
			  apellido,
			  edad,
			  dni,
			  telefono,
			  correo,
			  sexo,
			  adicional,
			  avatar,
			  estado
			  FROM cliente c
			  ORDER BY id
		";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function obtener_clientes_select()
	{
		$sql = "SELECT 
			  id, 
			  nombre,
			  apellido,
			  edad,
			  dni,
			  telefono,
			  correo,
			  sexo,
			  adicional,
			  avatar,
			  estado
			  FROM cliente c
			  WHERE c.estado='A'
			  ORDER BY id
		";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function encontrar_cliente($dni)
	{
		$sql = "SELECT *
			  FROM cliente
			  WHERE dni=:dni";
		$variables = array(
			':dni' => $dni
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}

	function crear($nombre, $apellido, $edad, $dni, $telefono, $correo, $sexo, $adicional)
	{
		$sql = "INSERT INTO cliente(nombre, apellido, dni, edad, telefono, correo, sexo, adicional, avatar)
				VALUES(:nombre, :apellido, :dni, :edad, :telefono, :correo, :sexo, :adicional, :avatar)";
		$variables = array(
			':nombre' 		=> $nombre,
			':apellido' 	=> $apellido,
			':edad' 		=> $edad,
			':dni' 			=> $dni,
			':telefono' 	=> $telefono,
			':correo' 		=> $correo,
			':sexo' 		=> $sexo,
			':adicional' 	=> $adicional,
			':avatar' 		=> 'avatar.png'
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function editar($id_cliente, $telefono, $correo, $adicional)
	{
		$sql = "UPDATE cliente 
				SET telefono=:telefono, 
					correo=:correo, 
					adicional=:adicional 
				WHERE id=:id_cliente";
		$variables = array(
			':telefono' 	=> $telefono,
			':correo' 		=> $correo,
			':adicional' 	=> $adicional,
			':id_cliente' 	=> $id_cliente
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function eliminar($id_cliente)
	{
		$sql = "UPDATE cliente 
				SET estado=:estado 
				WHERE id=:id_cliente";
		$variables = array(
			':estado' 	=> 'I',
			':id_cliente' 	=> $id_cliente
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function activar($id_cliente)
	{
		$sql = "UPDATE cliente 
				SET estado=:estado 
				WHERE id=:id_cliente";
		$variables = array(
			':estado' 	=> 'A',
			':id_cliente' 	=> $id_cliente
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function obtener_cliente($id)
	{
		$sql = "SELECT *
			  FROM cliente
			  WHERE id=:id";
		$variables = array(
			':id' => $id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}
