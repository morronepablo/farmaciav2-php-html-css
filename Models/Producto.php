<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Producto
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}
	function obtener_productos()
	{
		$sql = "SELECT 
			  p.id as id,
			  p.codigo,
			  p.nombre as nombre,
			  p.concentracion,
			  p.fracciones,
			  p.registro_sanitario,
			  p.precio,
			  p.avatar as avatar,
			  p.estado as estado,
			  p.fecha_creacion as fecha_creacion,
			  p.fecha_edicion as fecha_edicion,
			  l.nombre as laboratorio,
			  tt.nombre as tipo,
			  t.nombre as subtipo,
			  pre.nombre as presentacion
			  FROM producto p
			  JOIN laboratorio l ON p.id_laboratorio=l.id
			  JOIN subtipo_producto t ON p.id_subtipo_producto=t.id
			  JOIN tipo_producto tt ON tt.id=t.id_tipo_producto
			  JOIN presentacion pre ON p.id_presentacion=pre.id
			  WHERE p.estado='A' ORDER BY p.nombre
		";
		/*$variables = array(
			':dni' => $dni
		);*/
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function obtener_gestion_productos()
	{
		$sql = "SELECT 
			  p.id as id,
			  p.codigo,
			  p.nombre as nombre,
			  p.concentracion,
			  p.fracciones,
			  p.registro_sanitario,
			  p.precio,
			  p.avatar as avatar,
			  p.estado as estado,
			  p.fecha_creacion as fecha_creacion,
			  p.fecha_edicion as fecha_edicion,
			  l.nombre as laboratorio,
			  l.id as id_laboratorio,
			  t.nombre as subtipo,
			  t.id as id_subtipo,
			  pre.nombre as presentacion,
			  pre.id as id_presentacion
			  FROM producto p
			  JOIN laboratorio l ON p.id_laboratorio=l.id
			  JOIN subtipo_producto t ON p.id_subtipo_producto=t.id
			  JOIN presentacion pre ON p.id_presentacion=pre.id
			  ORDER BY p.nombre
		";
		/*$variables = array(
			':dni' => $dni
		);*/
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function obtener_stock($id)
	{
		$sql = "SELECT SUM(cantidad_lote) as total FROM lote where id_producto=:id and estado = 'A'";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function encontrar_producto($codigo)
	{
		$sql = "SELECT id
		FROM producto WHERE codigo=:codigo";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':codigo' => $codigo));
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function crear($codigo, $nombre, $concentracion, $fraccion, $sanitario, $precio, $id_subtipo, $id_presentacion, $id_laboratorio)
	{
		$sql = "INSERT INTO producto(codigo,nombre,concentracion,fracciones,registro_sanitario,precio,id_laboratorio,id_subtipo_producto,id_presentacion) 
		VALUES (:codigo,:nombre,:concentracion,:fracciones,:registro_sanitario,:precio,:id_laboratorio,:id_subtipo_producto,:id_presentacion)
		";
		$variables = array(
			':codigo' 				=> $codigo,
			':nombre' 				=> $nombre,
			':concentracion' 		=> $concentracion,
			':fracciones' 			=> $fraccion,
			':registro_sanitario' 	=> $sanitario,
			':precio' 				=> $precio,
			':id_laboratorio' 		=> $id_laboratorio,
			':id_subtipo_producto' 	=> $id_subtipo,
			':id_presentacion' 		=> $id_presentacion,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function encontrar_producto_editar($id_producto, $nombre, $concentracion, $id_subtipo, $id_presentacion, $fraccion, $sanitario, $id_laboratorio)
	{
		$sql = "SELECT id 
		FROM producto 
		WHERE nombre=:nombre 
		AND concentracion=:concentracion 
		AND fracciones=:fracciones 
		AND registro_sanitario=:registro_sanitario 
		AND id_laboratorio=:id_laboratorio 
		AND id_subtipo_producto=:id_subtipo_producto 
		AND id_presentacion=:id_presentacion 
		AND id!=:id
		";
		$variables = array(
			':id' 					=> $id_producto,
			':nombre' 				=> $nombre,
			':concentracion' 		=> $concentracion,
			':fracciones' 			=> $fraccion,
			':registro_sanitario' 	=> $sanitario,
			':id_laboratorio' 		=> $id_laboratorio,
			':id_subtipo_producto' 	=> $id_subtipo,
			':id_presentacion' 		=> $id_presentacion,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchAll();
		return $this->objetos;
	}
	function editar($id_producto, $nombre, $concentracion, $id_subtipo, $id_presentacion, $fraccion, $sanitario, $precio, $id_laboratorio)
	{
		$sql = "UPDATE producto 
		SET nombre=:nombre, 
		concentracion=:concentracion, 
		fracciones=:fracciones, 
		registro_sanitario=:registro_sanitario, 
		precio=:precio, 
		id_laboratorio=:id_laboratorio, 
		id_subtipo_producto=:id_subtipo_producto, 
		id_presentacion=:id_presentacion 
		WHERE id=:id
		";
		$variables = array(
			':id' 					=> $id_producto,
			':nombre' 				=> $nombre,
			':concentracion' 		=> $concentracion,
			':fracciones' 			=> $fraccion,
			':registro_sanitario' 	=> $sanitario,
			':precio' 				=> $precio,
			':id_laboratorio' 		=> $id_laboratorio,
			':id_subtipo_producto' 	=> $id_subtipo,
			':id_presentacion' 		=> $id_presentacion,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function eliminar($id_producto)
	{
		$sql = "UPDATE producto 
				SET estado=:estado
				WHERE id=:id_producto";
		$variables = array(
			':id_producto'	=> $id_producto,
			':estado' 		=> 'I',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function activar($id_producto)
	{
		$sql = "UPDATE producto 
				SET estado=:estado
				WHERE id=:id_producto";
		$variables = array(
			':id_producto'	=> $id_producto,
			':estado' 		=> 'A',
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
	function encontrar_producto_id($id)
	{
		$sql = "SELECT 
			  p.id as id,
			  p.codigo,
			  p.nombre as nombre,
			  p.concentracion,
			  p.fracciones,
			  p.registro_sanitario,
			  p.precio,
			  p.avatar as avatar,
			  p.estado as estado,
			  p.fecha_creacion as fecha_creacion,
			  p.fecha_edicion as fecha_edicion,
			  l.nombre as laboratorio,
			  t.nombre as subtipo,
			  pre.nombre as presentacion
			  FROM producto p
			  JOIN laboratorio l ON p.id_laboratorio=l.id
			  JOIN subtipo_producto t ON p.id_subtipo_producto=t.id
			  JOIN presentacion pre ON p.id_presentacion=pre.id
			  WHERE p.id=:id
		";
		$variables = array(
			':id' => $id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	function editar_avatar($id_producto, $nombre)
	{
		$sql = "UPDATE producto 
				SET avatar=:nombre
				WHERE id=:id_producto";
		$variables = array(
			':id_producto'	=> $id_producto,
			':nombre' 		=> $nombre,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}
}
