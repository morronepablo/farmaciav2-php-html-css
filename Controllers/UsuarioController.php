<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Usuario.php';
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/Config/config.php';
$usuario = new Usuario();
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha_actual = date('d-m-Y');

if($_POST['funcion']=='login'){
	$dni  = $_POST['dni'];
	$pass = $_POST['pass'];
	$usuario->login($dni);
	$mensaje = '';
	if(!empty($usuario->objetos)) {
		$pass_base	= openssl_decrypt($usuario->objetos[0]->contrasena, CODE, KEY);
		if($pass_base != '') {
			// password de la base encriptado
			if($pass == $pass_base) {
				// cambio de password
				$_SESSION['id'] = $usuario->objetos[0]->id;
				$_SESSION['nombre'] = $usuario->objetos[0]->nombre;
				$_SESSION['apellido'] = $usuario->objetos[0]->apellido;
				$_SESSION['dni'] = $usuario->objetos[0]->dni;
				$_SESSION['avatar'] = $usuario->objetos[0]->avatar;
				$_SESSION['id_tipo'] = $usuario->objetos[0]->id_tipo;
				$_SESSION['tipo'] = $usuario->objetos[0]->tipo;
				$mensaje = 'success';
			} else {
				$mensaje = 'error_pass';
			}
		} else {
			// password de la base no encriptado
			if($pass == $usuario->objetos[0]->contrasena) {
				// cambio de password
				$_SESSION['id'] = $usuario->objetos[0]->id;
				$_SESSION['nombre'] = $usuario->objetos[0]->nombre;
				$_SESSION['apellido'] = $usuario->objetos[0]->apellido;
				$_SESSION['dni'] = $usuario->objetos[0]->dni;
				$_SESSION['avatar'] = $usuario->objetos[0]->avatar;
				$_SESSION['id_tipo'] = $usuario->objetos[0]->id_tipo;
				$_SESSION['tipo'] = $usuario->objetos[0]->tipo;
				$mensaje = 'success';
			} else {
				$mensaje = 'error_pass';
			}
		}
	} else {
		$mensaje = 'error';
	}
	//echo $dni.' '.$pass;
	$json = array(
		'mensaje'=> $mensaje
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
} else if($_POST['funcion']=='verificar_sesion'){
	if(!empty($_SESSION['id'])) {
		$json = array(
			'id' 	   => $_SESSION['id'],
			'nombre'   => $_SESSION['nombre'],
			'apellido' => $_SESSION['apellido'],
			'dni' 	   => $_SESSION['dni'],
			'avatar'   => $_SESSION['avatar'],
			'id_tipo'  => $_SESSION['id_tipo'],
			'tipo' 	   => $_SESSION['tipo']
		);
	} else {
		$json = array();
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='obtener_usuario'){
	$json=array();
	$id_usuario = $_SESSION['id'];
	$usuario->obtener_datos($id_usuario);
	if(!empty($usuario->objetos)) {
		$nacimiento = new DateTime($usuario->objetos[0]->edad);
		$fecha_actual = new DateTime();
		$edad = $nacimiento->diff($fecha_actual);
		$edad_years = $edad->y;
		$json = array(
			'id'		 		=>	openssl_encrypt($usuario->objetos[0]->id, CODE, KEY),
			'nombre'	 		=>	$usuario->objetos[0]->nombre,
			'apellido'	 		=>	$usuario->objetos[0]->apellido,
			'edad'		 		=>	$edad_years,
			'dni'		 		=>	$usuario->objetos[0]->dni,
			'id_tipo'	 		=>	$usuario->objetos[0]->id_tipo,
			'tipo'		 		=>	$usuario->objetos[0]->tipo,
			'telefono'   		=>	$usuario->objetos[0]->telefono,
			'residencia' 		=>	$usuario->objetos[0]->residencia,
			'id_residencia' 	=>	openssl_encrypt($usuario->objetos[0]->id_residencia, CODE, KEY),
			'direccion'  		=>	$usuario->objetos[0]->direccion,
			'correo'	 		=>	$usuario->objetos[0]->correo,
			'sexo'		 		=>	$usuario->objetos[0]->sexo,
			'adicional'	 		=>	$usuario->objetos[0]->adicional,
			'avatar'	 		=>	$usuario->objetos[0]->avatar,
			'id_tipo_sesion'	=>	$_SESSION['id_tipo']
		);
		$jsonstring = json_encode($json);
		echo $jsonstring;
	} else {
		echo 'error';
	}
}

else if($_POST['funcion']=='editar_datos'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario 	= $_SESSION['id'];
		$telefono 		= $_POST['telefono'];
		$residencia 	= $_POST['residencia'];
		$direccion 		= $_POST['direccion'];
		$correo 		= $_POST['correo'];
		$sexo 			= $_POST['sexo'];
		$adicional 		= $_POST['adicional'];
		$formateado		= str_replace(' ', '+', $residencia);
		$id_residencia	= openssl_decrypt($formateado, CODE, KEY);
		if(is_numeric($id_residencia)) {
			$usuario->editar_datos($id_usuario,$telefono,$id_residencia,$direccion,$correo,$sexo,$adicional);
			$mensaje = 'success';
		} else {
			$mensaje = 'error_decrypt';
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='editar_avatar'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario = $_SESSION['id'];
		$nombre		= uniqid().'-'.$_FILES['avatar_mod']['name'];
		$ruta		= $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/img/user/'.$nombre;
		move_uploaded_file($_FILES['avatar_mod']['tmp_name'],$ruta);
		$avatar 	= $_SESSION['avatar'];
		if($avatar != 'default.png') {
			unlink($_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Util/img/user/'.$avatar);
		}
		$_SESSION['avatar'] = $nombre;
		$usuario->editar_avatar($id_usuario,$nombre);
		$mensaje = 'success';
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje,
		'img' 		=>	$nombre
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='editar_password'){
	$mensaje = '';
	if(!empty($_SESSION['id'])) {
		$id_usuario = $_SESSION['id'];
		$oldpass	= $_POST['oldpass'];
		$newpass	= $_POST['newpass'];
		$usuario->obtener_datos($id_usuario);
		$pass_base	= openssl_decrypt($usuario->objetos[0]->contrasena, CODE, KEY);
		if($pass_base != '') {
			// password de la base encriptado
			if($oldpass == $pass_base) {
				// cambio de password
				$nueva_pass = openssl_encrypt($newpass, CODE, KEY);
				$usuario->editar_password($id_usuario, $nueva_pass);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_pass';
			}
		} else {
			// password de la base no encriptado
			if($oldpass == $usuario->objetos[0]->contrasena) {
				// cambio de password
				$nueva_pass = openssl_encrypt($newpass, CODE, KEY);
				$usuario->editar_password($id_usuario, $nueva_pass);
				$mensaje = 'success';
			} else {
				$mensaje = 'error_pass';
			}
		}
	} else {
		$mensaje = 'error_session';
	}
	$json = array(
		'mensaje'	=>	$mensaje
	);
	$jsonstring = json_encode($json);
	echo $jsonstring;
}

else if($_POST['funcion']=='obtener_usuarios'){
	$json = array();
	$usuario->obtener_usuarios();
	foreach ($usuario->objetos as $objeto) {
		$nacimiento = new DateTime($objeto->edad);
		$fecha_actual = new DateTime();
		$edad = $nacimiento->diff($fecha_actual);
		$edad_years = $edad->y;
		$json[] = array(
			'id'		 	=>	openssl_encrypt($objeto->id, CODE, KEY),
			'nombre'	 	=>	$objeto->nombre,
			'apellido'	 	=>	$objeto->apellido,
			'edad'		 	=>	$edad_years,
			'dni'		 	=>	$objeto->dni,
			'id_tipo'	 	=>	$objeto->id_tipo,
			'tipo'		 	=>	$objeto->tipo,
			'telefono'   	=>	$objeto->telefono,
			'residencia' 	=>	$objeto->residencia,
			'id_residencia' =>	openssl_encrypt($objeto->id_residencia, CODE, KEY),
			'direccion'  	=>	$objeto->direccion,
			'correo'	 	=>	$objeto->correo,
			'sexo'		 	=>	$objeto->sexo,
			'adicional'	 	=>	$objeto->adicional,
			'avatar'	 	=>	$objeto->avatar
		);
		$jsonstring = json_encode($json);
		echo $jsonstring;
	}
}
/*****************************************/


if($_POST['funcion']=='crear_usuario'){
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$edad = $_POST['edad'];
	$dni = $_POST['dni'];
	$pass = $_POST['pass'];
	$tipo=2;
	$avatar='default.png';
	$usuario->crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar);
}
if($_POST['funcion']=='ascender'){
	$pass=$_POST['pass'];
	$id_ascendido=$_POST['id_usuario'];
	$usuario->ascender($pass,$id_ascendido,$id_usuario);
}
if($_POST['funcion']=='descender'){
	$pass=$_POST['pass'];
	$id_descendido=$_POST['id_usuario'];
	$usuario->descender($pass,$id_descendido,$id_usuario);
}
if($_POST['funcion']=='borrar_usuario'){
	$pass=$_POST['pass'];
	$id_borrado=$_POST['id_usuario'];
	$usuario->borrar($pass,$id_borrado,$id_usuario);
}
if($_POST['funcion']=='devolver_avatar'){
	$usuario->devolver_avatar($id_usuario);
	$json=array();
	foreach ($usuario->objetos as $objeto) {
		$json=$objeto;
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
if($_POST['funcion']=='tipo_usuario'){
	echo $tipo_usuario;
}





 ?>