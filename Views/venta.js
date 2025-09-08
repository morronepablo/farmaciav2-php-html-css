$(document).ready(function () {
  bsCustomFileInput.init();
  Loader();
  //setTimeout(verificar_sesion, 2000);

  verificar_sesion();

  toastr.options = {
    preventDuplicates: true,
  };

  $("#cliente").select2({
    placeholder: "Seleccione un cliente",
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

  obtener_clientes_select().then((respuesta) => {
    let template = ``;
    respuesta.forEach((cliente) => {
      template += `<option value="${cliente.id}">${cliente.nombre}</option>`;
    });
    $("#cliente").html(template);
    $("#cliente").val("").trigger("change.select2");
  });

  async function obtener_clientes_select() {
    let funcion = "obtener_clientes_select";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/ClienteController.php", {
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
          $("#vendedor").text(`${usuario.nombre} ${usuario.apellido}`);
          llenar_menu_superior(usuario);
          llenar_menu_lateral(usuario);
          obtener_productos_carrito();
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

  $(document).on("change", "#cliente", function () {
    let cliente = $("#cliente").val();
    obtener_cliente(cliente).then((respuesta) => {
      if (respuesta.mensaje == "success") {
        let cliente = respuesta.data;
        $("#avatar_cliente").attr(
          "src",
          "/farmaciav2/Util/img/" + cliente.avatar
        );
        $("#nombre_cliente").text(cliente.nombre);
        $("#apellido_cliente").text(cliente.apellido);
        $("#dni_cliente").text("DNI: " + cliente.dni);
        $("#sexo_cliente").text("Sexo: " + cliente.sexo);
        $("#telefono_cliente").text("Teléfono: " + cliente.telefono);
        $("#correo_cliente").text("Email: " + cliente.correo);
        $("#edad_cliente").text("Nac.: " + cliente.edad);
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

  async function obtener_cliente(id) {
    let funcion = "obtener_cliente";
    let respuesta = "";
    let data = await fetch("/farmaciav2/Controllers/ClienteController.php", {
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

  var total_bruto = 0;
  var total_bruto_formateado = "";

  function obtener_productos_carrito() {
    total_bruto = 0;
    total_bruto_formateado = "";
    Contar_productos();
    let productos = RecuperarLS();
    let template = ``;
    productos.forEach((producto) => {
      // Usamos la función formatNumber que acabamos de crear
      const precioFormateado = "$ " + formatNumber(producto.precio);
      let subtotal = Number(producto.precio) * Number(producto.cantidad);
      total_bruto += subtotal;
      const subtotalFormateado = "$ " + formatNumber(subtotal);
      total_bruto_formateado = "$ " + formatNumber(total_bruto);
      template += `
      <tr>
        <td>
          ${producto.nombre}
          <span laboratorio="${producto.laboratorio}" 
            presentacion="${producto.presentacion}" 
            concentracion="${producto.concentracion}" 
            tipo="${producto.tipo}" 
            subtipo="${producto.subtipo}" 
            title="Mas información" class="mas_info h4 text-warning"><i class="fas fa-info-circle"></i>
          </span>
        </td>
        <td class="text-right">${precioFormateado}</td>
        <td>
          <input type="number" id="${producto.id}" stock="${producto.stock}" nombre="${producto.nombre}" cantidad="${producto.cantidad}" class="cantidad form-control text-right" value="${producto.cantidad}">
        </td>
        <td class="text-right">${subtotalFormateado}</td>
        <td><button type="button" id="${producto.id}" nombre="${producto.nombre}" class="borrar_producto btn btn-outline-danger btn-circle"><i class="fas fa-times"></i></button></td>
      </tr>
      `;
    });
    // console.log(total_bruto_formateado);

    $("#productos_carrito").html(template);
    calcular_cantidades();
  }

  function calcular_cantidades() {
    if (descuento_global != 0) {
      total_bruto = total_bruto - descuento_global;
    }
    let grabada = 0;
    let total_iva = 0;
    let total_cambio = 0;
    let total_cambioFormateado = "---";
    grabada = total_bruto / 1.21;
    grabada = Number(grabada.toFixed(2));
    const grabadaFormateado = "$ " + formatNumber(grabada);
    total_iva = total_bruto - grabada;
    total_iva = Number(total_iva.toFixed(2));
    const total_ivaFormateado = "$ " + formatNumber(total_iva);
    const total_bruto_formateado = "$ " + formatNumber(total_bruto);
    $("#grabada").text(grabadaFormateado);
    $("#iva").text(total_ivaFormateado);
    $("#total").text(total_bruto_formateado);
    // total_cambio = total_bruto;
    if (recibe_global != 0) {
      total_cambio = recibe_global - total_bruto;
      total_cambioFormateado = "$ " + formatNumber(total_cambio);
    }
    $("#cambio").text(total_cambioFormateado);
  }

  var descuento_global = 0;

  $(document).on("change", "#descuento", function () {
    let descuento = $("#descuento").val();
    if (descuento >= 0 && descuento != "") {
      if (descuento <= total_bruto) {
        descuento_global = descuento;
      } else {
        toastr.error("El descuento no puede ser mayor al total", "Error!", {
          timeOut: 2000,
        });
        $("#descuento").val(0);
        descuento_global = 0;
      }
    } else {
      toastr.error("El descuento no puede ser menor que 0", "Error!", {
        timeOut: 2000,
      });
      $("#descuento").val(0);
      descuento_global = 0;
    }
    obtener_productos_carrito();
  });

  var recibe_global = 0;

  $(document).on("change", "#recibe", function () {
    let recibe = $("#recibe").val();
    if (recibe >= 0 && recibe != "") {
      if (recibe >= total_bruto) {
        recibe_global = recibe;
      } else {
        toastr.error(
          "No se puede recibir menor dinero que el total",
          "Error!",
          {
            timeOut: 2000,
          }
        );
        $("#recibe").val(0);
        recibe_global = 0;
      }
    } else {
      toastr.error("No se puede recibir dinero menor que 0", "Error!", {
        timeOut: 2000,
      });
      $("#recibe").val(0);
      recibe_global = 0;
    }
    obtener_productos_carrito();
  });

  $(document).on("click", ".mas_info", function () {
    let elemento = $(this)[0];
    let laboratorio = $(elemento).attr("laboratorio");
    let presentacion = $(elemento).attr("presentacion");
    let concentracion = $(elemento).attr("concentracion");
    let tipo = $(elemento).attr("tipo");
    let subtipo = $(elemento).attr("subtipo");
    toastr.info(
      `
      <i class="fas fa-lg fa-mortar-pestle"></i> Concentración: ${concentracion}<br>
      <i class="fas fa-lg fa-flask"></i> Laboratorio: ${laboratorio}<br>
      <i class="fas fa-lg fa-prescription-bottle-alt"></i> Tipo: ${tipo}<br>
      <i class="fas fa-lg fa-prescription-bottle-alt"></i> Subtipo: ${subtipo}<br>
      <i class="fas fa-lg fa-pills"></i> Presentación: ${presentacion}<br>
      `,
      "Info!",
      {
        timeOut: 2000,
      }
    );
  });

  $(document).on("change", ".cantidad", function () {
    let elemento = $(this)[0];
    let cantidad = Number($(elemento).val());
    let id = $(elemento).attr("id");
    let stock = Number($(elemento).attr("stock"));
    let cantidad_validar = Number($(elemento).attr("cantidad"));
    if (cantidad > 0) {
      if (cantidad <= stock) {
        let productos = RecuperarLS();
        productos.forEach((prod) => {
          if (prod.id === id) {
            prod.cantidad = cantidad;
          }
        });
        localStorage.setItem("productos", JSON.stringify(productos));
        $(elemento).attr("cantidad", cantidad);
      } else {
        toastr.error("La cantidad supera el stock del producto", "Error!", {
          timeOut: 2000,
        });
        $(elemento).attr("cantidad", cantidad_validar);
        $(elemento).val(cantidad_validar).trigger("change"); // trigger hace que el evento sea recursivo
      }
    } else {
      toastr.error("No se permite cantidad 0 o negativa", "Error!", {
        timeOut: 2000,
      });
      $(elemento).attr("cantidad", cantidad_validar);
      $(elemento).val(cantidad_validar).trigger("change"); // trigger hace que el evento sea recursivo
    }
    $("#descuento").val(0);
    descuento_global = 0;
    $("#recibe").val(0);
    recibe_global = 0;
    obtener_productos_carrito();
  });

  $(document).on("click", ".borrar_producto", function () {
    let elemento = $(this)[0];
    let id = $(elemento).attr("id");
    let nombre = $(elemento).attr("nombre");
    Eliminar_producto_LS(id);
    toastr.success(
      "El producto " + nombre + " fué eliminado del carrito!",
      "Éxito!",
      {
        timeOut: 2500,
      }
    );
    $("#descuento").val(0);
    descuento_global = 0;
    $("#recibe").val(0);
    recibe_global = 0;
    Eliminar_producto_LS(id);
    obtener_productos_carrito();
  });

  $(document).on("click", "#generar_venta", function () {
    let cliente = $("#cliente").val();
    let comprobante = $("#comprobante").val();
    let bandera = 0;
    if (cliente == null) {
      bandera++;
      toastr.error("Es necesario ingresar un cliente", "Error!", {
        timeOut: 2500,
      });
    }
    if (comprobante == null) {
      bandera++;
      toastr.error(
        "Es necesario ingresar un el tipo de comprobante",
        "Error!",
        {
          timeOut: 2500,
        }
      );
    }
    if (bandera == 0) {
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger mr-1",
        },
        buttonsStyling: false,
      });
      swalWithBootstrapButtons
        .fire({
          title: "Desea realizar la venta?",
          text: "Revise muy bien los datos antes de continuar!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonText: "Si",
          cancelButtonText: "No",
          reverseButtons: true,
        })
        .then((result) => {
          if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
              title: "Se realizó la venta!",
              text: "La venta se ha registrado con exito, puede verla en Listar ventas",
              icon: "success",
            });
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire({
              title: "Cancelado",
              text: "La venta no se ha registrado",
              icon: "error",
            });
          }
        });
    }
  });

  function Eliminar_producto_LS(id) {
    let productos;
    productos = RecuperarLS();
    productos.forEach(function (producto, indice) {
      if (producto.id === id) {
        productos.splice(indice, 1);
      }
    });
    localStorage.setItem("productos", JSON.stringify(productos));
  }

  function RecuperarLS() {
    let productos;
    if (localStorage.getItem("productos") === null) {
      productos = [];
    } else {
      productos = JSON.parse(localStorage.getItem("productos"));
    }
    return productos;
  }

  function Contar_productos() {
    let productos = RecuperarLS();
    if (productos.length == 0) {
      location.href = "/farmaciav2/";
    }
    $("#contador_venta").html(productos.length);
  }

  function formatNumber(
    number,
    decimals = 2,
    dec_point = ",",
    thousands_sep = "."
  ) {
    number = (number + "").replace(/[^0-9+\-Ee.]/g, "");
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
      dec = typeof dec_point === "undefined" ? "." : dec_point,
      s = "",
      toFixedFix = function (n, prec) {
        var k = Math.pow(10, prec);
        return "" + Math.round(n * k) / k;
      };
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
      s[1] = s[1] || "";
      s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
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
