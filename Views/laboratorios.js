$(document).ready(function(){
	Loader();
    //setTimeout(verificar_sesion, 2000);
    
    verificar_sesion();

    toastr.options = {
        "preventDuplicates": true
    }

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
            <li class="nav-item dropdown" id="carrito" style="display:none" role="button">
                <img src="/farmaciav2/Util/img/carrito.png" class="imagen-carrito nav-link">
                    <span id="contador" class="contador badge badge-danger"></span>
                </img>
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
                    <a href="/farmaciav2/Views/mi_perfil.php" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Mi perfil
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/farmaciav2/Views/usuarios.php" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Gestión usuarios
                        </p>
                    </a>
                </li>
                <li id="gestion_cliente" class="nav-item">
                    <a href="/farmaciav2/Views/clientes.php" class="nav-link">
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
                <li id="" class="nav-item">
                    <a href="/farmaciav2/Views/laboratorios.php" class="nav-link">
                        <i class="nav-icon fas fa-flask"></i>
                        <p>
                            Laboratorios
                        </p>
                    </a>
                </li>
                <li id="" class="nav-item">
                    <a href="/farmaciav2/Views/presentaciones.php" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>
                            Presentaciones
                        </p>
                    </a>
                </li>
                <li id="" class="nav-item">
                    <a href="/farmaciav2/Views/tipos.php" class="nav-link">
                        <i class="nav-icon fas fa-vials"></i>
                        <p>
                            Tipos
                        </p>
                    </a>
                </li>
                <li id="gestion_producto" class="nav-item">
                    <a href="adm_producto.php" class="nav-link">
                        <i class="nav-icon fas fa-pills"></i>
                        <p>
                            Gestión producto
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
                let usuario = JSON.parse(response);
                if(usuario.length != 0 && usuario.id_tipo != 3) {
                    llenar_menu_superior(usuario);
                    llenar_menu_lateral(usuario);
                    obtener_laboratorios();
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

	async function obtener_laboratorios() {
        let funcion = "obtener_laboratorios";
        let data = await fetch('/farmaciav2/Controllers/LaboratorioController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion
        })
        if(data.ok) {
            let response = await data.text();
            try {
                let laboratorios = JSON.parse(response);
                console.log(laboratorios);
                
                $('#laboratorios').DataTable({
                    data: laboratorios,
                    "aaSorting": [],
                    "searching": true,
                    "scrollX": false,
                    "autoWidth": false,
                    columns: [
                        {
                            "render": function(data, type, datos, meta) {
                                let template = '';
                                template += `
                                <div class="card card-widget widget-user-2">
                                    <div class="widget-user-header bg-success d-flex" >
                                        <div class="widget-user-image" style="width: 80px; height: 80px; object-fit: cover;">
                                            <img class="img-circle elevation-2" src="/farmaciav2/Util/img/laboratorios/${datos.avatar}" alt="User Avatar" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div>
                                            <h3 class="widget-user-username" style="margin: 0 20px;">${datos.nombre}</h3>`
                                            if(datos.estado == 'A') {
                                                template += `<h5 class="widget-user-desc" style="margin: 0 20px;"><span class="badge badge-warning">Activo</span></h5>`
                                            } else {
                                                template += `<h5 class="widget-user-desc" style="margin: 0 20px;"><span class="badge badge-secondary">Inactivo</span></h5>`
                                            }
                            
                            template += `</div>
                                    </div>
                                    <div class="card-footer p-0">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    Projects <span class="float-right badge bg-primary">31</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                `;
                                return template;
                            }
                        }
                    ],
                    "language": espanol,
                    "destroy": true
                })
                
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

    async function crear_cliente(datos) {
        let data = await fetch("/farmaciav2/Controllers/ClienteController.php", {
          method: "POST",
          body: datos
        });
        if (data.ok) {
          let response = await data.text();
          try {
            let respuesta = JSON.parse(response);
            if(respuesta.mensaje == 'success') {
                toastr.success('Se ha creado el cliente correctamente', 'Exito!', {timeOut: 2000});
                obtener_clientes();
                $('#crear_cliente').modal('hide');
                $('#form-crear_cliente').trigger('reset');
            } else if(respuesta.mensaje == 'error_cliente') {
                Swal.fire({
                    icon: 'error',
                    title: 'El cliente ya existe...',
                    text: 'El cliente ya existe, póngase en contacto con el administrador del sistema.'
                  });
                  $('#form-crear_cliente').trigger('reset');
            } else if(respuesta.mensaje == 'error_session') {
                Swal.fire({
                    position: "center",
                    icon: 'error',
                    title: 'Sesión finalizada...',
                    showConfirmButton: false,
                    timer: 1500,
                  }).then(function() {
                    //refresca la pagina (F5)
                    location.href='/farmaciav2/index.php';
                  });
            }
          } catch (error) {
            console.error(error);
            console.log(response);
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Hubo confilcto en el sistema, póngase en contacto con el administrador",
            });
          }
        } else {
          Swal.fire({
            icon: "error",
            title: data.statusText,
            text: "Hubo confilcto de código: " + data.status,
          });
        }
    }
    
    $.validator.setDefaults({
        submitHandler: function () {
            let datos = new FormData($('#form-crear_cliente')[0]);
            let funcion = "crear_cliente";
            datos.append('funcion', funcion);
            crear_cliente(datos);
        },
    });

    jQuery.validator.addMethod("letras", (value) => {
        let campo = value.replace(/ /g, '');
        let estado = /^[A-Za-z]+$/.test(campo);
        return estado;
    }, "* Este campo solo permite letras");
    
    $("#form-crear_cliente").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 3,
                letras: true
            },
            apellido: {
                required: true,
                minlength: 3,
                letras: true
            },
            nacimiento: {
                required: true
            },
            dni: {
                required: true,
                minlength: 7,
                maxlength: 8,
                number: true
            },
            telefono: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            sexo: {
                required: true,
                letras: true
            },
            correo: {
                required: true,
                email: true,
            },
            adicional: {
                maxlength: 100,
            },
        },
        messages: {
            nombre: {
                required: "* Dato requerido",
                minlength: "* Se permite mínimo 3 caracteres"
            },
            apellido: {
                required: "* Dato requerido",
                minlength: "* Se permite mínimo 3 caracteres"
            },
            nacimiento: {
                required: "* Dato requerido",
            },
            dni: {
                required: "* Dato requerido",
                number: "* El dato debe ser numérico",
                minlength: "* Se permite mínimo 7 caracteres",
                maxlength: "* Se permite máximo 8 caracteres",
            },
            telefono: {
                required: "* Dato requerido",
                number: "* El dato debe ser numérico",
                minlength: "* Se permite mínimo 10 caracteres",
                maxlength: "* Se permite máximo 10 caracteres",
            },
            sexo: {
                required: "* Dato requerido",
            },
            correo: {
                required: "* Dato requerido",
                email: "* Ingrese un correo de formato válido",
            },
            adicional: {
                maxlength: "* Se permite máximo 100 caracteres",
            },
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
            $(element).addClass("is-valid");
        },
    });

    $(document).on('click','.confirmar', (e) => {
        let elemento    = $(this)[0].activeElement;
        let id          = $(elemento).attr("id");
        let avatar      = $(elemento).attr("avatar");
        let nombre      = $(elemento).attr("nombre");
        let apellido    = $(elemento).attr("apellido");
        let funcion     = $(elemento).attr("funcion");
        console.log(funcion);
        $('#nombre_confirmar').text(nombre);
        $('#apellido_confirmar').text(apellido);
        $('#avatar_confirmar').attr('src', '/farmaciav2/Util/img/user/' + avatar);
        $('#id_usuario').val(id);
        $('#funcion').val(funcion);
    });

    async function confirmar(datos) {
        let data = await fetch("/farmaciav2/Controllers/UsuarioController.php", {
          method: "POST",
          body: datos
        });
        if (data.ok) {
          let response = await data.text();
          try {
            let respuesta = JSON.parse(response);
            if(respuesta.mensaje == 'success') {
                if(respuesta.funcion == 'eliminar usuario') {
                    toastr.success('Se elimino al usuario correctamente', 'Éxito!', {timeOut: 2000});
                    obtener_usuarios();
                    $('#confirmar').modal('hide');
                    $('#form-confirmar').trigger('reset');
                }
                else if(respuesta.funcion == 'activar usuario') {
                    toastr.success('Se activó al usuario correctamente', 'Éxito!', {timeOut: 2000});
                    obtener_usuarios();
                    $('#confirmar').modal('hide');
                    $('#form-confirmar').trigger('reset');
                }
                else if(respuesta.funcion == 'ascender usuario') {
                    toastr.success('Se ascendió al usuario correctamente', 'Éxito!', {timeOut: 2000});
                    obtener_usuarios();
                    $('#confirmar').modal('hide');
                    $('#form-confirmar').trigger('reset');
                }
                else if(respuesta.funcion == 'descender usuario') {
                    toastr.success('Se descendió al usuario correctamente', 'Éxito!', {timeOut: 2000});
                    obtener_usuarios();
                    $('#confirmar').modal('hide');
                    $('#form-confirmar').trigger('reset');
                }
            } else if(respuesta.mensaje == 'error_decrypt') {
                Swal.fire({
                    position: "center",
                    icon: 'error',
                    title: 'No vulnere los datos...',
                    showConfirmButton: false,
                    timer: 1500,
                  }).then(function() {
                    //refresca la pagina (F5)
                    location.reload();
                  });
            } else if(respuesta.mensaje == 'error_pass') {
                toastr.error('No se puedo ' + respuesta.funcion + ' Porque su contraseña actual no coincide con nuestros registros, intente de nuevo', 'Error!', {timeOut: 2500});
            } else if(respuesta.mensaje == 'error_session') {
                Swal.fire({
                    position: "center",
                    icon: 'error',
                    title: 'Sesión finalizada...',
                    showConfirmButton: false,
                    timer: 1500,
                  }).then(function() {
                    //refresca la pagina (F5)
                    location.href='/farmaciav2/index.php';
                  });
            }
          } catch (error) {
            console.error(error);
            console.log(response);
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "Hubo confilcto en el sistema, póngase en contacto con el administrador",
            });
          }
        } else {
          Swal.fire({
            icon: "error",
            title: data.statusText,
            text: "Hubo confilcto de código: " + data.status,
          });
        }
    }

    $.validator.setDefaults({
        submitHandler: function () {
            let datos = new FormData($('#form-confirmar')[0]);
            confirmar(datos);
        },
    });
    
    $("#form-confirmar").validate({
        rules: {
            pass: {
                required: true
            }
        },
        messages: {
            pass: {
                required: "* Dato requerido"
            }
        },
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".form-group").append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid");
            $(element).removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass("is-invalid");
            $(element).addClass("is-valid");
        },
    });

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

})

