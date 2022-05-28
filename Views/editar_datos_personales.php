<?php 
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
	include_once 'layouts/header.php';
    include_once 'layouts/nav.php';
 ?>

<!-- Modal -->

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

<!-------------------------------------------------------------------------->

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




<!-------------------------------------------------------------------------->

  <title>Adm | Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php 
  	include_once 'layouts/nav.php';
   ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__fadeInRight">Datos personales</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Datos personales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    	<div class="content">
    		<div class="container-fluid">
    			<div class="row">
    				<div class="col-md-3">
    					<div class="card card-success card-outline">
    						<div class="card-body box-profile">
    							<div class="text-center">
    								<img id='avatar2' src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
    							</div>
    							<div class="text-center mt-1">
    								<button type="button" data-toggle="modal" data-target="#cambiophoto" class="btn btn-primary btn-sm">Cambiar avatar</button>
    							</div>
    							<input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario'] ?>">
    							<h3 id="nombre_us" class="profile-username text-center text-success">Nombre</h3>
    							<p id="apellidos_us" class="text-muted text-center">Apellidos</p>
    							<ul class="list-group list-group-unbordered mb-3">
    								<li class="list-group-item">
    									<b style="color: #0B7300">Edad</b><a id="edad" class="float-right">12</a>
    								</li>
    								<li class="list-group-item">
    									<b style="color: #0B7300">DNI</b><a id="dni_us" class="float-right">12</a>
    								</li>
    								<li class="list-group-item">
    									<b style="color: #0B7300">Tipo Usuario</b>
    									<span id="us_tipo" class="float-right">Administrador</span>
    									<button data-toggle="modal" data-target="#cambiocontra" type="button" class="btn btn-block btn-outline-warning btn-sm">Cambiar Password</button>
    								</li>
    							</ul>
    						</div>
    					</div>
    					<div class="card card-success">
    						<div class="card-header">
    							<h3 class="card-title">Sobre mi</h3>
    						</div>
    						<div class="card-body">
    							<strong style="color: #0B7300">
    								<i class="fas fa-phone mr-1"></i>Teléfono
    							</strong>
    							<p id="telefono_us" class="text-muted">99999999</p>
    							<strong style="color: #0B7300">
    								<i class="fas fa-map-marker-alt mr-1"></i>Domicilio
    							</strong>
    							<p id="residencia_us" class="text-muted">1138669097</p>
    							<strong style="color: #0B7300">
    								<i class="fas fa-at mr-1"></i>Correo
    							</strong>
    							<p id="correo_us" class="text-muted">1138669097</p>
    							<strong style="color: #0B7300">
    								<i class="fas fa-smile-wink mr-1"></i>Sexo
    							</strong>
    							<p id="sexo_us" class="text-muted">1138669097</p>
    							<strong style="color: #0B7300">
    								<i class="fas fa-pencil-alt mr-1"></i>Información adicional
    							</strong>
    							<p id="adicional_us" class="text-muted">1138669097</p>
    							<button class="edit btn btn-block bg-gradient-danger">Editar</button>
    						</div>
    						<div class="card-footer">
    							<p class="text-muted">Click en boton si desea editar</p>
    						</div>
    					</div>
    				</div>
    				<div class="col-md-9">
    					<div class="card card-success">
    						<div class="card-header">
    							<h3 class="card-title">Editar datos personales</h3>
    						</div>
    						<div class="card-body">
    							<div class="alert alert-success text-center" id="editado" style='display:none;'>
    								<span><i class="fas fa-check m-1"></i>Editado</span>
    							</div>
    							<div class="alert alert-danger text-center" id="noeditado" style='display:none;'>
    								<span><i class="fas fa-times m-1"></i>Edición Deshabilitada</span>
    							</div>
    							<form id='form-usuario' class="form-horizontal">
    								<div class="form-group row">
    									<label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
    									<div class="col-sm-10">
    										<input type="number" id="telefono" class="form-control">
    									</div>
    								</div>
    								<div class="form-group row">
    									<label for="residencia" class="col-sm-2 col-form-label">Domicilio</label>
    									<div class="col-sm-10">
    										<input type="text" id="residencia" class="form-control">
    									</div>
    								</div>
    								<div class="form-group row">
    									<label for="correo" class="col-sm-2 col-form-label">Correo</label>
    									<div class="col-sm-10">
    										<input type="text" id="correo" class="form-control">
    									</div>
    								</div>
    								<div class="form-group row">
    									<label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
    									<div class="col-sm-10">
    										<input type="text" id="sexo" class="form-control">
    									</div>
    								</div>
    								<div class="form-group row">
    									<label for="adicional" class="col-sm-2 col-form-label">Información adicional</label>
    									<div class="col-sm-10">
    										<textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
    									</div>
    								</div>
    								<div class="form-group row">
    									<div class="offset-sm-2 col-sm-10 float-right">
    										<button class="btn btn-block btn-outline-success">Guardar</button>
    									</div>
    								</div>
    							</form>
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
  <!-- /.content-wrapper -->



<!------------------------------------------------------------------>

<?php 
	include_once 'layouts/footer.php';
}
else{
	header('location: ../index.php');
}

 ?>
 <script src="../js/Usuario.js"></script>