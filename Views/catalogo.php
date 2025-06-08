<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>
<style>
    .table_scroll {
        overflow: scroll;
        height: 400px;
        overflow-x: hidden;
    }

    #carrito_compras td {
        padding: 0px !important;
        margin: 0px !important;
    }
</style>
<!-- Modal Carrito -->
<div class="modal fade" id="abrir_carrito" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Carrito de compras</h5>
            </div>
            <div class="modal-body p-0 table_scroll">
                <table id="carrito_compras" class="table table-borderless table-secondary">
                    <thead class="bg-success">
                        <tr>
                            <th>Productos</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-circle btn-lg" data-dismiss="modal"><i class="fas fa-sign-out-alt"></i></button>
                <button type="button" class="vaciar_carrito btn btn-outline-danger btn-circle btn-lg"><i class="far fa-trash-alt"></i></button>
                <button type="button" class="btn btn-outline-success btn-circle btn-lg generar_venta"><i class="fas fa-check"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal Carrito -->
<title>Catalogo | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Catalogo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/farmaciav2/Views/catalogo.php">Inicio</a></li>
                        <li class="breadcrumb-item active">Catalogo</li>
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
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                Busque los productos para agregarlos al carrito
            </div>
        </div>
    </section>
</div>
<?php
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/catalogo.js"></script>