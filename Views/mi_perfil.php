<?php 
	session_start();
	include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Views/layouts/header.php';
?>

<!-- Modales -->

<div class="animate__animated animate__zoomInDown modal fade" id="cambiocontra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        	<img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
        	<b>
        		<?php 	
        			echo $_SESSION['apellidos_us']; echo ' '; echo $_SESSION['nombre_us'];
        		 ?>
        	</b>
        </div>
        <div class="alert alert-success text-center" id="update" style='display:none;'>
			<span><i class="fas fa-check m-1"></i>Se cambio password correctamente.</span>
		</div>
		<div class="alert alert-danger text-center" id="noupdate" style='display:none;'>
			<span><i class="fas fa-times m-1"></i>El password anterior no es correcto.</span>
		</div>
        <form id="form-pass">
        	<div class="input-group mb-3">
	        	<div class="input-group-prepend">
	        		<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
	        	</div>
	        	<input id="oldpass" type="password" class="form-control" placeholder="Ingrese password actual">	
        	</div>
        	<div class="input-group mb-3">
	        	<div class="input-group-prepend">
	        		<span class="input-group-text"><i class="fas fa-lock"></i></span>
	        	</div>
	        	<input id="newpass" type="text" class="form-control" placeholder="Ingrese password nueva">	
        	</div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="animate__animated animate__slideInLeft modal fade" id="cambiophoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
        	<img id="avatar1" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
        	<b>
        		<?php 	
        			echo $_SESSION['apellidos_us']; echo ' '; echo $_SESSION['nombre_us'];
        		 ?>
        	</b>
        </div>
        <div class="alert alert-success text-center" id="edit" style='display:none;'>
			<span><i class="fas fa-check m-1"></i>Se cambio el avatar correctamente.</span>
		</div>
		<div class="alert alert-danger text-center" id="noedit" style='display:none;'>
			<span><i class="fas fa-times m-1"></i>Formato no soportado.</span>
		</div>
        <form id="form-photo" enctype="multipart/form-data">
        	<div class="input-group mb-3 ml-5 mt-2">
	        	<input type="file" name="photo" class="input-group">
	        	<input type="hidden" name="funcion" value="cambiar_foto">
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-gradient-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar Datos Personales -->
<div class="modal fade" id="editar_datos_personales" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar datos personales</h5>
      </div>
      <div class="modal-body">
        <form id="form-editar_datos_personales" enctype="multipart/form-data">
			<div class="form-group">
				<label for="">Teléfono</label>
				<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ingrese teléfono">
			</div>
			<div class="form-group">
				<label for="">Residencia</label>
				<select name="residencia" id="residencia" class="form-control select2-success" data-dropdown-css-class="select2-success" style="width: 100%;"></select>
			</div>
			<div class="form-group">
				<label for="">Dirección</label>
				<input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese dirección">
			</div>
			<div class="form-group">
				<label for="">Correo</label>
				<input type="text" class="form-control" id="correo" name="correo" placeholder="Ingrese correo">
			</div>
			<div class="form-group">
				<label for="">Sexo</label>
				<input type="text" class="form-control" id="sexo" name="sexo" placeholder="Ingrese sexo">
			</div>
			<div class="form-group">
				<label for="">Información Adicional</label>
				<textarea type="text" style="height: 100px;" class="form-control" id="adicional" name="adicional" placeholder="Ingrese adicional"></textarea>
			</div>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
        <button type="submit" class="btn btn-outline-success btn-circle btn-lg"><i class="fas fa-check"></i></button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Editar Datos Personales -->

<!-------------------------------------------------------------------------->

  <title>My Perfil | Morrone</title>

  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__fadeInRight">Datos personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
              <li class="breadcrumb-item active">Datos personales</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section>
    	<div class="content">
    		<div class="container-fluid">
    			<div class="row">
    				<div class="col-md-3">
    					<div class="card card-success card-outline">
    						<div id="card_1" class="card-body box-profile">
    							
    						</div>
    					</div>
    					<div id="card_2" class="card card-success">
    						
    					</div>
    				</div>
    				<div class="col-md-9">
    					<div class="card card-success">
    						<div class="card-header">
    							<h3 class="card-title">Editar datos personales</h3>
    						</div>
    						<div class="card-body">
    							
    						</div>
    						<div class="card-footer">
    							<p class="text-muted">Cuidado con ingresar datos erroneos</p>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
  </div>


<!------------------------------------------------------------------>

<?php 
	include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Views/layouts/footer.php';
?>
 <script src="/farmaciav2/Views/mi_perfil.js"></script>