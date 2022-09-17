<?php
    session_start();
    include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Views/layouts/header.php';
?>
<title>Gestión usuario | Morrone</title>
<div class="content-wrapper" style="min-height: 678.917px;">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gestión usuario <button class="btn bg-gradient-primary">Crear usuario</button></h1>
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
    include_once $_SERVER["DOCUMENT_ROOT"].'/farmaciav2/Views/layouts/footer.php';
?>
<script src="/farmaciav2/Views/usuarios.js"></script>