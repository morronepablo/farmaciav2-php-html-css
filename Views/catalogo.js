$(document).ready(function() {
    Loader();
    //setTimeout(verificar_sesion, 2000);
    $('#productos').DataTable({});
    verificar_sesion();
    function llenar_menu_superior(usuario) {
        let template= `
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <img src="/farmaciav2/Util/img/user/${usuario.avatar}" class="img-circle elevation-2" width="30" height="30">
                    <span>${usuario.nombre + ' ' + usuario.apellido}</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/farmaciav2/Controllers/Logout.php"><i class="fas fa-user-times mr-2"></i>Cerrar sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
        `;
        $('#menu_superior').html(template);
    }
    function llenar_menu_lateral(usuario) {
        let template = `
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/farmaciav2/Util/img/user/${usuario.avatar}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">${usuario.nombre + ' ' + usuario.apellido}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Usuario</li>
                <li class="nav-item">
                    <a href="editar_datos_personales.php" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Datos personales
                        </p>
                    </a>
                </li>
                <li id="gestion_usuario" class="nav-item">
                    <a href="adm_usuario.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Gestión usuarios
                        </p>
                    </a>
                </li>
                <li id="gestion_cliente" class="nav-item">
                    <a href="adm_cliente.php" class="nav-link">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Gestión cliente
                        </p>
                    </a>
                </li>
                <li id="gestion_ventas" class="nav-header">Ventas</li>
                <li id="gestion_listar_ventas" class="nav-item">
                    <a href="adm_venta.php" class="nav-link">
                        <i class="nav-icon fas fa-notes-medical"></i>
                        <p>
                            Listar Ventas
                        </p>
                    </a>
                </li>
                <li id="gestion_almacen" class="nav-header">Almacén</li>
                <li id="gestion_producto" class="nav-item">
                    <a href="adm_producto.php" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>
                            Gestión producto
                        </p>
                    </a>
                </li>
                <li id="gestion_atributo" class="nav-item">
                    <a href="adm_atributo.php" class="nav-link">
                        <i class="nav-icon fas fa-vials"></i>
                        <p>
                            Gestión atributo
                        </p>
                    </a>
                </li>
                <li id="gestion_lote" class="nav-item">
                    <a href="adm_lote.php" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Gestión lote
                        </p>
                    </a>
                </li>
                <li id="gestion_compras" class="nav-header">Compras</li>
                <li id="gestion_proveedor" class="nav-item">
                    <a href="adm_proveedor.php" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Gestión proveedor
                        </p>
                    </a>
                </li>
                <li id="gestion_compra" class="nav-item">
                    <a href="adm_compras.php" class="nav-link">
                        <i class="nav-icon fas fa-people-carry"></i>
                        <p>
                            Gestión compras
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        `;
        $('#menu_lateral').html(template);
    }
    async function verificar_sesion() {
        let funcion = "verificar_sesion";
        let data = await fetch('/farmaciav2/Controllers/UsuarioController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion
        })
        if(data.ok) {
            let response = await data.text();
            try {
                let respuesta = JSON.parse(response);
                if(respuesta.length != 0) {
                    llenar_menu_superior(respuesta);
                    llenar_menu_lateral(respuesta);
                    CloseLoader();
                } else {
                    location.href = "/farmaciav2/";
                }
            } catch (error) {
                console.error(error);
                console.log(response);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo confilcto en el sistema, póngase en contacto con el administrador'
                })
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: data.statusText,
                text: 'Hubo confilcto de código: ' + data.status
            })
        }
    }
    function Loader(mensaje) {
        if(mensaje == '' || mensaje == null) {
            mensaje = "Cargando datos..."
        }
        Swal.fire({
            position: 'center',
            html: '<i class="fas fa-2x fa-sync-alt fa-spin"></i>',
            title: mensaje,
            showConfirmButton: false
        })
    }
    function CloseLoader(mensaje, tipo) {
        if(mensaje == '' || mensaje == null) {
            Swal.close();
        } else {
            Swal.fire({
                position: 'center',
                icon: tipo,
                title: mensaje,
                showConfirmButton: false
            })
        }
    }
});