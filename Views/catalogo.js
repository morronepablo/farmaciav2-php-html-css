$(document).ready(function () {
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
                    <a href="/farmaciav2/Views/adm_venta.php" class="nav-link">
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
        let respuesta = JSON.parse(response);
        if (respuesta.length != 0) {
          llenar_menu_superior(respuesta);
          llenar_menu_lateral(respuesta);
          $("#carrito").show();
          Contar_productos();
          obtener_productos();
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

  async function obtener_productos() {
    let funcion = "obtener_productos";
    let data = await fetch("/farmaciav2/Controllers/ProductoController.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "funcion=" + funcion,
    });
    if (data.ok) {
      let response = await data.text();
      try {
        let productos = JSON.parse(response);
        $("#productos").DataTable({
          data: productos,
          aaSorting: [],
          searching: true,
          scrollX: true,
          autoWidth: false,
          columns: [
            {
              render: function (data, type, datos, meta) {
                console.log(datos);

                let stock = "";
                if (datos.stock == null || datos.stock == "") {
                  stock = "Sin Stock";
                } else {
                  stock = datos.stock;
                }
                let reg_sanitario = "";
                if (
                  datos.registro_sanitario == null ||
                  datos.registro_sanitario == ""
                ) {
                  reg_sanitario = "Sin Registro Sanitario";
                } else {
                  reg_sanitario = datos.registro_sanitario;
                }
                let template = `
                                <div class="">
                                    <div class="card bg-light">
                                        <div class="h5 card-header text-muted border-bottom-0">
                                            <i class="fas fa-lg fa-cubes mr-1"></i>${stock}
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <h4 class=""><b>${datos.nombre}</b></h4>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-barcode"></i></span> Código: ${datos.codigo}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-coins"></i></span> Precio: ${datos.precio}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${datos.concentracion}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${datos.adicional}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4">
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${datos.laboratorio}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${datos.tipo}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${datos.presentacion}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Fracciones: ${datos.fracciones}</li>
                                                        <li class="h8"><span class="fa-li"><i class="fas fa-lg fa-angle-double-right"></i></span> Reg. Sanitario: ${reg_sanitario}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <img src="/farmaciav2/Util/img/productos/${datos.avatar}"  alt="" class="img-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">`;
                if (datos.stock != 0) {
                  template += `<button id="${datos.id}" 
                                                  codigo="${datos.codigo}"
                                                  nombre="${datos.nombre}"
                                                  concentracion="${datos.concentracion}"
                                                  adicional="${datos.adicional}"
                                                  laboratorio="${datos.laboratorio}"
                                                  presentacion="${datos.presentacion}"
                                                  tipo="${datos.tipo}"
                                                  stock="${datos.stock}"
                                                  precio="${datos.precio}"
                                                  class="agregar-carrito btn btn-sm bg-gradient-primary"
                                          >
                                              <i class="fas fa-plus mr-1"></i>Agregar al carrito
                                          </button>`;
                }
                template += `</div>
                                        </div>
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

  $(document).on("click", ".agregar-carrito", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let codigo = $(elemento).attr("codigo");
    let nombre = $(elemento).attr("nombre");
    let concentracion = $(elemento).attr("concentracion");
    let adicional = $(elemento).attr("adicional");
    let laboratorio = $(elemento).attr("laboratorio");
    let presentacion = $(elemento).attr("presentacion");
    let tipo = $(elemento).attr("tipo");
    let stock = $(elemento).attr("stock");
    let precio = $(elemento).attr("precio");
    if (stock != "null") {
      let producto = {
        id: id,
        nombre: nombre,
        concentracion: concentracion,
        adicional: adicional,
        precio: precio,
        laboratorio: laboratorio,
        tipo: tipo,
        presentacion: presentacion,
        stock: stock,
        cantidad: 1,
      };
      let bandera = false;
      let productos = RecuperarLS();
      productos.forEach((prod) => {
        if (prod.id === producto.id) {
          bandera = true;
        }
      });
      if (bandera) {
        toastr.error(
          "El producto " + nombre + " # " + codigo + " ya fué agregado",
          "Error!",
          { timeOut: 2000 }
        );
      } else {
        AgregarLS(producto);
        Contar_productos();
        toastr.success(
          "Producto " + nombre + " # " + codigo + " agregado",
          "Exito!",
          { timeOut: 2000 }
        );
      }
    } else {
      toastr.warning(
        "El producto " + nombre + " # " + codigo + " no tiene stock",
        "No se pudo agregar!",
        { timeOut: 2000 }
      );
    }
  });

  function abrir_carrito() {
    let productos = RecuperarLS();
    if (productos.length != 0) {
      $("#abrir_carrito").modal("show");
      $("#carrito_compras").DataTable({
        data: productos,
        aaSorting: [],
        searching: true,
        scrollX: false,
        autoWidth: false,
        paging: false,
        bInfo: false,
        columns: [
          {
            render: function (data, type, datos, meta) {
              /*
              let template = `
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <ul class="ml-4 mb-0 fa-ul">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-heading"></i></span> Nombre: ${datos.nombre}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentración: ${datos.concentracion}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${datos.adicional}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-5 mt-1">
                                            <ul class="ml-4 mb-0 fa-ul">
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratorio: ${datos.laboratorio}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${datos.tipo}</li>
                                                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Presentación: ${datos.presentacion}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2 mt-1 text-center">
                                            <button 
                                                id="${datos.id}" 
                                                nombre="${datos.nombre}"
                                                type="button" 
                                                class="borrar_producto btn btn-outline-danger btn-circle btn-lg mt-3"
                                            >
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                            */
              let template = `
                <div class="card bg-secondary">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-5">
                        <span class="text-warning"><i class="fas fa-lg fa-pills"></i></span> ${datos.nombre}
                        <div className="form-group">
                        <label class="text-warning">Cantidad:</label>
                        <input type="number" value="${datos.cantidad}" class="form-control" />
                        </div>
                      </div>
                      <div class="col-md-5 text-center">
                        <span class="text-warning"><i class="fas fa-lg fa-mortar-pestle"></i></span> ${datos.concentracion}
                        <span title="Mas información" class="mas_info h4 text-warning"><i class="fas fa-info-circle"></i></span>
                      </div>
                      <div class="col-md-2 text-center">
                        <button id="${datos.id}" nombre="${datos.nombre}" type="button" class="borrar_producto btn btn-outline-danger btn-circle btn-lg mt-3">
                          <i class="fas fa-times"></i>
                        </button>
                      </div>
                    </div>
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
    } else {
      toastr.warning("El carrito está vacio", "No se pudo abrir!", {
        timeOut: 2000,
      });
      $("#abrir_carrito").modal("hide");
    }
  }

  $(document).on("click", "#carrito", (e) => {
    abrir_carrito();
  });

  $(document).on("click", ".vaciar_carrito", (e) => {
    EliminarLS();
    toastr.success("El carrito fué vaciado", "Éxito!", { timeOut: 2000 });
    Contar_productos();
    $("#abrir_carrito").modal("hide");
  });

  $(document).on("click", ".borrar_producto", (e) => {
    let elemento = $(this)[0].activeElement;
    let id = $(elemento).attr("id");
    let nombre = $(elemento).attr("nombre");
    toastr.success(
      "El producto " + nombre + " fué eliminado del carrito!",
      "Éxito!",
      { timeOut: 2000 }
    );
    Eliminar_producto_LS(id);
    Contar_productos();
    abrir_carrito();
  });

  function RecuperarLS() {
    let productos;
    if (localStorage.getItem("productos") === null) {
      productos = [];
    } else {
      productos = JSON.parse(localStorage.getItem("productos"));
    }
    return productos;
  }

  function AgregarLS(producto) {
    let productos;
    productos = RecuperarLS();
    productos.push(producto);
    localStorage.setItem("productos", JSON.stringify(productos));
  }

  function Contar_productos() {
    let productos;
    let contador = 0;
    productos = RecuperarLS();
    productos.forEach((producto) => {
      contador++;
    });
    if (contador == 0) {
      $("#contador").html("");
    } else {
      $("#contador").html(contador);
    }
  }

  function EliminarLS() {
    localStorage.clear();
  }

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
