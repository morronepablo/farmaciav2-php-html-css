<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Usuario
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function login($dni)
	{
		$sql = "SELECT 
			  u.id as id,
			  u.nombre as nombre,
			  u.apellido as apellido,
			  u.dni as dni,
			  u.avatar as avatar,
			  u.id_tipo as id_tipo,
			  t.nombre as tipo,
			  u.contrasena as contrasena,
			  u.estado as estado
			  FROM usuario u
			  JOIN tipo t ON u.id_tipo = t.id
			  WHERE u.dni=:dni AND u.estado='A'";
		$variables = array(
			':dni' => $dni
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function obtener_datos($id_usuario)
	{
		$sql = "SELECT 
			  u.id, 
			  u.nombre,
			  u.apellido,
			  u.edad,
			  u.dni,
			  u.telefono,
			  u.direccion,
			  u.correo,
			  u.sexo,
			  u.adicional,
			  u.avatar,
			  u.id_tipo,
			  t.nombre as tipo,
			  CONCAT(l.nombre,' - ', p.nombre) as residencia,
			  l.id as id_residencia,
			  u.contrasena
			  FROM usuario u
			  JOIN tipo t ON u.id_tipo = t.id
			  JOIN localidad l ON l.id = u.id_localidad
			  JOIN provincia p ON p.id = l.id_provincia
			  WHERE u.id=:id_usuario";
		$variables = array(
			':id_usuario' => $id_usuario
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function editar_datos($id_usuario, $telefono, $residencia, $direccion, $correo, $sexo, $adicional)
	{
		$sql = "UPDATE usuario 
				SET telefono=:telefono, 
					id_localidad=:residencia,
					direccion=:direccion,
					correo=:correo, 
					sexo=:sexo, 
					adicional=:adicional 
				WHERE id=:id_usuario";
		$variables = array(
			':telefono' 	=> $telefono,
			':residencia' 	=> $residencia,
			':direccion' 	=> $direccion,
			':correo' 		=> $correo,
			':sexo' 		=> $sexo,
			':adicional' 	=> $adicional,
			':id_usuario' 	=> $id_usuario
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function editar_avatar($id_usuario, $nombre)
	{
		$sql = "UPDATE usuario 
				SET avatar=:nombre 
				WHERE id=:id_usuario";
		$variables = array(
			':id_usuario' 	=> $id_usuario,
			':nombre'		=> $nombre
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function editar_password($id_usuario, $newpass)
	{
		$sql = "UPDATE usuario 
				SET contrasena=:newpass 
				WHERE id=:id_usuario";
		$variables = array(
			':id_usuario' 	=> $id_usuario,
			':newpass'		=> $newpass
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function obtener_usuarios()
	{
		$sql = "SELECT 
			  u.id, 
			  u.nombre,
			  u.apellido,
			  u.edad,
			  u.dni,
			  u.telefono,
			  u.direccion,
			  u.correo,
			  u.sexo,
			  u.adicional,
			  u.avatar,
			  u.id_tipo,
			  t.nombre as tipo,
			  CONCAT(l.nombre,' - ', p.nombre) as residencia,
			  l.id as id_residencia,
			  u.contrasena,
			  u.estado
			  FROM usuario u
			  JOIN tipo t ON u.id_tipo = t.id
			  JOIN localidad l ON l.id = u.id_localidad
			  JOIN provincia p ON p.id = l.id_provincia
			  ORDER BY u.id
		";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function crear($nombre, $apellido, $edad, $dni, $contrasena, $telefono, $id_localidad, $direccion, $correo, $sexo, $adicional)
	{
		$sql = "INSERT INTO usuario(nombre, apellido, edad, dni, contrasena, telefono, direccion, correo, sexo, adicional, avatar, id_tipo, id_localidad)
				VALUES(:nombre, :apellido, :edad, :dni, :contrasena, :telefono, :direccion, :correo, :sexo, :adicional, :avatar, :id_tipo, :id_localidad)";
		$variables = array(
			':nombre' 		=> $nombre,
			':apellido' 	=> $apellido,
			':edad' 		=> $edad,
			':dni' 			=> $dni,
			':contrasena'	=> $contrasena,
			':telefono' 	=> $telefono,
			':direccion' 	=> $direccion,
			':correo' 		=> $correo,
			':sexo' 		=> $sexo,
			':adicional' 	=> $adicional,
			':avatar' 		=> 'default.png',
			':id_tipo' 		=> 3,
			':id_localidad' => $id_localidad
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function borrar($id)
	{
		$sql = "UPDATE usuario 
				SET estado=:estado 
				WHERE id=:id";
		$variables = array(
			':id' 		=> $id,
			':estado'	=> 'I'
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function activar($id)
	{
		$sql = "UPDATE usuario 
				SET estado=:estado 
				WHERE id=:id";
		$variables = array(
			':id' 		=> $id,
			':estado'	=> 'A'
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function actualizar_tipo_usuario($id, $tipo_usuario)
	{
		$sql = "UPDATE usuario 
				SET id_tipo=:tipo_usuario 
				WHERE id=:id";
		$variables = array(
			':id' 			=> $id,
			':tipo_usuario'	=> $tipo_usuario
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	/******************************/
}
