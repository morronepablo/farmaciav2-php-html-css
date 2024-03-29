<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>

<!-- Modales -->

<!-- Modal Cambiar Contraseña -->
<div class="modal fade" id="editar_password">
	<div class="modal-dialog">
		<div class="modal-content card card-success">
			<div class="modal-header card-header">
				<h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
			</div>
			<div class="modal-body p-0">
				<div class="card card-widget widget-user">
					<div class="widget-user-header bg-success">
						<h3 id="nombre_password" class="widget-user-username"></h3>
						<h5 id="apellido_password" class="widget-user-desc"></h5>
					</div>
					<div class="widget-user-image">
						<img id="avatar_password" class="img-circle elevation-2" src="" alt="User Avatar">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<form id="form-editar_password" enctype="multipart/form-data">
									<div class="input-group mt-2 mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
										</div>
										<input type="password" id="oldpass" name="oldpass" class="form-control" placeholder="Ingrese contraseña actual">
									</div>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-lock"></i></span>
										</div>
										<input type="password" id="newpass" name="newpass" class="form-control" placeholder="Ingrese la nueva contraseña">
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
				<button type="submit" class="btn btn-outline-success btn-circle btn-lg"><i class="fas fa-check"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Fin Modal Cambiar Contraseña -->

<!-- Modal Cambiar Avatar -->
<div class="modal fade" id="editar_avatar">
	<div class="modal-dialog">
		<div class="modal-content card card-success">
			<div class="modal-header card-header">
				<h5 class="modal-title" id="exampleModalLabel">Cambiar avatar</h5>
			</div>
			<div class="modal-body p-0">
				<div class="card card-widget widget-user">
					<div class="widget-user-header bg-success">
						<h3 id="nombre_avatar" class="widget-user-username"></h3>
						<h5 id="apellido_avatar" class="widget-user-desc"></h5>
					</div>
					<div class="widget-user-image">
						<img id="avatar" class="img-circle elevation-2" src="" alt="User Avatar">
					</div>
					<div class="card-footer">
						<div class="row">
							<div class="col-md-12">
								<form id="form-editar_avatar" enctype="multipart/form-data">
									<div class="form-group">
										<label for="exampleInputFile">Avatar: </label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="avatar_mod" name="avatar_mod">
												<label class="custom-file-label" for="exampleInputFile">Seleccione una imagen</label>
											</div>
										</div>
									</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
				<button type="submit" class="btn btn-outline-success btn-circle btn-lg"><i class="fas fa-check"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Fin Modal Cambiar Avatar -->

<!-- Modal Editar Datos Personales -->
<div class="modal fade" id="editar_datos_personales">
	<div class="modal-dialog">
		<div class="modal-content card card-success">
			<div class="modal-header card-header">
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
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
				<button type="submit" class="btn btn-outline-success btn-circle btn-lg"><i class="fas fa-check"></i></button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Fin Modal Editar Datos Personales -->

<!-------------------------------------------------------------------------->

<title>Mi Perfil | Morrone</title>

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
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/mi_perfil.js"></script>