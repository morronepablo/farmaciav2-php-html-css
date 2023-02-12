<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>  
<!-- Modal Crear Usuario -->
<div class="modal fade" id="crear_cliente">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear cliente</h5>
            </div>
            <div class="modal-body">
                <form id="form-crear_cliente" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Nombres:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Apellidos:</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese su apellido">
                            </div>
                            <div class="form-group">
                                <label for="">Fecha nacimiento:</label>
                                <input type="date" class="form-control" name="nacimiento" id="nacimiento" placeholder="Ingrese su nacimiento">
                            </div>
                            <div class="form-group">
                                <label for="">DNI:</label>
                                <input type="text" class="form-control" name="dni" id="dni" placeholder="Ingrese su DNI">
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese su teléfono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Correo:</label>
                                <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo">
                            </div>
                            <div class="form-group">
                                <label for="">Sexo:</label>
                                <input type="text" class="form-control" name="sexo" id="sexo" placeholder="Ingrese su sexo">
                            </div>
                            <div class="form-group">
                                <label for="">Información adicional:</label>
                                <textarea type="text" class="form-control" style="height:210px" name="adicional" id="adicional" placeholder="Ingrese su información adicional"></textarea>
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
<!-- Fin Modal Crear Usuario -->
<!-- Modal Editar Cliente -->
<div class="modal fade" id="editar_cliente">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
            </div>
            <div class="modal-body p-0">
                <form id="form-editar_cliente" enctype="multipart/form-data">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-success">
                            <h3 class="widget-user-username" id="nombre_edit"></h3>
                            <h5 id="apellido_edit" class="widget-user-desc"></h5>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" id="avatar_edit" alt="User Avatar" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <input type="hidden" id="id_usuario" name="id_usuario">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Teléfono:</label>
                                        <input type="text" class="form-control" name="telefono_edit" id="telefono_edit" placeholder="Ingrese teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Correo:</label>
                                        <input type="text" class="form-control" name="correo_edit" id="correo_edit" placeholder="Ingrese correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Información Adicional:</label>
                                        <textarea type="text" class="form-control" style="height: 100px" name="adicional_edit" id="adicional_edit" placeholder="Ingrese información adicional"></textarea>
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
<!-- Fin Modal Editar Laboratorio -->
<title>Gestión cliente | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión cliente <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#crear_cliente">Crear cliente</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión cliente</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Clientes</h3>
            </div>
            <div class="card-body">
                <table id="clientes" class="table table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th width="100%">Clientes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/clientes.js"></script>