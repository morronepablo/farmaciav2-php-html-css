$(document).ready(function () {
  bsCustomFileInput.init();
  Loader();
  //setTimeout(verificar_sesion, 2000);

  verificar_sesion();

  toastr.options = {
    preventDuplicates: true,
  };

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
                <li id="" class="nav-item">
                  <a href="/farmaciav2/Views/subtipos.php" class="nav-link">
                      <i class="nav-icon fas fa-tablets"></i>
                      <p>
                          Subtipos
                      </p>
                  </a>
                </li>
                <li id="gestion_producto" class="nav-item">
                  <a href="/farmaciav2/Views/productos.php" class="nav-link">
                      <i class="nav-icon fas fa-pills"></i>
                      <p>
                          Gestión producto
                      </p>
                  </a>
                </li>
                <li id="" class="nav-item">
                    <a href="/farmaciav2/Views/lotes.php" class="nav-link">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Gestión lote
                        </p>
                    </a>
                </li>
                <li id="gestion_compras" class="nav-header">Compras</li>
                <li id="" class="nav-item">
                  <a href="/farmaciav2/Views/pedidos.php" class="nav-link">
                      <i class="nav-icon fas fa-clipboard-list"></i>
                      <p>
                          Gestión pedidos
                      </p>
                  </a>
                </li>
                <li id="gestion_proveedor" class="nav-item">
                  <a href="/farmaciav2/Views/proveedores.php" class="active nav-link">
                      <i class="nav-icon fas fa-truck"></i>
                      <p>
                          Gestión proveedor
                      </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/farmaciav2/Views/compras.php" class="nav-link">
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
        let usuario = JSON.parse(response);
        if (usuario.length != 0 && usuario.id_tipo != 3) {
          llenar_menu_superior(usuario);
          llenar_menu_lateral(usuario);
          obtener_proveedores();
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

  async function obtener_proveedores() {
    let funcion = "obtener_proveedores";
    let data = await fetch("/farmaciav2/Controllers/ProveedorController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let proveedores = JSON.parse(response);
        console.log(proveedores);

        $("#proveedores").DataTable({
          data: proveedores,
          aaSorting: [],
          searching: true,
          scrollX: false,
          autoWidth: false,
          columns: [
            {
              render: function (data, type, datos, meta) {
                let template = "";
                template += `
                                <div class="card bg-light">
                                    <div class="h5 card-header text-muted border-bottom-0">`;
                if (datos.estado == "A") {
                  template += `<span class="badge badge-success">Activo</span>`;
                } else {
                  template += `<span class="badge badge-secondary">Inactivo</span>`;
                }
                template += `</div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class=""><b>${datos.nombre}</b></h4>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Teléfono: ${datos.telefono}</li>
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Correo: ${datos.correo}</li>
                                                    <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Dirección: ${datos.direccion}</li>
                                                </ul>
                                            </div>
                                            
                                            <div class="col-md-6 text-center">
                                                <img src="/farmaciav2/Util/img/proveedores/${datos.avatar}"  alt="" class="img-circle img-fluid" style="width: 150px; height: 150px; object-fit: contain;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">`;
                if (datos.estado == "A") {
                  template += `<button 
                                                            id="${datos.id}" 
                                                            avatar="${datos.avatar}" 
                                                            nombre="${datos.nombre}" 
                                                            class="eliminar_proveedor btn btn-outline-danger btn-circle btn-lg"
                                                        >
                                                            <i class="far fa-trash-alt mr-5"></i>
                                                        </button>   
                                                        <button 
                                                            id="${datos.id}" 
                                                            avatar="${datos.avatar}" 
                                                            nombre="${datos.nombre}" 
                                                            telefono="${datos.telefono}"
                                                            correo="${datos.correo}"
                                                            direccion="${datos.direccion}"
                                                            data-toggle="modal"
                                                            data-target="#editar_proveedor"
                                                            class="editar_proveedor btn btn-outline-success btn-circle btn-lg"
                                                        >
                                                            <i class="fas fa-pencil-alt mr-5"></i>
                                                        </button>`;
                } else if (datos.estado == "I") {
                  template += `<button 
                                                            id="${datos.id}" 
                                                            avatar="${datos.avatar}" 
                                                            nombre="${datos.nombre}" 
                                                            class="activar_proveedor btn btn-outline-primary btn-circle btn-lg"
                                                        >
                                                            <i class="fas fa-plus mr-5"></i>
                                                        </button>`;
                }

                template += `</div>
                                    </div>
                                </div>
                                `;
                return template;
              },
            },
          ],
          language: espanol,
          destroy: true,
        });
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

  async function crear_proveedor(datos) {
    let data = await fetch("/farmaciav2/Controllers/ProveedorController.php", {
      method: "POST",
      body: datos,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let respuesta = JSON.parse(response);
        if (respuesta.mensaje == "success") {
          toastr.success("Se ha creado el proveedor correctamente", "Éxito!", {
            timeOut: 2000,
          });
          obtener_proveedores();
          $("#crear_proveedor").modal("hide");
          $("#form-crear_proveedor").trigger("reset");
        } else if (respuesta.mensaje == "error_prov") {
          Swal.fire({
            icon: "error",
            title: "El proveedor ya existe...",
            text: "El proveedor ya existe, póngase en contacto con el administrador del sistema.",
          });
          //$('#form-crear_proveedor').trigger('reset');
        } else if (respuesta.mensaje == "error_session") {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "Sesión finalizada...",
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            //refresca la pagina (F5)
            location.href = "/farmaciav2/index.php";
          });
        }
      } catch (error) {
        console.error(error);
        console.log(response);
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo conflicto en el sistema, póngase en contacto con el administrador",
        });
      }
    } else {
      Swal.fire({
        icon: "error",
        title: data.statusText,
        text: "Hubo conflicto de código: " + data.status,
      });
    }
  }

  $.validator.setDefaults({
    submitHandler: function () {
      let datos = new FormData($("#form-crear_proveedor")[0]);
      let funcion = "crear_proveedor";
      datos.append("funcion", funcion);
      crear_proveedor(datos);
    },
  });

  jQuery.validator.addMethod(
    "letras",
    (value) => {
      let campo = value.replace(/ /g, "");
      let estado = /^[A-Za-z.]+$/.test(campo);
      return estado;
    },
    "* Este campo solo permite letras"
  );

  $("#form-crear_proveedor").validate({
    rules: {
      nombre: {
        required: true,
        minlength: 3,
        letras: true,
      },
      telefono: {
        required: true,
        minlength: 10,
        maxlength: 10,
        number: true,
      },
      correo: {
        required: true,
        email: true,
      },
      direccion: {
        required: true,
        minlength: 3,
      },
    },
    messages: {
      nombre: {
        required: "* Dato requerido",
        minlength: "* Se permite mínimo 3 caracteres",
        letras: "* Solo se permite letras",
      },
      telefono: {
        required: "* Dato requerido",
        minlength: "* Se permite mínimo 10 caracteres",
        maxlength: "* Se permite máximo 10 caracteres",
        number: "* Solo se permite números",
      },
      correo: {
        required: "* Dato requerido",
        email: "* Solo se permite formato email",
      },
      direccion: {
        required: "* Dato requerido",
        minlength: "* Se permite mínimo 3 caracteres",
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

  $(document).on("click", ".editar_proveedor", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let nombre = $(elemento).attr("nombre");
    let avatar = $(elemento).attr("avatar");
    let telefono = $(elemento).attr("telefono");
    let correo = $(elemento).attr("correo");
    let direccion = $(elemento).attr("direccion");
    console.log(avatar, telefono, correo, direccion);

    $("#nombre_card").text(nombre);
    $("#avatar_card").attr("src", "/farmaciav2/Util/img/proveedores/" + avatar);
    $("#id_proveedor").val(id);
    $("#nombre_edit").val(nombre);
    $("#telefono_edit").val(telefono);
    $("#correo_edit").val(correo);
    $("#direccion_edit").val(direccion);
  });

  async function editar_proveedor(datos) {
    let data = await fetch("/farmaciav2/Controllers/ProveedorController.php", {
      method: "POST",
      body: datos,
    });
    if (data.ok) {
      let response = await data.text();
      console.log(response);
      try {
        let respuesta = JSON.parse(response);
        if (respuesta.mensaje == "success") {
          toastr.success("Se ha editado el proveedor correctamente", "Exito!", {
            timeOut: 2000,
          });
          obtener_proveedores();
          $("#editar_proveedor").modal("hide");
          $("#form-editar_proveedor").trigger("reset");
        } else if (respuesta.mensaje == "error_prov") {
          Swal.fire({
            icon: "error",
            title: "El proveedor ya existe...",
            text: "El proveedor ya existe, póngase en contacto con el administrador del sistema.",
          });
        } else if (respuesta.mensaje == "error_decrypt") {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "No vulnere los datos",
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            location.reload();
          });
        } else if (respuesta.mensaje == "error_session") {
          Swal.fire({
            position: "center",
            icon: "error",
            title: "Sesión finalizada...",
            showConfirmButton: false,
            timer: 1500,
          }).then(function () {
            //refresca la pagina (F5)
            location.href = "/farmaciav2/index.php";
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
      let datos = new FormData($("#form-editar_proveedor")[0]);
      let funcion = "editar_proveedor";
      datos.append("funcion", funcion);
      editar_proveedor(datos);
    },
  });

  $("#form-editar_proveedor").validate({
    rules: {
      nombre_edit: {
        required: true,
        minlength: 3,
        letras: true,
      },
      telefono_edit: {
        required: true,
        minlength: 10,
        maxlength: 10,
        number: true,
      },
      correo_edit: {
        required: true,
        email: true,
      },
      direccion_edit: {
        required: true,
        minlength: 3,
      },
      avatar_edit: {
        extension: "png|jpg|jpeg|img",
      },
    },
    messages: {
      nombre_edit: {
        required: "* Dato requerido",
        minlength: "* Se permite mínimo 3 caracteres",
        letras: "* Solo se permite letras",
      },
      telefono_edit: {
        required: "* Dato requerido",
        minlength: "* Se permite mínimo 10 caracteres",
        maxlength: "* Se permite máximo 10 caracteres",
        number: "* Solo se permite números",
      },
      correo_edit: {
        required: "* Dato requerido",
        email: "* Solo se permite formato email",
      },
      direccion_edit: {
        required: "* Dato requerido",
        minlength: "* Se permite mínimo 3 caracteres",
      },
      avatar_edit: {
        extension: "* Solo se permite formato (png, jpg, jpeg, img)",
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

  async function eliminar(id) {
    let funcion = "eliminar";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/ProveedorController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion + "&&id=" + id,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        respuesta = JSON.parse(response);
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
    return respuesta;
  }

  $(document).on("click", ".eliminar_proveedor", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let avatar = $(elemento).attr("avatar");
    let nombre = $(elemento).attr("nombre");
    console.log(id, avatar, nombre);
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success ml-2",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: `Desea eliminar el proveedor ${nombre} ?`,
        imageUrl: "/farmaciav2/Util/img/proveedores/" + avatar,
        imageWidth: 200,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonText: "Si, eliminar !",
        cancelButtonText: "No, cancelar !",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          eliminar(id).then((respuesta) => {
            if (respuesta.mensaje == "success") {
              obtener_proveedores();
              swalWithBootstrapButtons.fire(
                "Eliminado!",
                "El proveedor fue eliminado correctamente",
                "success"
              );
            } else if (respuesta.mensaje == "error_decrypt") {
              Swal.fire({
                position: "center",
                icon: "error",
                title: "No vulnere los datos...",
                showConfirmButton: false,
                timer: 1500,
              }).then(function () {
                //refresca la pagina (F5)
                location.reload();
              });
            } else if (respuesta.mensaje == "error_session") {
              Swal.fire({
                position: "center",
                icon: "error",
                title: "Sesión finalizada...",
                showConfirmButton: false,
                timer: 1500,
              }).then(function () {
                //refresca la pagina (F5)
                location.href = "/farmaciav2/index.php";
              });
            }
          });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            "Cancelado",
            "canceló la eliminación del proveedor",
            "error"
          );
        }
      });
  });

  async function activar(id) {
    let funcion = "activar";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/ProveedorController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion + "&&id=" + id,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        respuesta = JSON.parse(response);
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
    return respuesta;
  }

  $(document).on("click", ".activar_proveedor", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let avatar = $(elemento).attr("avatar");
    let nombre = $(elemento).attr("nombre");
    console.log(id, avatar, nombre);
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success ml-2",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: `Desea volver activar el proveedor ${nombre} ?`,
        imageUrl: "/farmaciav2/Util/img/proveedores/" + avatar,
        imageWidth: 200,
        imageHeight: 200,
        showCancelButton: true,
        confirmButtonText: "Si, activar !",
        cancelButtonText: "No, cancelar !",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          activar(id).then((respuesta) => {
            if (respuesta.mensaje == "success") {
              obtener_proveedores();
              swalWithBootstrapButtons.fire(
                "Activado!",
                "El proveedor fue activado correctamente",
                "success"
              );
            } else if (respuesta.mensaje == "error_decrypt") {
              Swal.fire({
                position: "center",
                icon: "error",
                title: "No vulnere los datos...",
                showConfirmButton: false,
                timer: 1500,
              }).then(function () {
                //refresca la pagina (F5)
                location.reload();
              });
            } else if (respuesta.mensaje == "error_session") {
              Swal.fire({
                position: "center",
                icon: "error",
                title: "Sesión finalizada...",
                showConfirmButton: false,
                timer: 1500,
              }).then(function () {
                //refresca la pagina (F5)
                location.href = "/farmaciav2/index.php";
              });
            }
          });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            "Cancelado",
            "canceló la activación del tipo",
            "error"
          );
        }
      });
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
});

