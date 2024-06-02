<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>

<!-- Modal Crear Pedido -->
<div class="modal fade" id="crear_pedido">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear pedido</h5>
            </div>
            <div class="modal-body">
                <form id="form-crear_pedido" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Proveedor:</label>
                                <select name="proveedor" id="proveedor" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success" required></select>
                            </div>
                            <div class="form-group">
                                <label for="">Descripción:</label>
                                <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingrese descripción" required>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="">Producto:</label>
                                <select name="producto" id="producto" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Cantidad:</label>
                                <input type="number" step="1" class="form-control" name="cantidad" id="cantidad" placeholder="Ingrese cantidad">
                            </div>
                            <div class="form-group">
                                <label for="">Precio:</label>
                                <input type="number" step="any" class="form-control" name="precio" id="precio" placeholder="Ingrese precio">
                            </div>
                            <button type="button" id="agregar_producto" class="btn btn-outline-success btn-circle btn-lg float-right"><i class="fas fa-plus"></i></button>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-hover mt-1">
                                <thead class="bg-success">
                                    <tr>
                                        <th width="80%">Producto</th>
                                        <th width="20%">Acción</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_pedido" cantidad="0">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-3">

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
<!-- Fin Modal Crear Pedido -->
<!-- Modal Editar Laboratorio -->
<div class="modal fade" id="editar_laboratorio">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar laboratorio</h5>
            </div>
            <div class="modal-body p-0">
                <form id="form-editar_laboratorio" enctype="multipart/form-data">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-success">
                            <h3 class="widget-user-username" id="nombre_card"></h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" id="avatar_card" alt="User Avatar" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <input type="hidden" id="id_laboratorio" name="id_laboratorio">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre_edit" id="nombre_edit" placeholder="Ingrese nombre">
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
<!-- Modal Editar Avatar -->
<div class="modal fade" id="editar_avatar">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar avatar</h5>
            </div>
            <div class="modal-body p-0">
                <form id="form-editar_avatar" enctype="multipart/form-data">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-success">
                            <h3 class="widget-user-username" id="nombre_avatar"></h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" id="avatar" alt="User Avatar" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <input type="hidden" id="id_laboratorio_avatar" name="id_laboratorio_avatar">
                                <div class="col-md-12">
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
<!-- Fin Modal Editar Avatar -->
<title>Gestión pedidos | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión pedidos <button class="btn bg-gradient-primary" data-toggle="modal" data-target="#crear_pedido">Crear pedido</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión pedidos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Pedido</h3>
            </div>
            <div class="card-body">
                <table id="pedidos" class="table table-hover">
                    <thead class="bg-primary">
                        <tr>
                            <th width="100%">Pedidos</th>
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
<script src="/farmaciav2/Views/pedidos.js"></script>