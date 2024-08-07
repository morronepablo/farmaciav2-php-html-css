<?php
include_once 'conexion.php';
class lote
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}
	function crear($id_producto, $proveedor, $stock, $vencimiento)
	{
		$sql = "INSERT INTO lote(stock,vencimiento,lote_id_prod,lote_id_prov) values (:stock,:vencimiento,:id_producto,:id_proveedor)";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':stock' => $stock, 'vencimiento' => $vencimiento, 'id_producto' => $id_producto, 'id_proveedor' => $proveedor));
		echo 'add';
	}
	function buscar()
	{
		if (!empty($_POST['consulta'])) {
			$consulta = $_POST['consulta'];
			$sql = "SELECT l.id as id_lote,l.codigo as codigo,cantidad_lote,vencimiento,concentracion,adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tip_nom,
			presentacion.nombre as pre_nom, proveedor.nombre as proveedor, producto.avatar as logo
			FROM lote as l
			join compra on l.id_compra = compra.id and l.estado = 'A'
			join proveedor on proveedor.id_proveedor=compra.id_proveedor
			join producto on producto.id_producto=l.id_producto
			join laboratorio on prod_lab=id_laboratorio
			join tipo_producto on prod_tip_prod=id_tip_prod
			join presentacion on prod_present=id_presentacion and producto.nombre like :consulta order by producto.nombre limit 25";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':consulta' => "%$consulta%"));
			$this->objetos = $query->fetchall();
			return $this->objetos;
		} else {

			$sql = "SELECT l.id as id_lote,l.codigo as codigo,cantidad_lote,vencimiento,concentracion,adicional, producto.nombre as prod_nom, laboratorio.nombre as lab_nom, tipo_producto.nombre as tip_nom,
				presentacion.nombre as pre_nom, proveedor.nombre as proveedor, producto.avatar as logo
				FROM lote as l
				join compra on l.id_compra = compra.id and l.estado = 'A'
				join proveedor on proveedor.id_proveedor=compra.id_proveedor
				join producto on producto.id_producto=l.id_producto
				join laboratorio on prod_lab=id_laboratorio
				join tipo_producto on prod_tip_prod=id_tip_prod
				join presentacion on prod_present=id_presentacion and producto.nombre not like '' order by producto.nombre limit 25";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos = $query->fetchall();
			return $this->objetos;
		}
	}
	function editar($id, $stock)
	{
		$sql = "UPDATE lote SET cantidad_lote=:stock where id=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id, 'stock' => $stock));
		echo 'edit';
	}
	function borrar($id)
	{
		$sql = "UPDATE lote SET estado='I' where id=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		if (!empty($query->execute(array(':id' => $id)))) {
			echo 'borrado';
		} else {
			echo 'noborrado';
		}
	}
	function devolver($id_lote, $cantidad, $vencimiento, $producto, $proveedor)
	{
		$sql = "SELECT * FROM lote WHERE id=:id_lote";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id_lote' => $id_lote));
		$lote = $query->fetchall();

		$sql = "UPDATE lote SET cantidad_lote=cantidad_lote+:cantidad,estado='A' WHERE id=:id_lote";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':cantidad' => $cantidad, ':id_lote' => $id_lote));
	}
	////////////////////////////Actualiacion/////////////////////////////////////
	function crear_lote($codigo, $cantidad, $vencimiento, $precio_compra, $id_compra, $id_producto)
	{
		$sql = "INSERT INTO lote(codigo,cantidad,cantidad_lote,vencimiento,precio_compra,id_compra,id_producto) values (:codigo,:cantidad,:cantidad_lote,:vencimiento,:precio_compra,:id_compra,:id_producto)";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':codigo' => $codigo, ':cantidad' => $cantidad, ':cantidad_lote' => $cantidad, ':vencimiento' => $vencimiento, ':precio_compra' => $precio_compra, ':id_compra' => $id_compra, ':id_producto' => $id_producto));
		echo 'add';
	}
	function ver($id)
	{
		$sql = "SELECT l.codigo as codigo, l.cantidad as cantidad, vencimiento, precio_compra, p.nombre as producto, concentracion, adicional,
				la.nombre as laboratorio, t.nombre as tipo, pre.nombre as presentacion
				FROM lote as l
				join producto as p on l.id_producto=p.id_producto and id_compra=:id
				join laboratorio as la on prod_lab=id_laboratorio
				join tipo_producto as t on prod_tip_prod=id_tip_prod
				join presentacion as pre on prod_present=id_presentacion";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id' => $id));
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}


// function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
// 	$sql="SELECT * FROM lote WHERE id_lote=:id_lote";
// 	$query = $this->acceso->prepare($sql);
// 	$query->execute(array(':id_lote'=>$id_lote));
// 	$lote=$query->fetchall();
// 	if(!empty($lote)){
// 		$sql="UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
// 		$query = $this->acceso->prepare($sql);
// 		$query->execute(array(':cantidad'=>$cantidad,'id_lote'=>$id_lote));
// 	}
// 	else{
// 		$sql="SELECT * FROM lote WHERE vencimiento=:vencimiento and lote_id_prod=:producto and lote_id_prov=:proveedor";
// 		$query = $this->acceso->prepare($sql);
// 		$query->execute(array(':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
// 		$lote_nuevo=$query->fetchall();
// 		foreach ($lote_nuevo as $objeto) {
// 			$id_lote_nuevo = $objeto->id_lote;
// 		}
// 		if(!empty($lote_nuevo)){
// 			$sql="UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
// 			$query = $this->acceso->prepare($sql);
// 			$query->execute(array(':cantidad'=>$cantidad,'id_lote'=>$id_lote_nuevo));
// 		}
// 		else{
// 			$sql="INSERT INTO lote(id_lote,stock,vencimiento,lote_id_prod,lote_id_prov) values(:id_lote,:stock,:vencimiento,:producto,:proveedor)";
// 			$query = $this->acceso->prepare($sql);
// 			$query->execute(array(':id_lote'=>$id_lote,'stock'=>$cantidad,':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
// 		}
// 	}
// }
