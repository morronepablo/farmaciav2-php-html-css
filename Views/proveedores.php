<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>

<!-- Modal Crear Proveedor -->
<div class="modal fade" id="crear_proveedor">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear proveedor</h5>
            </div>
            <div class="modal-body">
                <form id="form-crear_proveedor" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
                    </div>
                    <div class="form-group">
                        <label for="">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese su teléfono">
                    </div>
                    <div class="form-group">
                        <label for="">Correo:</label>
                        <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo">
                    </div>
                    <div class="form-group">
                        <label for="">Dirección:</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ingrese su dirección">
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
<!-- Fin Modal Crear Proveedor -->
<!-- Modal Editar Proveedor -->
<div class="modal fade" id="editar_proveedor">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar proveedor</h5>
            </div>
            <div class="modal-body p-0">
                <form id="form-editar_proveedor" enctype="multipart/form-data">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-success">
                            <h3 class="widget-user-username" id="nombre_card"></h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" id="avatar_card" alt="User Avatar" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <input type="hidden" id="id_proveedor" name="id_proveedor">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" placeholder="Ingrese nombre">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telefono:</label>
                                        <input type="text" class="form-control" name="telefono_edit" id="telefono_edit" placeholder="Ingrese teléfono">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Correo:</label>
                                        <input type="text" class="form-control" name="correo_edit" id="correo_edit" placeholder="Ingrese correo">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Dirección:</label>
                                        <input type="text" class="form-control" name="direccion_edit" id="direccion_edit" placeholder="Ingrese dirección">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Avatar:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="avatar_edit" id="avatar_edit">
                                                <label for="" class="custom-file-label">Seleccione una imagen</label>
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
<!-- Fin Modal Editar Proveedor -->

<title>Gestión proveedor | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión proveedor <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#crear_proveedor">Crear proveedor</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión proveedor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Proveedores</h3>
            </div>
            <div class="card-body">
                <table id="proveedores" class="table table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th width="100%">Proveedores</th>
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
<script src="/farmaciav2/Views/proveedores.js"></script>