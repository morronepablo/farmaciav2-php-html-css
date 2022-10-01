<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>
<!-- Modal Cambiar Contraseña -->
<div class="modal fade" id="crear_usuario">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear usuario</h5>
            </div>
            <div class="modal-body">
                <form id="form-crear_usuario" enctype="multipart/form-data">
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
                                <label for="">Contraseña:</label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="Ingrese su contraseña">
                            </div>
                            <div class="form-group">
                                <label for="">Teléfono:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese su teléfono">
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label for="">Residencia:</label>
                                <select name="residencia" id="residencia" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Dirección:</label>
                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese su dirección">
                            </div>
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
                                <textarea type="text" class="form-control" style="height:124px" name="adicional" id="adicional" placeholder="Ingrese su información adicional"></textarea>
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
<title>Gestión usuario | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión usuario <button id="btn-crear_usuario" class="btn bg-gradient-primary" data-toggle="modal" data-target="#crear_usuario">Crear usuario</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión usuario</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Usuarios</h3>
            </div>
            <div class="card-body">
                <table id="usuarios" class="table table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th width="100%">Usuarios</th>
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
<script src="/farmaciav2/Views/usuarios.js"></script>