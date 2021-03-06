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
		$contrasena = $usuario->objetos[0]->contrasena;
		if($pass == $contrasena) {
			$_SESSION['id'] = $usuario->objetos[0]->id;
			$_SESSION['nombre'] = $usuario->objetos[0]->nombre;
			$_SESSION['apellido'] = $usuario->objetos[0]->apellido;
			$_SESSION['dni'] = $usuario->objetos[0]->dni;
			$_SESSION['avatar'] = $usuario->objetos[0]->avatar;
			$_SESSION['id_tipo'] = $usuario->objetos[0]->id_tipo;
			$_SESSION['tipo'] = $usuario->objetos[0]->tipo;
			$mensaje = 'success';
		} else {
			$mensaje = 'error';
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

if($_POST['funcion']=='obtener_usuario'){
	$json=array();
	$id_usuario = $_SESSION['id'];
	$fecha_actual = new DateTime();
	$usuario->obtener_datos($id_usuario);
	if(!empty($usuario->objetos)) {
		$nacimiento = new DateTime($usuario->objetos[0]->edad);
		$edad = $nacimiento->diff($fecha_actual);
		$edad_years = $edad->y;
		$json = array(
			'id'		 => openssl_encrypt($usuario->objetos[0]->id, CODE, KEY),
			'nombre'	 =>$usuario->objetos[0]->nombre,
			'apellido'	 =>$usuario->objetos[0]->apellido,
			'edad'		 =>$edad_years,
			'dni'		 =>$usuario->objetos[0]->dni,
			'id_tipo'	 =>$usuario->objetos[0]->id_tipo,
			'tipo'		 =>$usuario->objetos[0]->tipo,
			'telefono'   =>$usuario->objetos[0]->telefono,
			'residencia' =>$usuario->objetos[0]->residencia,
			'direccion'  =>$usuario->objetos[0]->direccion,
			'correo'	 =>$usuario->objetos[0]->correo,
			'sexo'		 =>$usuario->objetos[0]->sexo,
			'adicional'	 =>$usuario->objetos[0]->adicional,
			'avatar'	 =>$usuario->objetos[0]->avatar
		);
		$jsonstring = json_encode($json);
		echo $jsonstring;
	} else {
		echo 'error';
	}
}
/*****************************************/

if($_POST['funcion']=='capturar_datos'){
	$json=array();
	$id_usuario=$_POST['id_usuario'];
	$usuario->obtener_datos($id_usuario);
	foreach ($usuario->objetos as $objeto) {
		$json[]=array(
			'telefono'=>$objeto->telefono_us,
			'residencia'=>$objeto->residencia_us,
			'correo'=>$objeto->correo_us,
			'sexo'=>$objeto->sexo_us,
			'adicional'=>$objeto->adicional_us
		);
	}
	$jsonstring = json_encode($json[0]);
	echo $jsonstring;
}
if($_POST['funcion']=='editar_usuario'){
	$id_usuario=$_POST['id_usuario'];
	$telefono=$_POST['telefono'];
	$residencia=$_POST['residencia'];
	$correo=$_POST['correo'];
	$sexo=$_POST['sexo'];
	$adicional=$_POST['adicional'];
	$usuario->editar($id_usuario,$telefono,$residencia,$correo,$sexo,$adicional);
	echo 'editado';
}
if($_POST['funcion']=='cambiar_contra'){
	$id_usuario=$_POST['id_usuario'];
	$oldpass=$_POST['oldpass'];
	$newpass=$_POST['newpass'];
	$usuario->cambiar_contra($id_usuario,$oldpass,$newpass);
}
if($_POST['funcion']=='cambiar_foto'){
	if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')){
		$nombre=uniqid().'-'.$_FILES['photo']['name'];
		$ruta='../img/'.$nombre;
		move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
		$usuario->cambiar_photo($id_usuario,$nombre);
		foreach ($usuario->objetos as $objeto) {
			unlink('../img/'.$objeto->avatar);
		}
		$json= array();
		$json[]=array(
			'ruta'=>$ruta,
			'alert'=>'edit'
		);
		$jsonstring = json_encode($json[0]);
		echo $jsonstring;
	}
	else{
		$json= array();
		$json[]=array(
			'alert'=>'noedit'
		);
		$jsonstring = json_encode($json[0]);
		echo $jsonstring;
	}
}
if($_POST['funcion']=='buscar_usuarios_adm'){
	$json=array();
	$fecha_actual = new DateTime();
	$usuario->buscar();
	foreach ($usuario->objetos as $objeto) {
		$nacimiento = new DateTime($objeto->edad);
		$edad = $nacimiento->diff($fecha_actual);
		$edad_years = $edad->y;
		$json[]=array(
			'id'=>$objeto->id_usuario,
			'nombre'=>$objeto->nombre_us,
			'apellidos'=>$objeto->apellidos_us,
			'edad'=>$edad_years,
			'dni'=>$objeto->dni_us,
			'tipo'=>$objeto->nombre_tipo,
			'telefono'=>$objeto->telefono_us,
			'residencia'=>$objeto->residencia_us,
			'correo'=>$objeto->correo_us,
			'sexo'=>$objeto->sexo_us,
			'adicional'=>$objeto->adicional_us,
			'avatar'=>'../img/'.$objeto->avatar,
			'tipo_usuario'=>$objeto->us_tipo
		);
	}
	$jsonstring = json_encode($json);
	echo $jsonstring;
}
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