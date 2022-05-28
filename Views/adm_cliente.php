<?php
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3 ){
	include_once 'layouts/header.php';
 ?>

  <title>Adm | Editar Datos</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php
    include_once 'layouts/nav.php';
   ?>
<div class="modal fade" id="editarcliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog">
   <div class="modal-content">
       <div class="card card-success">
           <div class="card-header">
               <h3 class="card-title">Editar cliente</h3>
               <button data-dismiss="modal" aria-label="close" class="close">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="card-body">
               <div class="alert alert-success text-center" id="edit-cli" style='display:none;'>
                   <span><i class="fas fa-check m-1"></i>Se edito correctamente.</span>
               </div>
               <div class="alert alert-danger text-center" id="noedit-cli" style='display:none;'>
                   <span><i class="fas fa-times m-1"></i>No se pudo editar.</span>
               </div>
               <form id="form-editar">
                   <div class="form-group">
                       <label for="telefono_edit">Telefono</label>
                       <input id="telefono_edit" type="number" class="form-control" placeholder="ingrese telefono" required>
                   </div>
                   <div class="form-group">
                       <label for="correo_edit">Correo</label>
                       <input id="correo_edit" type="email" class="form-control" placeholder="ingrese correo">
                   </div>
                   <div class="form-group">
                       <label for="adicional_edit">Adicional</label>
                       <input id="adicional_edit" type="text" class="form-control" placeholder="ingrese adicional" required>
                   </div>
                   <input type="hidden" id="id_cliente">
           </div>
           <div class="card-footer">
               <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
               <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
               </form>
           </div>
       </div>
   </div>
 </div>
</div>

<div class="modal fade" id="crearcliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Crear cliente</h3>
                <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="alert alert-success text-center" id="add-cli" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se agrego correctamente.</span>
                </div>
                <div class="alert alert-danger text-center" id="noadd-cli" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>El cliente ya existe.</span>
                </div>
                <form id="form-crear">
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input id="nombre" type="text" class="form-control" placeholder="ingrese nombres" required>
                    </div>
										<div class="form-group">
                        <label for="apellido">Apellidos</label>
                        <input id="apellido" type="text" class="form-control" placeholder="ingrese apellidos" required>
                    </div>
										<div class="form-group">
                        <label for="cuit">D.N.I.</label>
                        <input id="dni" type="number" class="form-control" placeholder="ingrese D.N.I." required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input id="telefono" type="number" class="form-control" placeholder="ingrese telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input id="correo" type="email" class="form-control" placeholder="ingrese correo">
                    </div>
										<div class="form-group">
                        <label for="sexo">Sexo</label>
                        <input id="sexo" type="text" class="form-control" placeholder="ingrese sexo" required>
                    </div>
                    <div class="form-group">
                        <label for="adicional">Adicional</label>
                        <input id="adicional" type="text" class="form-control" placeholder="ingrese adicional" required>
                    </div>
                    <input type="hidden" id="id_edit_prov">
            </div>
            <div class="card-footer">
                <button type="submit" class="btn bg-gradient-primary float-right m-1">Guardar</button>
                <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="animate__animated animate__fadeInRight">Gestion cliente <button type="button" data-toggle="modal" data-target="#crearcliente" class="btn bg-gradient-primary ml-2">Crear cliente</button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestion cliente</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
    	<div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar cliente </h3>
                    <div class="input-group">
                        <input type="text" id="buscar_cliente" class="form-control float-left" placeholder="Ingrese nombre de cliente">
                        <div class="input-group-append">
                            <button class="btn btn-default"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="clientes" class="row d-flex aling-items-stretch">

                    </div>
                </div>
                <div class="card-footer">

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
 <script src="../js/Cliente.js"></script>