let espanol = {
    "processing": "Procesando...",
    "lengthMenu": "Mostrar _MENU_ registros",
    "zeroRecords": "No se encontraron resultados",
    "emptyTable": "Ningún dato disponible en esta tabla",
    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
    "search": "Buscar:",
    "infoThousands": ",",
    "loadingRecords": "Cargando...",
    "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": "Siguiente",
        "previous": "Anterior"
    },
    "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
            "1": "Copiada 1 fila al portapapeles",
            "_": "Copiadas %ds fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
            "-1": "Mostrar todas las filas",
            "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir",
        "renameState": "Cambiar nombre",
        "updateState": "Actualizar",
        "createState": "Crear Estado",
        "removeAllStates": "Remover Estados",
        "removeState": "Remover",
        "savedStates": "Estados Guardados",
        "stateRestore": "Estado %d"
    },
    "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
    },
    "decimal": ",",
    "searchBuilder": {
        "add": "Añadir condición",
        "button": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
            "date": {
                "after": "Despues",
                "before": "Antes",
                "between": "Entre",
                "empty": "Vacío",
                "equals": "Igual a",
                "notBetween": "No entre",
                "notEmpty": "No Vacio",
                "not": "Diferente de"
            },
            "number": {
                "between": "Entre",
                "empty": "Vacio",
                "equals": "Igual a",
                "gt": "Mayor a",
                "gte": "Mayor o igual a",
                "lt": "Menor que",
                "lte": "Menor o igual que",
                "notBetween": "No entre",
                "notEmpty": "No vacío",
                "not": "Diferente de"
            },
            "string": {
                "contains": "Contiene",
                "empty": "Vacío",
                "endsWith": "Termina en",
                "equals": "Igual a",
                "notEmpty": "No Vacio",
                "startsWith": "Empieza con",
                "not": "Diferente de",
                "notContains": "No Contiene",
                "notStarts": "No empieza con",
                "notEnds": "No termina con"
            },
            "array": {
                "not": "Diferente de",
                "equals": "Igual",
                "empty": "Vacío",
                "contains": "Contiene",
                "notEmpty": "No Vacío",
                "without": "Sin"
            }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
            "0": "Constructor de búsqueda",
            "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
    },
    "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
            "0": "Paneles de búsqueda",
            "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d",
        "showMessage": "Mostrar Todo",
        "collapseMessage": "Colapsar Todo"
    },
    "select": {
        "cells": {
            "1": "1 celda seleccionada",
            "_": "%d celdas seleccionadas"
        },
        "columns": {
            "1": "1 columna seleccionada",
            "_": "%d columnas seleccionadas"
        },
        "rows": {
            "1": "1 fila seleccionada",
            "_": "%d filas seleccionadas"
        }
    },
    "thousands": ".",
    "datetime": {
        "previous": "Anterior",
        "next": "Proximo",
        "hours": "Horas",
        "minutes": "Minutos",
        "seconds": "Segundos",
        "unknown": "-",
        "amPm": [
            "AM",
            "PM"
        ],
        "months": {
            "0": "Enero",
            "1": "Febrero",
            "10": "Noviembre",
            "11": "Diciembre",
            "2": "Marzo",
            "3": "Abril",
            "4": "Mayo",
            "5": "Junio",
            "6": "Julio",
            "7": "Agosto",
            "8": "Septiembre",
            "9": "Octubre"
        },
        "weekdays": [
            "Dom",
            "Lun",
            "Mar",
            "Mie",
            "Jue",
            "Vie",
            "Sab"
        ]
    },
    "editor": {
        "close": "Cerrar",
        "create": {
            "button": "Nuevo",
            "title": "Crear Nuevo Registro",
            "submit": "Crear"
        },
        "edit": {
            "button": "Editar",
            "title": "Editar Registro",
            "submit": "Actualizar"
        },
        "remove": {
            "button": "Eliminar",
            "title": "Eliminar Registro",
            "submit": "Eliminar",
            "confirm": {
                "_": "¿Está seguro que desea eliminar %d filas?",
                "1": "¿Está seguro que desea eliminar 1 fila?"
            }
        },
        "error": {
            "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
        },
        "multi": {
            "title": "Múltiples Valores",
            "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
            "restore": "Deshacer Cambios",
            "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
        }
    },
    "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
    "stateRestore": {
        "creationModal": {
            "button": "Crear",
            "name": "Nombre:",
            "order": "Clasificación",
            "paging": "Paginación",
            "search": "Busqueda",
            "select": "Seleccionar",
            "columns": {
                "search": "Búsqueda de Columna",
                "visible": "Visibilidad de Columna"
            },
            "title": "Crear Nuevo Estado",
            "toggleLabel": "Incluir:"
        },
        "emptyError": "El nombre no puede estar vacio",
        "removeConfirm": "¿Seguro que quiere eliminar este %s?",
        "removeError": "Error al eliminar el registro",
        "removeJoiner": "y",
        "removeSubmit": "Eliminar",
        "renameButton": "Cambiar Nombre",
        "renameLabel": "Nuevo nombre para %s",
        "duplicateError": "Ya existe un Estado con este nombre.",
        "emptyStates": "No hay Estados guardados",
        "removeTitle": "Remover Estado",
        "renameTitle": "Cambiar Nombre Estado"
    }
} 