let espanol = {
  processing: "Procesando...",
  lengthMenu: "Mostrar _MENU_ registros",
  zeroRecords: "No se encontraron resultados",
  emptyTable: "Ningún dato disponible en esta tabla",
  infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  infoFiltered: "(filtrado de un total de _MAX_ registros)",
  search: "Buscar:",
  infoThousands: ",",
  loadingRecords: "Cargando...",
  paginate: {
    first: "Primero",
    last: "Último",
    next: "Siguiente",
    previous: "Anterior",
  },
  aria: {
    sortAscending: ": Activar para ordenar la columna de manera ascendente",
    sortDescending: ": Activar para ordenar la columna de manera descendente",
  },
  buttons: {
    copy: "Copiar",
    colvis: "Visibilidad",
    collection: "Colección",
    colvisRestore: "Restaurar visibilidad",
    copyKeys:
      "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br /> <br /> Para cancelar, haga clic en este mensaje o presione escape.",
    copySuccess: {
      1: "Copiada 1 fila al portapapeles",
      _: "Copiadas %ds fila al portapapeles",
    },
    copyTitle: "Copiar al portapapeles",
    csv: "CSV",
    excel: "Excel",
    pageLength: {
      "-1": "Mostrar todas las filas",
      _: "Mostrar %d filas",
    },
    pdf: "PDF",
    print: "Imprimir",
    renameState: "Cambiar nombre",
    updateState: "Actualizar",
    createState: "Crear Estado",
    removeAllStates: "Remover Estados",
    removeState: "Remover",
    savedStates: "Estados Guardados",
    stateRestore: "Estado %d",
  },
  autoFill: {
    cancel: "Cancelar",
    fill: "Rellene todas las celdas con <i>%d</i>",
    fillHorizontal: "Rellenar celdas horizontalmente",
    fillVertical: "Rellenar celdas verticalmentemente",
  },
  decimal: ",",
  searchBuilder: {
    add: "Añadir condición",
    button: {
      0: "Constructor de búsqueda",
      _: "Constructor de búsqueda (%d)",
    },
    clearAll: "Borrar todo",
    condition: "Condición",
    conditions: {
      date: {
        after: "Despues",
        before: "Antes",
        between: "Entre",
        empty: "Vacío",
        equals: "Igual a",
        notBetween: "No entre",
        notEmpty: "No Vacio",
        not: "Diferente de",
      },
      number: {
        between: "Entre",
        empty: "Vacio",
        equals: "Igual a",
        gt: "Mayor a",
        gte: "Mayor o igual a",
        lt: "Menor que",
        lte: "Menor o igual que",
        notBetween: "No entre",
        notEmpty: "No vacío",
        not: "Diferente de",
      },
      string: {
        contains: "Contiene",
        empty: "Vacío",
        endsWith: "Termina en",
        equals: "Igual a",
        notEmpty: "No Vacio",
        startsWith: "Empieza con",
        not: "Diferente de",
        notContains: "No Contiene",
        notStarts: "No empieza con",
        notEnds: "No termina con",
      },
      array: {
        not: "Diferente de",
        equals: "Igual",
        empty: "Vacío",
        contains: "Contiene",
        notEmpty: "No Vacío",
        without: "Sin",
      },
    },
    data: "Data",
    deleteTitle: "Eliminar regla de filtrado",
    leftTitle: "Criterios anulados",
    logicAnd: "Y",
    logicOr: "O",
    rightTitle: "Criterios de sangría",
    title: {
      0: "Constructor de búsqueda",
      _: "Constructor de búsqueda (%d)",
    },
    value: "Valor",
  },
  searchPanes: {
    clearMessage: "Borrar todo",
    collapse: {
      0: "Paneles de búsqueda",
      _: "Paneles de búsqueda (%d)",
    },
    count: "{total}",
    countFiltered: "{shown} ({total})",
    emptyPanes: "Sin paneles de búsqueda",
    loadMessage: "Cargando paneles de búsqueda",
    title: "Filtros Activos - %d",
    showMessage: "Mostrar Todo",
    collapseMessage: "Colapsar Todo",
  },
  select: {
    cells: {
      1: "1 celda seleccionada",
      _: "%d celdas seleccionadas",
    },
    columns: {
      1: "1 columna seleccionada",
      _: "%d columnas seleccionadas",
    },
    rows: {
      1: "1 fila seleccionada",
      _: "%d filas seleccionadas",
    },
  },
  thousands: ".",
  datetime: {
    previous: "Anterior",
    next: "Proximo",
    hours: "Horas",
    minutes: "Minutos",
    seconds: "Segundos",
    unknown: "-",
    amPm: ["AM", "PM"],
    months: {
      0: "Enero",
      1: "Febrero",
      10: "Noviembre",
      11: "Diciembre",
      2: "Marzo",
      3: "Abril",
      4: "Mayo",
      5: "Junio",
      6: "Julio",
      7: "Agosto",
      8: "Septiembre",
      9: "Octubre",
    },
    weekdays: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
  },
  editor: {
    close: "Cerrar",
    create: {
      button: "Nuevo",
      title: "Crear Nuevo Registro",
      submit: "Crear",
    },
    edit: {
      button: "Editar",
      title: "Editar Registro",
      submit: "Actualizar",
    },
    remove: {
      button: "Eliminar",
      title: "Eliminar Registro",
      submit: "Eliminar",
      confirm: {
        _: "¿Está seguro que desea eliminar %d filas?",
        1: "¿Está seguro que desea eliminar 1 fila?",
      },
    },
    error: {
      system:
        'Ha ocurrido un error en el sistema (<a target="\\" rel="\\ nofollow" href="\\">Más información&lt;\\/a&gt;).</a>',
    },
    multi: {
      title: "Múltiples Valores",
      info: "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
      restore: "Deshacer Cambios",
      noMulti:
        "Este registro puede ser editado individualmente, pero no como parte de un grupo.",
    },
  },
  info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
  stateRestore: {
    creationModal: {
      button: "Crear",
      name: "Nombre:",
      order: "Clasificación",
      paging: "Paginación",
      search: "Busqueda",
      select: "Seleccionar",
      columns: {
        search: "Búsqueda de Columna",
        visible: "Visibilidad de Columna",
      },
      title: "Crear Nuevo Estado",
      toggleLabel: "Incluir:",
    },
    emptyError: "El nombre no puede estar vacio",
    removeConfirm: "¿Seguro que quiere eliminar este %s?",
    removeError: "Error al eliminar el registro",
    removeJoiner: "y",
    removeSubmit: "Eliminar",
    renameButton: "Cambiar Nombre",
    renameLabel: "Nuevo nombre para %s",
    duplicateError: "Ya existe un Estado con este nombre.",
    emptyStates: "No hay Estados guardados",
    removeTitle: "Remover Estado",
    renameTitle: "Cambiar Nombre Estado",
  },
};
