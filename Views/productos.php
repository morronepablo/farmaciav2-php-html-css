<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>
<title>Productos | Morrone</title>
<!-- Modal Crear Producto -->
<div class="modal fade" id="crear_producto">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear producto</h5>
            </div>
            <div class="modal-body">
                <form id="form-crear_producto" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Código:</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingrese código">
                            </div>
                            <div class="form-group">
                                <label for="">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre">
                            </div>
                            <div class="form-group">
                                <label for="">Concentración:</label>
                                <input type="text" class="form-control" name="concentracion" id="concentracion" placeholder="Ingrese concentración">
                            </div>
                            <div class="form-group">
                                <label for="">Subtipo:</label>
                                <select name="subtipo" id="subtipo" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success"></select>
                            </div>
                            <div class="form-group">
                                <label for="">Presentación:</label>
                                <select name="presentacion" id="presentacion" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success"></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Fracciones:</label>
                                <input type="text" class="form-control" name="fraccion" id="fraccion" placeholder="Ingrese fracción">
                            </div>
                            <div class="form-group">
                                <label for="">Reg. Sanitario:</label>
                                <input type="text" class="form-control" name="correo" id="correo" placeholder="Ingrese su correo">
                            </div>
                            <div class="form-group">
                                <label for="">Precio:</label>
                                <input type="text" class="form-control" name="precio" id="precio" placeholder="Ingrese precio">
                            </div>
                            <div class="form-group">
                                <label for="">Laboratorio:</label>
                                <select name="laboratorio" id="laboratorio" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success"></select>
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
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos <button data-toggle='modal' data-target='#crear_producto' class="btn btn-primary">Crear producto</button></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Productos</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Productos</h3>
            </div>
            <div class="card-body">
                <table id="productos" class="table table-hover">
                    <thead class="table-success">
                        <tr width="100%">
                            <th>Productos</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/productos.js"></script>