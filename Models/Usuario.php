<?php 
include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Models/Conexion.php';
class Usuario{
	var $objetos;
	public function __construct(){
		$db = new Conexion();
		$this->acceso = $db->pdo;
	}

	function login($dni){
		$sql="SELECT 
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
	function obtener_datos($id_usuario){
		$sql="SELECT 
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
		$this->objetos= $query->fetchall();
		return $this->objetos;
	}
	function editar_datos($id_usuario,$telefono,$residencia,$direccion,$correo,$sexo,$adicional){
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
	function editar_avatar($id_usuario,$nombre){
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
	function editar_password($id_usuario,$newpass){
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
	function obtener_usuarios(){
		$sql="SELECT 
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
		$this->objetos= $query->fetchall();
		return $this->objetos;
	}
	function crear($nombre, $apellido, $edad, $dni, $contrasena, $telefono, $id_localidad, $direccion, $correo, $sexo, $adicional) {
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
	function borrar($id){
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
	function activar($id){
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
	/******************************/
	
	function ascender($pass,$id_ascendido,$id_usuario){
		$sql="SELECT * FROM usuario where id_usuario=:id_usuario";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id_usuario'=>$id_usuario));
		$this->objetos=$query->fetchall();
		foreach ($this->objetos as $objeto) {
			$contrasena_actual = $objeto->contrasena_us;
		}
		if(strpos($contrasena_actual,'$2y$10$')===0){
			if(password_verify($pass, $contrasena_actual)){
				$tipo=1;
				$sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
				echo 'ascendido';
			}
			else{
				echo 'noascendido';
			}			
		}
		else{
			if($pass==$contrasena_actual){
				$tipo=1;
				$sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_ascendido,':tipo'=>$tipo));
				echo 'ascendido';				
			}
			else{
				echo 'noascendido';
			}			
		}
	}
	
	function descender($pass,$id_descendido,$id_usuario){
		$sql="SELECT * FROM usuario where id_usuario=:id_usuario";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id_usuario'=>$id_usuario));
		$this->objetos=$query->fetchall();
		foreach ($this->objetos as $objeto) {
			$contrasena_actual = $objeto->contrasena_us;
		}
		if(strpos($contrasena_actual,'$2y$10$')===0){
			if(password_verify($pass, $contrasena_actual)){
				$tipo=2;
				$sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
				echo 'descendido';
			}
			else{
				echo 'nodescendido';
			}			
		}
		else{
			if($pass==$contrasena_actual){
				$tipo=2;
				$sql="UPDATE usuario SET us_tipo=:tipo where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_descendido,':tipo'=>$tipo));
				echo 'descendido';				
			}
			else{
				echo 'nodescendido';
			}			
		}
	}

	function devolver_avatar($id_usuario){
		$sql="SELECT avatar FROM usuario where id_usuario=:id_usuario";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id_usuario'=>$id_usuario));
		$this->objetos=$query->fetchall();
		return $this->objetos;
	}
	function verificar($email,$dni){
		$sql="SELECT * FROM usuario where correo_us=:email and dni_us=:dni";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':email'=>$email,':dni'=>$dni));
		$this->objetos=$query->fetchall();
		if(!empty($this->objetos)){
			if($query->rowCount()==1){
				echo 'encontrado';
			}
			else{
				echo 'noencontrado';
			}
		}
		else{
			echo 'noencontrado';
		}
	}
	function remplazar($codigo,$email,$dni){
		$sql="UPDATE usuario SET contrasena_us=:codigo where correo_us=:email and dni_us=:dni";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':codigo'=>$codigo,':email'=>$email,':dni'=>$dni));
		// echo 'remplazado';
	}
}

 ?>