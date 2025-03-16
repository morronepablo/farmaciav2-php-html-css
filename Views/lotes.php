<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"] . '/farmaciav2/Views/layouts/header.php';
?>

<!-- Modal Editar Avatar -->
<div class="modal fade" id="editar">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card card-success">
            <div class="modal-header card-header">
                <h5 class="modal-title" id="titulo_editar"></h5>
            </div>
            <div class="modal-body">
                <form id="form-editar" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" id="id_lote" name="id_lote">
                            <div class="form-group">
                                <label for="">Cantidad:</label>
                                <input type="number" class="form-control" name="cantidad_editar" id="cantidad_editar" required>
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
<style>
    .bg-critical {
        background-color: #ff8c00 !important;
        /* Naranja oscuro */
        color: #fff;
        /* Opcional, para que el texto sea legible */
    }

    .text-critical {
        color: #ff8c00 !important;
        /* Opcional, para que el texto sea legible */
    }
</style>
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
                            <th width="100%">Lotes <span class="text-light ml-5"> <i class="fas fa-square"></i> Normal</span> <span class="text-warning ml-2"> <i class="fas fa-square"></i> Por vencer</span> <span class="text-critical ml-2"> <i class="fas fa-square"></i> Por vencer desde 15 días a vencido </span> <span class="text-danger ml-2"> <i class="fas fa-square"></i> Vencido</span></th>
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