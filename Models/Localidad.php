<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Conexion.php';
class Localidad{
	var $objetos;
	public function __construct(){
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function obtener_residencias(){
		$sql="SELECT 
			  l.id,
			  CONCAT(l.nombre,' - ', p.nombre) as residencia
			  FROM localidad l
			  JOIN provincia p ON p.id = l.id_provincia";
		// $variables = array(
		// 	':dni' => $dni
		// );
		$query = $this->acceso->prepare($sql);
		$query->execute();
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
	
}

 ?>