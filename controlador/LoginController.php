<?php 
include_once '../modelo/Usuario.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$usuario = new Usuario();

if($user == '' || $pass == ''){
	header('location: ../index.php');
}


if(!empty($_SESSION['us_tipo'])){
	
	switch ($_SESSION['us_tipo']) {
			case 1:
				header('location: ../vista/adm_catalogo.php');
				break;
			
			case 2:
				header('location: ../vista/adm_catalogo.php');
				break;

			case 3:
				header('location: ../vista/adm_catalogo.php');
				break;
		}
}
else{
	
	if(!empty($usuario->Loguearse($user,$pass)=="logueado")){
		$usuario->obtener_dato_logueo($user);
		foreach ($usuario->objetos as $objeto) {
			$_SESSION['usuario']=$objeto->id_usuario;
			$_SESSION['us_tipo']=$objeto->us_tipo;
			$_SESSION['nombre_us']=$objeto->nombre_us;
			$_SESSION['apellidos_us']=$objeto->apellidos_us;
		}
		switch ($_SESSION['us_tipo']) {
			case 1:
				header('location: ../vista/adm_catalogo.php');
				break;
			
			case 2:
				header('location: ../vista/adm_catalogo.php');
				break;

			case 3:
				header('location: ../vista/adm_catalogo.php');
				break;
		}

	}
	else{
		header('location: ../index.php');
	}
}


 ?>