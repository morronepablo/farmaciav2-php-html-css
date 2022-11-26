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
                let usuario = JSON.parse(response);
                if(usuario.length != 0 && usuario.id_tipo != 3) {
                    llenar_menu_superior(usuario);
                    llenar_menu_lateral(usuario);
                    obtener_clientes();
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

	async function obtener_clientes() {
        let funcion = "obtener_clientes";
        let data = await fetch('/farmaciav2/Controllers/ClienteController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion
        })
        if(data.ok) {
            let response = await data.text();
            try {
                let clientes = JSON.parse(response);
                //console.log(clientes);
                
                $('#clientes').DataTable({
                    data: clientes,
                    "aaSorting": [],
                    "searching": true,
                    "scrollX": false,
                    "autoWidth": false,
                    columns: [
                        {
                            "render": function(data, type, datos, meta) {
                                let template = '';
                                template += `
                                <div class="card bg-light">
                                    <div class="h5 card-header text-muted border-bottom-0">`
                                    if(datos.estado == 'A') {
                                        template += `<span class="badge badge-success">Activo</span>`;
                                    } else {
                                        template += `<span class="badge badge-secondary">Inactivo</span>`;
                                    }
                        template +=`</div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h4 class=""><b>${datos.nombre} ${datos.apellido}</b></h4>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> DNI: ${datos.dni}</li>
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Edad: ${datos.edad}</li>
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Teléfono: ${datos.telefono}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4">
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Correo: ${datos.correo}</li>
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Sexo: ${datos.sexo}</li>
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Adicional: ${datos.adicional}</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <img src="/farmaciav2/Util/img/${datos.avatar}"  alt="" class="img-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">`
                                        if(datos.estado == 'A') {
                                            template +=`<button id="${datos.id}" avatar="${datos.avatar}" nombre="${datos.nombre}" apellido="${datos.apellido}" class="eliminar_cliente btn btn-outline-danger btn-circle btn-lg">
                                                            <i class="far fa-trash-alt mr-5"></i>
                                                        </button>   
                                                        <button id="${datos.id}" avatar="${datos.avatar}" nombre="${datos.nombre}" apellido="${datos.apellido}" class="editar_cliente btn btn-outline-success btn-circle btn-lg">
                                                            <i class="fas fa-pencil-alt mr-5"></i>
                                                        </button>`
                                        }
                                        else if(datos.estado == 'I') {
                                            template +=`<button id="${datos.id}" avatar="${datos.avatar}" nombre="${datos.nombre}" apellido="${datos.apellido}" class="activar_cliente btn btn-outline-primary btn-circle btn-lg">
                                                            <i class="fas fa-plus mr-5"></i>
                                                        </button>
                                                        <button id="${datos.id}" avatar="${datos.avatar}" nombre="${datos.nombre}" apellido="${datos.apellido}" class="editar_cliente btn btn-outline-success btn-circle btn-lg">
                                                            <i class="fas fa-pencil-alt mr-5"></i>
                                                        </button>`
                                        }
                               
                            template +=`</div>
                                    </div>
                                </div>
                                `
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

    async function crear_usuario(datos) {
        let data = await fetch("/farmaciav2/Controllers/UsuarioController.php", {
          method: "POST",
          body: datos
        });
        if (data.ok) {
          let response = await data.text();
          try {
            let respuesta = JSON.parse(response);
            if(respuesta.mensaje == 'success') {
                toastr.success('Se ha creado el usuario correctamente', 'Exito!', {timeOut: 2000});
                obtener_usuarios();
                $('#crear_usuario').modal('hide');
                $('#form-crear_usuario').trigger('reset');
                $('#residencia').val('').trigger('change');
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
            } else if(respuesta.mensaje == 'error_usuario') {
                Swal.fire({
                    icon: 'error',
                    title: 'El usuario ya existe...',
                    text: 'El usuario ya existe, póngase en contacto con el administrador del sistema.'
                  });
                  $('#form-crear_usuario').trigger('reset');
                  $('#residencia').val('').trigger('change');
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
            let datos = new FormData($('#form-crear_usuario')[0]);
            let funcion = "crear_usuario";
            datos.append('funcion', funcion);
            crear_usuario(datos);
        },
    });

    jQuery.validator.addMethod("letras", (value) => {
        let campo = value.replace(/ /g, '');
        let estado = /^[A-Za-z]+$/.test(campo);
        return estado;
    }, "* Este campo solo permite letras");
    
    $("#form-crear_usuario").validate({
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
            password: {
                required: true
            },
            telefono: {
                required: true,
                minlength: 10,
                maxlength: 10,
                number: true
            },
            residencia: {
                required: true,
            },
            direccion: {
                required: true,
                minlength: 2,
                maxlength: 100,
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
            password: {
                required: "* Dato requerido",
            },
            telefono: {
                required: "* Dato requerido",
                number: "* El dato debe ser numérico",
                minlength: "* Se permite mínimo 10 caracteres",
                maxlength: "* Se permite máximo 10 caracteres",
            },
            residencia: {
                required: "* Dato requerido",
            },
            direccion: {
                required: "* Dato requerido",
                minlength: "* Se permite mínimo 2 caracteres",
                maxlength: "* Se permite máximo 100 caracteres",
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


	/*var tipo_usuario = $('#tipo_usuario').val();
	if(tipo_usuario==2){
		$('#button-crear').hide();
	}
	buscar_datos();
	var funcion;
	function buscar_datos(consulta){
		funcion='buscar_usuarios_adm';
		$.post('../controlador/UsuarioController.php',{consulta,funcion},(response)=>{
			const usuarios = JSON.parse(response);
			let template='';
			usuarios.forEach(usuario=>{
				template+=`
				<div usuarioId="${usuario.id}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">`;
                if(usuario.tipo_usuario==3){
                	template+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
                }
                if(usuario.tipo_usuario==1){
                	template+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
                }
                if(usuario.tipo_usuario==2){
                	template+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
                }
                template+=`</div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${usuario.nombre} ${usuario.apellidos}</b></h2>
                      <p class="text-muted text-sm"><b>Sobre mi: </b>${usuario.adicional}</p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                      	<li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> DNI. : ${usuario.dni}</li>
                      	<li class="small"><span class="fa-li"><i class="fas fa-lg fa-birthday-cake"></i></span> Edad : ${usuario.edad}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Dirección : ${usuario.residencia}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Teléfono : ${usuario.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo : ${usuario.correo}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-smile-wink	"></i></span> Sexo : ${usuario.sexo}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${usuario.avatar}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">`;
                if(tipo_usuario==3){
                	if(usuario.tipo_usuario!=3){
                		template+=`
                		<button class="borrar-usuario btn btn-danger mr-1" type="button" data-toggle="modal" data-target="#confirmar">
                    		<i class="fas fa-user-times mr-2"></i>Eliminar
                    	</button>
                		`;
                	}
                	if(usuario.tipo_usuario==2){
                		template+=`
                		<button class="ascender btn btn-primary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                    		<i class="fas fa-sort-amount-up mr-2"></i>Ascender
                    	</button>
                		`;
                	}
                	if(usuario.tipo_usuario==1){
                		template+=`
                		<button class="descender btn btn-secondary ml-1" type="button" data-toggle="modal" data-target="#confirmar">
                    		<i class="fas fa-sort-amount-down mr-2"></i>Descender
                    	</button>
                		`;
                	}
                }
                else{
                	if(tipo_usuario==1 && usuario.tipo_usuario!=1 && usuario.tipo_usuario!=3){
                		template+=`
                		<button class="borrar-usuario btn btn-danger" type="button" data-toggle="modal" data-target="#confirmar">
                    		<i class="fas fa-user-times mr-2"></i>Eliminar
                    	</button>
                		`;
                	}
                }

                template+=`
                  </div>
                </div>
              </div>
            </div>
				`;
			})
			$('#usuarios').html(template);
		});
	}
	$(document).on('keyup','#buscar',function(){
		let valor = $(this).val();
		if(valor!=""){
			buscar_datos(valor);
		}
		else{
			buscar_datos();
		}
	});
	$('#form-crear').submit(e=>{
		let nombre = $('#nombre').val();
		let apellido = $('#apellido').val();
		let edad = $('#edad').val();
		let dni = $('#dni').val();
		let pass = $('#pass').val();
		funcion ='crear_usuario';
		$.post('../controlador/UsuarioController.php',{nombre,apellido,edad,dni,pass,funcion},(response)=>{
			if(response=='add'){
				$('#add').hide('slow');
				$('#add').show(1000);
				$('#add').hide(2000);
				$('#form-crear').trigger('reset');
				buscar_datos();
			}
			else{
				$('#noadd').hide('slow');
				$('#noadd').show(1000);
				$('#noadd').hide(2000);
				$('#form-crear').trigger('reset');
			}
		});
		e.preventDefault();
	});
	$(document).on('click','.ascender',(e)=>{
		const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
		const id=$(elemento).attr('usuarioId');
		funcion='ascender';
		$('#id_user').val(id);
		$('#funcion').val(funcion);
	});
	$(document).on('click','.descender',(e)=>{
		const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
		const id=$(elemento).attr('usuarioId');
		funcion='descender';
		$('#id_user').val(id);
		$('#funcion').val(funcion);
	});
	$(document).on('click','.borrar-usuario',(e)=>{
		const elemento= $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
		const id=$(elemento).attr('usuarioId');
		funcion='borrar_usuario';
		$('#id_user').val(id);
		$('#funcion').val(funcion);
	});
	$('#form-confirmar').submit(e=>{
		let pass=$('#oldpass').val();
		let id_usuario=$('#id_user').val();
		funcion=$('#funcion').val();
		$.post('../controlador/UsuarioController.php',{pass,id_usuario,funcion},(response)=>{
			if(response=='ascendido'|| response=='descendido'|| response=='borrado'){
				$('#confirmado').hide('slow');
				$('#confirmado').show(1000);
				$('#confirmado').hide(2000);
				$('#form-confirmar').trigger('reset');
			}
			else{
				$('#rechazado').hide('slow');
				$('#rechazado').show(1000);
				$('#rechazado').hide(2000);
				$('#form-confirmar').trigger('reset');
			}
			buscar_datos();
		});
		e.preventDefault();
	});*/
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