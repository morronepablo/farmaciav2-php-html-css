<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>

<!-- Modal Ver Detalle -->
<div class="modal fade" id="ver_detalle">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver compra</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Código: </strong><span id="codigo_detalle"></span><br>
                        <strong>Fecha: </strong><span id="fecha_detalle"></span><br>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead class="bg-success">
                                <tr>
                                    <th width="60%">Producto</th>
                                    <th width="10%">Cantidad</th>
                                    <th width="15%">Precio</th>
                                    <th width="15%">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="detalles">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Ver Detalle -->
<!-- Modal Editar Avatar -->
<div class="modal fade" id="editar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar compra</h5>
            </div>
            <div class="modal-body">
                <form id="form-editar" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="id_compra" name="id_compra">
                            <input type="hidden" id="pedido_id" name="pedido_id">
                            <div class="form-group">
                                <label for="">Código:</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" required>
                            </div>
                            <div class="form-group">
                                <label for="">Nota:</label>
                                <input type="text" class="form-control" name="nota" id="nota" required>
                            </div>
                            <div class="form-group">
                                <label for="">Comprobante:</label>
                                <select name="comprobante" id="comprobante" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success" required></select>
                            </div>
                            <div class="form-group">
                                <label for="">Proveedor:</label>
                                <select name="proveedor" id="proveedor" class="form-control select2-success" style="width:100%" data-dropdown-css-class="select2-success" required></select>
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
<title>Gestión lotes | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión lotes </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Gestión lotes</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Lote</h3>
            </div>
            <div class="card-body">
                <table id="lotes" class="table table-hover">
                    <thead class="bg-success">
                        <tr>
                            <th width="100%">Lotes <span class="text-light ml-5"> <i class="fas fa-square"></i> Normal</span> <span class="text-warning ml-2"> <i class="fas fa-square"></i> Por vencer</span> <span class="text-danger ml-2"> <i class="fas fa-square"></i> Vencido</span></th>
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
<script src="/farmaciav2/Views/lotes.js"></script>