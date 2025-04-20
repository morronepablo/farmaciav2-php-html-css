$(document).ready(function () {
  bsCustomFileInput.init();
  Loader();
  //setTimeout(verificar_sesion, 2000);

  verificar_sesion();

  toastr.options = {
    preventDuplicates: true,
  };

  $("#proveedor").select2({
    placeholder: "Seleccione un proveedor",
    language: {
      noResult: function () {
        return "No hay resultados.";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });

  $("#comprobante").select2({
    placeholder: "Seleccione un comprobante",
    language: {
      noResult: function () {
        return "No hay resultados.";
      },
      searching: function () {
        return "Buscando...";
      },
    },
  });

  obtener_comprobantes().then((respuesta) => {
    // console.log(respuesta);
    let template = "";
    respuesta.forEach((comprobante) => {
      template += `<option value="${comprobante.id}">${comprobante.nombre}</option>`;
    });
    $("#comprobante").html(template);
    $("#comprobante").val("").trigger("change");
  });

  async function obtener_comprobantes() {
    let funcion = "obtener_comprobantes";
    let respuesta = "";
    let data = await fetch(
      "/farmaciav2/Controllers/ComprobanteController.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "funcion=" + funcion,
      }
    );
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

  obtener_proveedores().then((respuesta) => {
    let template = "";
    respuesta.forEach((proveedor) => {
      if (proveedor.estado == "A") {
        template += `<option value="${proveedor.id}">${proveedor.nombre}</option>`;
      }
    });
    $("#proveedor").html(template);
    $("#proveedor").val("").trigger("change");
  });

  async function obtener_proveedores() {
    let funcion = "obtener_proveedores";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/ProveedorController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
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
                    <a href="/farmaciav2/Views/proveedores.php" class="nav-link">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>
                            Gestión proveedor
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/farmaciav2/Views/compras.php" class="active nav-link">
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
          obtener_compras();
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

  async function obtener_compras() {
    let funcion = "obtener_compras";
    let data = await fetch("/farmaciav2/Controllers/CompraController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let compras = JSON.parse(response);
        console.log(compras);

        $("#compras").DataTable({
          data: compras,
          aaSorting: [],
          searching: true,
          scrollX: false,
          autoWidth: false,
          columns: [
            {
              render: function (data, type, datos, meta) {
                let estado = `<span class="badge badge-warning">Crédito</span>`;
                if (datos.estado == "Contado") {
                  estado = `<span class="badge badge-success">Contado</span>`;
                }
                if (datos.estado == "Pagado") {
                  estado = `<span class="badge badge-info">Pagado</span>`;
                }
                let template = "";
                template += `
                                <div class="card card-widget widget-user-2">
                                    <div class="widget-user-header bg-white d-flex" >
                                        <div>
                                            <h3 class="widget-user-username" style="margin: 0 20px;"><strong>Código :</strong>${datos.codigo} ${estado}</h3>
                                            <h5 class="widget-user-desc mt-3">
                                              <strong>Nota: </strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${datos.nota}</span><br>
                                              <strong>Creación: </strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${datos.fecha_creacion}</span><br>`;
                if (datos.estado == "Crédito") {
                  template += `<strong>Vencimiento: </strong><span>${datos.fecha_vencimiento}</span><br>`;
                }
                template += `<strong>Total: </strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$&nbsp;${formatNumber(
                  Number(datos.total).toFixed(2)
                )}</span><br>
                            <strong>Comprobante: </strong><span>&nbsp;&nbsp;${
                              datos.comprobante
                            }</span><br>
                            <strong>Proveedor: </strong><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;${
                              datos.proveedor
                            }</span><br>
                            </h5>
                                            `;
                template += `</div>
                                    </div>
                                    <div class="card-footer p-0">
                                        <ul class="nav flex-column text-right">
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">`;
                if (datos.estado == "Crédito") {
                  template += ` 
                  <span style="margin-right: 5px;">
                    <button 
                        class="btn btn-outline-success btn-circle btn-lg pagar" 
                        id="${datos.id}"
                        codigo="${datos.codigo}"
                    >
                      <i class="fas fa-hand-holding-usd"></i>
                    </button>
                  </span>`;
                }
                template += `<span style="margin-right: 5px;">
                              <button 
                                  class="btn btn-outline-info btn-circle btn-lg ver_detalle" 
                                  id="${datos.id}"
                                  codigo="${datos.codigo}"
                                  total="${datos.total}"
                                  fecha_creacion="${datos.fecha_creacion}"
                                  data-toggle="modal"
                                  data-target="#ver_detalle"
                              >
                                <i class="fas fa-search"></i>
                              </button>
                            </span>
                            <span style="margin-right: 5px;">
                              <button 
                                  class="btn btn-outline-primary btn-circle btn-lg editar" 
                                  id="${datos.id}"
                                  codigo="${datos.codigo}"
                                  nota="${datos.nota}"
                                  comprobante_id="${datos.comprobante_id}"
                                  id_proveedor="${datos.id_proveedor}"
                                  pedido_id="${datos.pedido_id}"
                                  data-toggle="modal"
                                  data-target="#editar"
                              >
                                <i class="fas fa-pencil-alt"></i>
                              </button>
                            </span>
                            <span style="margin-right: 5px;">
                              <button 
                                  class="btn btn-outline-danger btn-circle btn-lg eliminar" 
                                  id="${datos.id}"
                                  codigo="${datos.codigo}"
                                  pedido_id="${datos.pedido_id}"
                              >
                                <i class="fas fa-trash"></i>
                              </button>
                            </span>
                            </a>
                          </li>
                      </ul>
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

  $(document).on("click", ".pagar", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let codigo = $(elemento).attr("codigo");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success ml-2",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: `Desea pagar la compra ${codigo} ?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, pagar !",
        cancelButtonText: "No, cancelar !",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          pagar(id).then((respuesta) => {
            if (respuesta.mensaje == "success") {
              obtener_compras();
              swalWithBootstrapButtons.fire(
                "Pagada!",
                "La compra " + codigo + " fue pagada correctamente",
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
            "canceló el pago de la compra",
            "error"
          );
        }
      });
  });

  async function pagar(id) {
    let funcion = "pagar";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/CompraController.php", {
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

  $(document).on("click", ".eliminar", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let codigo = $(elemento).attr("codigo");
    let pedido_id = $(elemento).attr("pedido_id");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success ml-2",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
    });

    swalWithBootstrapButtons
      .fire({
        title: `Desea eliminar la compra ${codigo} ?`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar !",
        cancelButtonText: "No, cancelar !",
        reverseButtons: true,
      })
      .then((result) => {
        if (result.isConfirmed) {
          eliminar(id, pedido_id).then((respuesta) => {
            if (respuesta.mensaje == "success") {
              obtener_compras();
              swalWithBootstrapButtons.fire(
                "Eliminada!",
                "La compra " + codigo + " fue eliminada correctamente",
                "success"
              );
            } else if (respuesta.mensaje == "error_compra") {
              toastr.error(
                "No se pudo eliminar la compra, debido ha que hoy productos de esta compra que ya fueron ingresados en una venta",
                "Error!",
                { timeOut: 2000 }
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
            "canceló la eliminación de la compra",
            "error"
          );
        }
      });
  });

  async function eliminar(id, pedido_id) {
    let funcion = "eliminar";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/CompraController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion + "&&id=" + id + "&&pedido_id=" + pedido_id,
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

  $(document).on("click", ".ver_detalle", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let codigo = $(elemento).attr("codigo");
    let fecha_creacion = $(elemento).attr("fecha_creacion");
    let total = $(elemento).attr("total");

    // Parsear la fecha y formatearla
    let fecha = new Date(fecha_creacion);
    let dia = fecha.getDate().toString().padStart(2, "0");
    let mes = (fecha.getMonth() + 1).toString().padStart(2, "0"); // Los meses son de 0 a 11
    let año = fecha.getFullYear();
    let fechaFormateada = `${dia}/${mes}/${año}`;

    $("#codigo_detalle").text(codigo);
    $("#fecha_detalle").text(fechaFormateada);
    ver_detalle(id).then((respuesta) => {
      if (respuesta.mensaje == "success") {
        let productos = respuesta.data;
        // console.log(productos);

        let html = "";
        productos.forEach((producto) => {
          html += `
            <tr>
              <td>
                <strong>Nombre: </strong><span>${producto.producto}</span><br>
                <strong>Concentración: </strong><span>${
                  producto.concentracion
                }</span><br>
                <strong>Laboratorio: </strong><span>${
                  producto.laboratorio
                }</span><br>
                <strong>Subtipo: </strong><span>${producto.subtipo}</span><br>
                <strong>Presentación: </strong><span>${
                  producto.presentacion
                }</span><br>
                <strong>Lote: </strong><span>${producto.lote}</span><br>
                <strong>Vencimiento: </strong><span>${
                  producto.fecha_vencimiento
                }</span><br>
              </td>
              <td class="text-right">${formatNumber(
                Number(producto.cantidad).toFixed(2)
              )}</td>
              <td class="text-right">$ ${formatNumber(
                Number(producto.precio_compra).toFixed(2)
              )}</td>
              <td class="text-right">$ ${formatNumber(
                (
                  Number(producto.cantidad) * Number(producto.precio_compra)
                ).toFixed(2)
              )}</td>
            </tr>
          `;
        });
        html += `
          <tr>
            <td colspan="4" class="text-right"><strong>Total: </strong>$ ${formatNumber(
              Number(total).toFixed(2)
            )}</td>
          </tr>
        `;
        $("#detalles").html(html);
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
  });

  function formatNumber(num) {
    num = num.toString().replace(".", ","); // Reemplaza el punto decimal con una coma
    let parts = num.split(","); // Divide en parte entera y decimal
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, "."); // Formatea la parte entera con puntos
    return parts.join(","); // Une de nuevo las partes
  }

  async function ver_detalle(id) {
    let funcion = "ver_detalle";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/MovimientoController.php", {
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

  $(document).on("click", ".editar", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let codigo = $(elemento).attr("codigo");
    let nota = $(elemento).attr("nota");
    let comprobante_id = $(elemento).attr("comprobante_id");
    let id_proveedor = $(elemento).attr("id_proveedor");
    let pedido_id = $(elemento).attr("pedido_id");
    $("#id_compra").val(id);
    $("#pedido_id").val(pedido_id);
    $("#codigo").val(codigo);
    $("#nota").val(nota);
    $("#comprobante").val(comprobante_id).trigger("change");
    $("#proveedor").val(id_proveedor).trigger("change");
  });

  $("#form-editar").submit(function (e) {
    let datos = new FormData($("#form-editar")[0]);
    let funcion = "editar";
    datos.append("funcion", funcion);
    editar(datos).then((respuesta) => {
      if (respuesta.mensaje == "success") {
        obtener_compras();
        $("#comprobante").val("").trigger("change");
        $("#proveedor").val("").trigger("change");
        $("#form-editar").trigger("reset");
        $("#editar").modal("hide");
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
    e.preventDefault();
  });

  async function editar(datos) {
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/CompraController.php", {
      method: "POST",
      // headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: datos,
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
