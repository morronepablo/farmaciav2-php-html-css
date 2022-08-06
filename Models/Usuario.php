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
			  u.contrasena as contrasena
			  FROM usuario u
			  JOIN tipo t ON u.id_tipo = t.id
			  WHERE u.dni=:dni";
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
			  l.id as id_residencia
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
	/******************************/
	
	function obtener_dato_logueo($dni){
		$sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us and dni_us=:dni";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':dni'=>$dni));
		$this->objetos= $query->fetchall();
		return $this->objetos;
	}
	
	function cambiar_contra($id_usuario,$oldpass,$newpass){
		$sql="SELECT * FROM usuario where id_usuario=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id_usuario));
		$this->objetos = $query->fetchall();
		foreach ($this->objetos as $objeto) {
			$contrasena_actual = $objeto->contrasena_us;
		}
		if(strpos($contrasena_actual,'$2y$10$')===0){
			if(password_verify($oldpass, $contrasena_actual)){
				$pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
				$sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
				echo 'update';
			}
			else{
				echo 'noupdate';
			}
		}
		else{
			if($oldpass==$contrasena_actual){
				$pass = password_hash($newpass,PASSWORD_BCRYPT,['cost'=>10]);
				$sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_usuario,':newpass'=>$pass));
				echo 'update';
			}
			else{
				echo 'noupdate';
			}
		}
		
	}
	// function cambiar_contra($id_usuario,$oldpass,$newpass){
	// 	$sql="SELECT * FROM usuario where id_usuario=:id and contrasena_us=:oldpass";
	// 	$query = $this->acceso->prepare($sql);
	// 	$query->execute(array(':id'=>$id_usuario,':oldpass'=>$oldpass));
	// 	$this->objetos = $query->fetchall();
	// 	if(!empty($this->objetos)){
	// 		$sql="UPDATE usuario SET contrasena_us=:newpass where id_usuario=:id";
	// 		$query = $this->acceso->prepare($sql);
	// 		$query->execute(array(':id'=>$id_usuario,':newpass'=>$newpass));
	// 		echo 'update';
	// 	}
	// 	else{
	// 		echo 'noupdate';
	// 	}
	// }
	function cambiar_photo($id_usuario,$nombre){
		$sql="SELECT avatar FROM usuario where id_usuario=:id";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id'=>$id_usuario));
		$this->objetos = $query->fetchall();

			$sql="UPDATE usuario SET avatar=:nombre where id_usuario=:id";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':id'=>$id_usuario,':nombre'=>$nombre));
		return $this->objetos;	
	}
	function buscar(){
		if(!empty($_POST['consulta'])){
			$consulta=$_POST['consulta'];
			$sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us LIKE :consulta";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':consulta'=>"%$consulta%"));
			$this->objetos=$query->fetchall();
			return $this->objetos;
		}
		else{

			$sql="SELECT * FROM usuario join tipo_us on us_tipo=id_tipo_us where nombre_us NOT LIKE '' ORDER BY id_usuario LIMIT 25";
			$query = $this->acceso->prepare($sql);
			$query->execute();
			$this->objetos=$query->fetchall();
			return $this->objetos;
		}
	}
	function crear($nombre,$apellido,$edad,$dni,$pass,$tipo,$avatar){
		$sql="SELECT id_usuario FROM usuario where dni_us=:dni";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':dni'=>$dni));
		$this->objetos=$query->fetchall();
		if(!empty($this->objetos)){
			echo 'noadd';
		}
		else{
			$sql="INSERT INTO usuario(nombre_us,apellidos_us,edad,dni_us,contrasena_us,us_tipo,avatar) VALUES (:nombre,:apellido,:edad,:dni,:pass,:tipo,:avatar);";
			$query = $this->acceso->prepare($sql);
			$query->execute(array(':nombre'=>$nombre,':apellido'=>$apellido,':edad'=>$edad,':dni'=>$dni,':pass'=>$pass,':tipo'=>$tipo,':avatar'=>$avatar));
			echo 'add';
		}
	}
	
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
	function borrar($pass,$id_borrado,$id_usuario){
		$sql="SELECT * FROM usuario where id_usuario=:id_usuario";
		$query = $this->acceso->prepare($sql);
		$query->execute(array(':id_usuario'=>$id_usuario));
		$this->objetos=$query->fetchall();
		foreach ($this->objetos as $objeto) {
			$contrasena_actual = $objeto->contrasena_us;
		}
		if(strpos($contrasena_actual,'$2y$10$')===0){
			if(password_verify($pass, $contrasena_actual)){
				$sql="DELETE FROM usuario where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_borrado));
				echo 'borrado';	
			}
			else{
				echo 'noborrado';
			}			
		}
		else{
			if($pass==$contrasena_actual){
				$sql="DELETE FROM usuario where id_usuario=:id";
				$query = $this->acceso->prepare($sql);
				$query->execute(array(':id'=>$id_borrado));
				echo 'borrado';				
			}
			else{
				echo 'noborrado';
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