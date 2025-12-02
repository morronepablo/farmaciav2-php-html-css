<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Models/Conexion.php';
class Venta
{
	var $objetos;
	var $acceso;
	public function __construct()
	{
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function crear($grabada, $descuento, $iva, $total, $comprobante, $cliente, $usuario)
	{
		$sql = "CALL crear_venta(:grabada, :descuento, :iva, :total, :comprobante, :cliente, :usuario)";
		$variables = array(
			':grabada' 		=> $grabada,
			':descuento' 	=> $descuento,
			':iva' 			=> $iva,
			':total' 		=> $total,
			':comprobante' 	=> $comprobante,
			':cliente' 		=> $cliente,
			':usuario' 		=> $usuario,
		);
		$query = $this->acceso->prepare($sql);
		$query->execute($variables);
		$this->objetos = $query->fetchall();
		return $this->objetos;
	}
}
