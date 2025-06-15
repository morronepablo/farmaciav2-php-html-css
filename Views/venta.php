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
        background: url(/farmaciav2/img/dimension.png);
    }

    .header {
        background: url(/farmaciav2/img/relieve.jpg);
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
                        <img src="/farmaciav2/img/logo.png" width="100" height="100" alt="logo">
                    </div>
                    <h1 class="titulo_venta">SOLICITUD DE VENTA</h1>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card p-0 bg-warning">
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-user-nurse"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Vendedor</span>
                                    <span class="info-box-number" id="vendedor">Andres</span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Cliente</span>
                                    <span class="info-box-number">
                                        <select name="cliente" id="cliente" class="form-control select2-warning" style="width:100%" data-dropdown-css-class="select2-warning"></select>
                                    </span>
                                </div>
                            </div>
                            <div class="info-box mb-3 bg-warning">
                                <span class="info-box-icon"><i class="fas fa-sticky-note"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Comprobante</span>
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
                                <h3 class="widget-user-username" id="nombre_cliente">Alexander Pierce</h3>
                                <h5 class="widget-user-desc" id="apellido_cliente">Founder &amp; CEO</h5>
                            </div>
                            <div class="widget-user-image">
                                <img id="avatar_cliente" class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header" id="dni_cliente">----</h5>
                                            <span class="description-text" id="sexo_cliente">----</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header" id="telefono_cliente">----</h5>
                                            <span class="description-text" id="correo_cliente">----</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="description-block">
                                            <h5 class="description-header" id="edad_cliente">----</h5>
                                            <span class="description-text">----</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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