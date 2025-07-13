<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>

<!-- Modal Crear Tipos -->
<div class="modal fade" id="crear_tipo">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear tipo</h5>
            </div>
            <div class="modal-body">
                <form id="form-crear_tipo" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
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
<!-- Fin Modal Crear Tipos -->
<!-- Modal Editar Tipos -->
<div class="modal fade" id="editar_tipo">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar tipo</h5>
            </div>
            <div class="modal-body p-0">
                <form id="form-editar_tipo" enctype="multipart/form-data">
                    <div class="card card-widget widget-user">
                        <div class="widget-user-header bg-success">
                            <h3 class="widget-user-username" id="nombre_card"></h3>
                        </div>
                        <div class="widget-user-image">
                            <img class="img-circle elevation-2" id="avatar_card" alt="User Avatar" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <input type="hidden" id="id_tipo" name="id_tipo">
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
<!-- Fin Modal Editar Tipos -->

<style>
    .logo_venta {
        text-align: center;
        margin: 10px 0 10px 0;
    }

    .titulo_venta {
        border-top: 1px solid #1c741c;
        border-bottom: 1px solid #1c741c;
        color: #1c741c;
        font-size: 30px;
        font-weight: normal;
        text-align: center;
        background: url(/farmaciav2/Util/img/dimension.png);
    }

    .header {
        background: url(/farmaciav2/Util/img/relieve.jpg);
    }
</style>

<title>Ventas | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ventas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Ventas</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <div class="card-body p-0">
                <div class="header">
                    <div class="logo_venta">
                        <img src="/farmaciav2/Util/img/logo.png" width="100" height="100" alt="logo">
                    </div>
                    <h1 class="titulo_venta">SOLICITUD DE VENTA</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-0 bg-warning">
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-user-nurse"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Vendedor:</span>
                                    <span class="info-box-number" id="vendedor"></span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Cliente:</span>
                                    <span class="info-box-number">
                                        <select name="cliente" id="cliente" class="form-control select2-warning" style="width:100%" data-dropdown-css-class="select2-warning"></select>
                                    </span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-sticky-note"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Comprobante:</span>
                                    <span class="info-box-number">
                                        <select name="comprobante" id="comprobante" class="form-control select2-warning" style="width:100%" data-dropdown-css-class="select2-warning"></select>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-widget widget-user">
                            <div class="widget-user-header bg-warning">
                                <h3 class="widget-user-username" id="nombre_cliente">---</h3>
                                <h5 class="widget-user-desc" id="apellido_cliente">---</h5>
                            </div>
                            <div class="widget-user-image">
                                <img id="avatar_cliente" class="img-circle elevation-2" src="/farmaciav2/Util/img/avatar.png" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header" id="dni_cliente">----</h5>
                                            <h5 class="description-header" id="sexo_cliente">----</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header" id="telefono_cliente">----</h5>
                                            <h5 class="description-header" id="correo_cliente">----</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header" id="edad_cliente">----</h5>
                                            <h5 class="description-header">----</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="productos" class="table table-hover">
                            <thead class="bg-success">
                                <tr>
                                    <th width="50%">Producto</th>
                                    <th width="10%">Precio</th>
                                    <th width="10%">Cantidad</th>
                                    <th width="10%">Subtotal</th>
                                    <th width="20%" class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="productos_carrito">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-0">
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-shopping-basket"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total num. items:</span>
                                    <span class="info-box-number" id="contador_venta">---</span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-money-bill-wave-alt"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Op. Grabada:</span>
                                    <span class="info-box-number" id="grabada">---</span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fab fa-creative-commons-nc"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Descuento:</span>
                                    <span class="info-box-number">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="descuento" name="descuento" value="0">
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-handshake"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">IVA(21%):</span>
                                    <span class="info-box-number" id="iva">---</span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-success">
                                <span class="info-box-icon"><i class="fas fa-cart-arrow-down"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Importe total:</span>
                                    <span class="info-box-number" id="total">---</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card p-0">
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tags"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Recibe:</span>
                                    <span class="info-box-number">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="recibe" name="recibe" value="0">
                                        </div>
                                    </span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-info">
                                <span class="info-box-icon"><i class="fas fa-tags"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Vuelto:</span>
                                    <span class="info-box-number" id="vuelto">---</span>
                                </div>
                            </div>
                        </div>
                        <div class="callout callout-danger">
                            <h5>Importante</h5>

                            <p>* Si el cliente no existe, puede crearlo en el módulo Gestión cliente, o usar el cliente standard, el cliente standard no tiene derecho a realizar ninguna devolución debido a que no tiene documento físico que demuestre que sea el que compro<br>
                                * Op grabada es el total sin IVA<br>
                                * Dejar el descuento en 0 si es que no quiere aplicar ninguno<br>
                                * IVA es el porcentaje del total a pagar<br>
                                * Importe total es el precio a pagar final<br>
                                * En el apartado recibe se coloca el monto que el usuario le da y obtiene el vuelto que se debe dar al cliente, ahora si el cliente le da el monto exacto, este apartado ya no es de utilidad.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/venta.js"></script>