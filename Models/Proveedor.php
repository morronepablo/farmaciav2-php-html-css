<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Conexion.php';
class Proveedor {
	var $objetos;
	public function __construct(){
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function obtener_proveedores(){
		$sql="SELECT * FROM proveedor ORDER BY nombre";
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos= $query->fetchall();
		return $this->objetos;
	}

	function encontrar_proveedor($nombre){
		$sql="SELECT *
			  FROM proveedor
			  WHERE nombre=:nombre";
		$variables = array(
			':nombre' => $nombre
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos= $query->fetchall();
		return $this->objetos;
	}

	function crear($nombre, $telefono, $correo, $direccion) {
		$sql = "INSERT INTO proveedor(nombre, telefono, correo, direccion)
				VALUES(:nombre, :telefono, :correo, :direccion)";
		$variables = array(
			':nombre' 		=> $nombre,
			':telefono' 	=> $telefono,
			':correo' 		=> $correo,
			':direccion' 	=> $direccion
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function editar($id_tipo, $nombre) {
		$sql = "UPDATE tipo_producto SET nombre=:nombre WHERE id=:id_tipo";
		$variables = array(
			':nombre'	=> $nombre,
			':id_tipo'	=> $id_tipo,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
	}

	function obtener_laboratorio_id($id){
		$sql="SELECT * FROM laboratorio WHERE id=:id";
		$variables = array(
			':id' => $id
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos= $query->fetchall();
		return $this->objetos;
	}

	function eliminar($id_tipo) {
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

	function activar($id_tipo) {
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

 ?>