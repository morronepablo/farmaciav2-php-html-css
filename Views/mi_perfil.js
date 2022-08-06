$(document).ready(function () {
  Loader();
  //setTimeout(verificar_sesion, 2000);
  verificar_sesion();
  toastr.options = {
    preventDuplicates: true,
  };

  $("#residencia").select2({
    placeholder: "Seleccione una residencia",
    language: {
      noResult: function () {
        return "No hay resultados.";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });

  async function obtener_residencias() {
    let funcion = "obtener_residencias";
    let data = await fetch("/farmaciav2/Controllers/LocalidadController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let residencias = JSON.parse(response);
        let template = ``;
        residencias.forEach((residencia) => {
          template += `
                    <option value="${residencia.id}">${residencia.residencia}</option>
                    `;
        });
        $("#residencia").html(template);
        $("#residencia").val("").trigger("change");
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

  function llenar_menu_superior(usuario) {
    let template = `
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
                    <img src="/farmaciav2/Util/img/user/${
                      usuario.avatar
                    }" class="img-circle elevation-2" width="30" height="30">
                    <span>${usuario.nombre + " " + usuario.apellido}</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/farmaciav2/Controllers/Logout.php"><i class="fas fa-user-times mr-2"></i>Cerrar sesión</a>
                    </li>
                </ul>
            </li>
        </ul>
        `;
    $("#menu_superior").html(template);
  }

  function llenar_menu_lateral(usuario) {
    let template = `
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/farmaciav2/Util/img/user/${
                  usuario.avatar
                }" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">${
                  usuario.nombre + " " + usuario.apellido
                }</a>
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
    $("#menu_lateral").html(template);
  }

  async function verificar_sesion() {
    let funcion = "verificar_sesion";
    let data = await fetch("/farmaciav2/Controllers/UsuarioController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if (respuesta.length != 0) {
          llenar_menu_superior(respuesta);
          llenar_menu_lateral(respuesta);
          obtener_residencias();
          obtener_usuario();
          CloseLoader();
        } else {
          location.href = "/farmaciav2/";
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

  async function obtener_usuario() {
    let funcion = "obtener_usuario";
    let data = await fetch("/farmaciav2/Controllers/UsuarioController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let usuario = JSON.parse(response);
        console.log(usuario);
        let template = `
                <div class="text-center">
    				<img role="button" src="/farmaciav2/Util/img/user/${usuario.avatar}" class="profile-user-img img-fluid img-circle" data-toggle="modal" data-target="#cambiophoto">
    			</div>
                <h3 class="profile-username text-center text-success">${usuario.nombre}</h3>
                <p class="text-muted text-center">${usuario.apellido}</p>
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b style="color: #0B7300">Edad</b><a class="float-right">${usuario.edad}</a>
                    </li>
                    <li class="list-group-item">
                        <b style="color: #0B7300">DNI</b><a class="float-right">${usuario.dni}</a>
                    </li>
                    <li class="list-group-item">
                        <b style="color: #0B7300">Tipo Usuario</b>
                        <span class="float-right">`;
        if (usuario.id_tipo == "1") {
          template += `<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
        } else if (usuario.id_tipo == "2") {
          template += `<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
        } else if (usuario.id_tipo == "3") {
          template += `<h1 class="badge badge-info">${usuario.tipo}</h1>`;
        }
        template += `</span>
                        <button data-toggle="modal" data-target="#cambiocontra" type="button" class="btn btn-block btn-outline-warning btn-sm">Cambiar Password</button>
                    </li>
                </ul>
                `;
        $("#card_1").html(template);
        let template_1 = `
                <div class="card-header">
                    <h3 class="card-title">Sobre mi</h3>
                    <div class="card-tools">
                        <button id="${usuario.id}" 
                                telefono="${usuario.telefono}"
                                id_residencia="${usuario.id_residencia}"
                                direccion="${usuario.direccion}"
                                correo="${usuario.correo}"
                                sexo="${usuario.sexo}"
                                adicional="${usuario.adicional}"
                                class="editar_datos btn btn-tool" 
                                data-toggle="modal" 
                                data-target="#editar_datos_personales"
                        >
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <strong style="color: #0B7300">
                        <i class="fas fa-phone mr-1"></i>Teléfono
                    </strong>
                    <p class="text-muted">${usuario.telefono}</p>
                    <strong style="color: #0B7300">
                        <i class="fas fa-map-marker-alt mr-1"></i>Residencia
                    </strong>
                    <p class="text-muted">${usuario.residencia}</p>
                    <strong style="color: #0B7300">
                        <i class="fas fa-map-marker-alt mr-1"></i>Dirección
                    </strong>
                    <p class="text-muted">${usuario.direccion}</p>
                    <strong style="color: #0B7300">
                        <i class="fas fa-at mr-1"></i>Correo
                    </strong>
                    <p class="text-muted">${usuario.correo}</p>
                    <strong style="color: #0B7300">
                        <i class="fas fa-smile-wink mr-1"></i>Sexo
                    </strong>
                    <p class="text-muted">${usuario.sexo}</p>
                    <strong style="color: #0B7300">
                        <i class="fas fa-pencil-alt mr-1"></i>Información adicional
                    </strong>
                    <p class="text-muted">${usuario.adicional}</p>
                </div>
                `;
        $("#card_2").html(template_1);
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

  $(document).on("click", ".editar_datos", (e) => {
    let elemento = $(this)[0].activeElement;

    let telefono = $(elemento).attr("telefono");
    let id_residencia = $(elemento).attr("id_residencia");
    let direccion = $(elemento).attr("direccion");
    let correo = $(elemento).attr("correo");
    let sexo = $(elemento).attr("sexo");
    let adiciional = $(elemento).attr("adiciional");

    $("#telefono").val(telefono);
    $("#residencia").val(id_residencia).trigger("change");
    $("#direccion").val(direccion);
    $("#correo").val(correo);
    $("#sexo").val(sexo);
    $("#adiciional").val(adiciional);
  });

  async function editar_datos(datos) {
    let data = await fetch("/farmaciav2/Controllers/UsuarioController.php", {
      method: "POST",
      body: datos
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if(respuesta.mensaje == 'success') {
            toastr.success('Sus datos fueron actualizados', 'Exito!', {timeOut: 2000});
            obtener_usuario();
            $('#editar_datos_personales').modal('hide');
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
      let datos = new FormData($('#form-editar_datos_personales')[0]);
      let funcion = "editar_datos";
      datos.append('funcion', funcion);
      editar_datos(datos);
    },
  });

  $("#form-editar_datos_personales").validate({
    rules: {
      telefono: {
        required: true,
        number: true,
        minlength: 10,
        maxlength: 10,
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

  function Loader(mensaje) {
    if (mensaje == "" || mensaje == null) {
      mensaje = "Cargando datos...";
    }
    Swal.fire({
      position: "center",
      html: '<i class="fas fa-2x fa-sync-alt fa-spin"></i>',
      title: mensaje,
      showConfirmButton: false,
    });
  }

  function CloseLoader(mensaje, tipo) {
    if (mensaje == "" || mensaje == null) {
      Swal.close();
    } else {
      Swal.fire({
        position: "center",
        icon: tipo,
        title: mensaje,
        showConfirmButton: false,
      });
    }
  }

  /*var funcion='';
	var id_usuario = $('#id_usuario').val();
	var edit=false;
	buscar_usuario(id_usuario);
	function buscar_usuario(dato){
	    funcion='buscar_usuario';
		$.post('../controlador/UsuarioController.php',{dato,funcion},(response)=>{
			
			let nombre='';
			let apellidos='';
			let edad='';
			let dni='';
			let tipo='';
			let telefono='';
			let residencia='';
			let correo='';
			let sexo='';
			let adicional='';
			const usuario = JSON.parse(response);
			nombre+=`${usuario.nombre}`;
			apellidos+=`${usuario.apellidos}`;
			edad+=`${usuario.edad}`;
			dni+=`${usuario.dni}`;
			if(usuario.tipo=='Root'){
            	tipo+=`<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
            }
            if(usuario.tipo=='Administrador'){
            	tipo+=`<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
            }
            if(usuario.tipo=='Tecnico'){
            	tipo+=`<h1 class="badge badge-info">${usuario.tipo}</h1>`;
            }
			telefono+=`${usuario.telefono}`;
			residencia+=`${usuario.residencia}`;
			correo+=`${usuario.correo}`;
			sexo+=`${usuario.sexo}`;
			adicional+=`${usuario.adicional}`;
			$('#nombre_us').html(nombre);
			$('#apellidos_us').html(apellidos);
			$('#edad').html(edad);
			$('#dni_us').html(dni);
			$('#us_tipo').html(tipo);
			$('#telefono_us').html(telefono);
			$('#residencia_us').html(residencia);
			$('#correo_us').html(correo);
			$('#sexo_us').html(sexo);
			$('#adicional_us').html(adicional);
			$('#avatar2').attr('src',usuario.avatar);
			$('#avatar1').attr('src',usuario.avatar);
			$('#avatar3').attr('src',usuario.avatar);
			$('#avatar4').attr('src',usuario.avatar);
		})
	}
	$(document).on('click','.edit',(e)=>{
		funcion='capturar_datos';
		edit=true;
		$.post('../controlador/UsuarioController.php',{funcion,id_usuario},(response)=>{
			const usuario = JSON.parse(response);
			$('#telefono').val(usuario.telefono);
			$('#residencia').val(usuario.residencia);
			$('#correo').val(usuario.correo);
			$('#sexo').val(usuario.sexo);
			$('#adicional').val(usuario.adicional);
		})
	});
	$('#form-usuario').submit(e=>{
		if(edit==true){
			let telefono=$('#telefono').val();
			let residencia=$('#residencia').val();
			let correo=$('#correo').val();
			let sexo=$('#sexo').val();
			let adicional=$('#adicional').val();
			funcion='editar_usuario';
			$.post('../controlador/UsuarioController.php',{id_usuario,funcion,telefono,residencia,correo,sexo,adicional},(response)=>{
				if(response=='editado'){
					$('#editado').hide('slow');
					$('#editado').show(1000);
					$('#editado').hide(2000);
					$('#form-usuario').trigger('reset');
				}
				edit=false;
				buscar_usuario(id_usuario);
			})
		}
		else{
			$('#noeditado').hide('slow');
			$('#noeditado').show(1000);
			$('#noeditado').hide(2000);
			$('#form-usuario').trigger('reset');
		}
		e.preventDefault();
	});

	$('#form-pass').submit(e=>{
		let oldpass=$('#oldpass').val();
		let newpass=$('#newpass').val();
		funcion='cambiar_contra';
		$.post('../controlador/UsuarioController.php',{id_usuario,funcion,oldpass,newpass},(response)=>{
			if(response=='update'){
				$('#update').hide('slow');
				$('#update').show(1000);
				$('#update').hide(2000);
				$('#form-pass').trigger('reset');
			}
			else{
				$('#noupdate').hide('slow');
				$('#noupdate').show(1000);
				$('#noupdate').hide(2000);
				$('#form-pass').trigger('reset');
			}
		})
		e.preventDefault();
	})
	$('#form-photo').submit(e=>{
		let formData = new FormData($('#form-photo')[0]);
		$.ajax({
			url:'../controlador/UsuarioController.php',
			type:'POST',
			data:formData,
			cache:false,
			processData: false,
			contentType:false
		}).done(function(response){
			const json = JSON.parse(response);
			if(json.alert=='edit'){
				$('#avatar1').attr('src',json.ruta);
				$('#edit').hide('slow');
				$('#edit').show(1000);
				$('#edit').hide(2000);
				$('#form-photo').trigger('reset');
				buscar_usuario(id_usuario);
			}
			else{
				$('#noedit').hide('slow');
				$('#noedit').show(1000);
				$('#noedit').hide(2000);
				$('#form-photo').trigger('reset');
			}


		});
		e.preventDefault();
	})*/
});
