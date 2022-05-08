<?php 
session_start();
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
	include_once 'layouts/header.php';
  include_once 'layouts/nav.php';
 ?>


<div class="animate__animated animate__zoomInDown modal fade" id="cambiologo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar logo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img id="logoactual" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
        </div>
        <div class="text-center">
          <b id="nombre_logo">
          </b>
        </div>
        <div class="alert alert-success text-center" id="edit" style='display:none;'>
      <span><i class="fas fa-check m-1"></i>Se cambio el logo correctamente.</span>
    </div>
    <div class="alert alert-danger text-center" id="noedit" style='display:none;'>
      <span><i class="fas fa-times m-1"></i>Formato no soportado.</span>
    </div>
        <form id="form-logo" enctype="multipart/form-data">
          <div class="input-group mb-3 ml-5 mt-2">
            <input type="file" name="photo" class="input-group">
            <input type="hidden" name="funcion" id="funcion">
            <input type="hidden" name="id_logo_lab" id="id_logo_lab">
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


<div class="animate__animated animate__zoomInDown modal fade" id="crearlaboratorio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Crear laboratorio</h3>
                <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="alert alert-success text-center" id="add-laboratorio" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se agrego correctamente.</span>
                </div>
                <div class="alert alert-danger text-center" id="noadd-laboratorio" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>El laboratorio ya existe.</span>
                </div>
                <div class="alert alert-success text-center" id="edit-lab" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se editó correctamente.</span>
                </div>
                <form id="form-crear-laboratorio">
                    <div class="form-group">
                        <label for="nombre-laboratorio">Nombre</label>
                        <input id="nombre-laboratorio" type="text" class="form-control" placeholder="ingrese nombre" required>
                        <input type="hidden" id="id_editar_lab">
                    </div>               
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
<!---------------------------------->
<div class="animate__animated animate__zoomInDown modal fade" id="creartipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Crear tipo</h3>
                <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="alert alert-success text-center" id="add-tipo" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se agrego correctamente.</span>
                </div>
                <div class="alert alert-danger text-center" id="noadd-tipo" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>El tipo ya existe.</span>
                </div>
                <div class="alert alert-success text-center" id="edit-tip" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se editó correctamente.</span>
                </div>
                <form id="form-crear-tipo">
                    <div class="form-group">
                        <label for="nombre-tipo">Nombre</label>
                        <input id="nombre-tipo" type="text" class="form-control" placeholder="ingrese nombre" required>
                        <input type="hidden" id="id_editar_tip">
                    </div>               
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
<!---------------------------------->
<div class="animate__animated animate__zoomInDown modal fade" id="crearpresentacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Crear presentación</h3>
                <button data-dismiss="modal" aria-label="close" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <div class="alert alert-success text-center" id="add-pre" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se agrego correctamente.</span>
                </div>
                <div class="alert alert-danger text-center" id="noadd-pre" style='display:none;'>
                    <span><i class="fas fa-times m-1"></i>La presentación ya existe.</span>
                </div>
                <div class="alert alert-success text-center" id="edit-pre" style='display:none;'>
                    <span><i class="fas fa-check m-1"></i>Se editó correctamente.</span>
                </div>
                <form id="form-crear-presentacion">
                    <div class="form-group">
                        <label for="nombre-presentacion">Nombre</label>
                        <input id="nombre-presentacion" type="text" class="form-control" placeholder="ingrese nombre" required>
                        <input type="hidden" id="id_editar_pre">
                    </div>               
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

  <title>Adm | Atributo</title>
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
            <h1 class="animate__animated animate__fadeInRight">Gestion Atributos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion atributo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                  <ul class="nav nav-pills">
                    <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratorio</a></li>
                    <li class="nav-item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                    <li class="nav-item"><a href="#presentacion" class="nav-link" data-toggle="tab">Presentación</a></li>
                  </ul>
              </div>
              <div class="card-body p-0">
                  <div class="tab-content">
                    <div class="tab-pane active" id='laboratorio'>
                      <div class="card card-success">
                        <div class="card-header">
                          <div class="card-title">Busca laboratorio <button type="button" data-toggle="modal" data-target="#crearlaboratorio" class="btn bg-gradient-primary btn-sm m-2">Crear laboratorio</button></div>
                          <div class="input-group">
                            <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                            <div class="input-group-append">
                              <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-0 table-responsive">
                          <table class="table table-hover text-nowrap">
                            <thead class="table-success">
                              <tr>
                                <th>Laboratorio</th>
                                <th>Logo</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                            <tbody class="table-active" id="laboratorios">
                              
                            </tbody>
                          </table>
                        </div>
                        <div class="card-footer">
                          
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id='tipo'>
                      <div class="card card-success">
                        <div class="card-header">
                          <div class="card-title">Busca Tipo <button type="button" data-toggle="modal" data-target="#creartipo" class="btn bg-gradient-primary btn-sm m-2">Crear tipo</button></div>
                          <div class="input-group">
                            <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                            <div class="input-group-append">
                              <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-0 table-responsive">
                          <table class="table table-hover text-nowrap">
                            <thead class="table-success">
                              <tr>
                                <th>Tipos</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                            <tbody class="table-active" id="tipos">
                              
                            </tbody>
                          </table>
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                    <div class="tab-pane" id='presentacion'>
                      <div class="card card-success">
                        <div class="card-header">
                          <div class="card-title">Busca presentación <button type="button" data-toggle="modal" data-target="#crearpresentacion" class="btn bg-gradient-primary btn-sm m-2">Crear presentación</button></div>
                          <div class="input-group">
                            <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Ingrese nombre">
                            <div class="input-group-append">
                              <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="card-body p-0 table-responsive">
                          <table class="table table-hover text-nowrap">
                            <thead class="table-success">
                              <tr>
                                <th>Presentacion</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                            <tbody class="table-active" id="presentaciones">
                              
                            </tbody>
                          </table>
                        </div>
                        <div class="card-footer"></div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="card-footer">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
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
 <script src="../js/Laboratorio.js"></script>
 <script src="../js/Tipo.js"></script>
 <script src="../js/Presentacion.js"></script>