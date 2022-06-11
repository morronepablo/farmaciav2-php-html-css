<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Conexion.php';
class Producto{
	var $objetos;
	public function __construct(){
		$db= new Conexion();
		$this->acceso = $db->pdo;
	}
	function obtener_productos() {
		$sql="SELECT 
			  p.id as id,
			  p.nombre as nombre,
			  p.concentracion,
			  p.adicional,
			  p.precio,
			  p.codigo,
			  p.fracciones,
			  p.registro_sanitario,
			  l.nombre as laboratorio,
			  t.nombre as tipo,
			  pre.nombre as presentacion,
			  p.avatar as avatar,
			  p.fecha_creacion as fecha_creacion,
			  p.fecha_edicion as fecha_edicion
			  FROM producto p
			  JOIN laboratorio l ON p.id_laboratorio=l.id
			  JOIN tipo_producto t ON p.id_tipo_producto=t.id
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
	function obtener_stock($id){
		$sql="SELECT SUM(cantidad_lote) as total FROM lote where id_producto=:id and estado = 'A'";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id));
		$this->objetos=$query->fetchall();
		return $this->objetos;
	}

	/*************************************************** */
	function crear($nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion,$avatar){
		$sql="SELECT id_producto,estado FROM producto where nombre=:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
		$this->objetos=$query->fetchall();
		if(!empty($this->objetos)){

				foreach ($this->objetos as $prod) {
					$prod_id_producto = $prod->id_producto;
					$prod_estado = $prod->estado;
				}
				if($prod_estado=='A'){
						echo 'noadd';
				}
				else{
					$sql="UPDATE producto SET estado='A' where id_producto=:id ";
					$query = $this->acceso->prepare($sql);
					$query->execute(array(':id'=>$prod_id_producto));
					echo 'add';
				}
		}
		else{
			$sql="INSERT INTO producto(nombre,concentracion,adicional,precio,prod_lab,prod_tip_prod,prod_present,avatar) values (:nombre,:concentracion,:adicional,:precio,:laboratorio,:tipo,:presentacion,:avatar);";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':precio'=>$precio,':avatar'=>$avatar));
			echo 'add';
		}
	}
	function editar($id,$nombre,$concentracion,$adicional,$precio,$laboratorio,$tipo,$presentacion){
		$sql="SELECT id_producto FROM producto where id_producto!=:id and nombre=:nombre and concentracion=:concentracion and adicional=:adicional and prod_lab=:laboratorio and prod_tip_prod=:tipo and prod_present=:presentacion";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion));
		$this->objetos=$query->fetchall();
		if(!empty($this->objetos)){
			echo 'noedit';
		}
		else{
			$sql="UPDATE producto SET nombre=:nombre, concentracion=:concentracion, adicional=:adicional, prod_lab=:laboratorio, prod_tip_prod=:tipo, prod_present=:presentacion, precio=:precio where id_producto=:id";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':id'=>$id,':nombre'=>$nombre,':concentracion'=>$concentracion,':adicional'=>$adicional,':laboratorio'=>$laboratorio,':tipo'=>$tipo,':presentacion'=>$presentacion,':precio'=>$precio));
			echo 'edit';
		}
	}
	
	function cambiar_logo($id,$nombre){
		$sql="UPDATE producto SET avatar=:nombre where id_producto=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id,':nombre'=>$nombre));
	}
	function borrar($id){
		$sql="SELECT * FROM lote where id_producto=:id and estado='A'";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id));
		$lote=$query->fetchall();
		if(!empty($lote)){
				echo 'noborrado';
		}
		else{
			$sql="UPDATE producto SET estado='I' where id_producto=:id";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':id'=>$id));
			if(!empty($query->execute(array(':id'=>$id)))){
				echo 'borrado';
			}
			else{
				echo 'noborrado';
			}
		}

	}
	
	function buscar_id($id){
		$sql="SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion, producto.avatar as avatar, prod_lab, prod_tip_prod, prod_present
				FROM producto
				join laboratorio on prod_lab=id_laboratorio
				join tipo_producto on prod_tip_prod=id_tip_prod
				join presentacion on prod_present=id_presentacion where id_producto=:id";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':id'=>$id));
			$this->objetos=$query->fetchall();
			return $this->objetos;
	}
	function reporte_producto(){

			$sql="SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion, producto.avatar as avatar, prod_lab, prod_tip_prod, prod_present
				FROM producto
				join laboratorio on prod_lab=id_laboratorio
				join tipo_producto on prod_tip_prod=id_tip_prod
				join presentacion on prod_present=id_presentacion and producto.nombre not like '' order by producto.nombre";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos=$query->fetchall();
			return $this->objetos;

	}
	function rellenar_productos(){
		$sql="SELECT id_producto, producto.nombre as nombre, concentracion, adicional, precio, laboratorio.nombre as laboratorio, tipo_producto.nombre as tipo, presentacion.nombre as presentacion
			FROM producto
			join laboratorio on prod_lab=id_laboratorio and producto.estado='A'
			join tipo_producto on prod_tip_prod=id_tip_prod
			join presentacion on prod_present=id_presentacion order by nombre asc";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos=$query->fetchall();
			return $this->objetos;
	}

}


 ?>
