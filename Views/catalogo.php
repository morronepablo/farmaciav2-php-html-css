<?php
    session_start();
    include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Views/layouts/header.php';
?>
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
    include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/catalogo.js"></script>