var parametros = "";
function registrarVenta() {

  var parametros = {
    accion: "registrarVenta",
    factura: document.getElementById("facturaVenta").value,
    cliente: document.getElementById("listaCliente").value,
    servicio: document.getElementById("listaServicio").value,
    empleado: document.getElementById("listaEmpleado").value,
    insumo: document.getElementById("listaInsumo").value,
    cantidad: document.getElementById("cantidadAgregar").value,
    valor: document.getElementById("v_unitario").value,
    total: document.getElementById("totalVenta").innerHTML,
    descriptionSale: document.getElementById("descriptionSale").value,
    dateRegistration: document.getElementById("dateRegistration").value,
    arreglo: ArregloInsumosAgregarVenta,
  };


  if (document.getElementById("facturaVenta").value == "" || document.getElementById("listaCliente").value == "" ||
    document.getElementById("listaServicio").value == "" || document.getElementById("listaEmpleado").value == "" ||
    document.getElementById("listaInsumo").value == "" || document.getElementById("cantidadAgregar").value == "" ||
    document.getElementById("v_unitario").value == "" || document.getElementById("descriptionSale").value == "") 
    {
      Swal.fire({
        position: "center",
        icon: "warning",
        title: "¡Los campos son obligatorios!",
      });
    }else if(document.getElementById("facturaVenta").value < 1) {
      Swal.fire({
          position: "center",
          icon: "warning",
          title: "Los valores del número de factura no pueden ser negativos",
      });
    }
    else {
    $.ajax({
      data: parametros,
      url: '../view/http/ventas.controller.php',
      type: 'post',
      beforeSend: function () {

      },

      success: function (data) {
        console.log(data);
        if (JSON.parse(data) == "ok") {
          Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: '',
            heightAuto: false,
            confirmButtonText: "Aceptar",
          })
          listar();
          limpiar();
        }
        else if (JSON.parse(data) == "error") {
          Swal.fire({
              position: "center",
              icon: "warning",
              title: "Hay un error",
              showConfirmButton: false,
              timer: 1500,
          });
          listar();
          ocultar();
      }
      },
      error: function (error) {
        console.log("No se ha podido obtener la información " + error);
      },
    });
  }
}

function limpiar() {
  $('#registrarVenta').modal('hide');
  $('body').removeClass('modal-open');
  $('.modal-backdrop').remove();
  setTimeout(function () {
    location.href = "ventas.php";
  }, 1500);
}

function calcularValorTotal() {
  document.getElementById("v_total").value =
    document.getElementById("cantidadAgregar").value *
    document.getElementById("v_unitario").value;
}


let ArregloInsumosAgregarVenta = Array();
let valorTotalProVenta = 0;

//Agregar insumo
function agregarInsumo() {
  let selectorInsumo = document.getElementById("listaInsumo");

  if (document.getElementById("listaInsumo").value == "" ||
    document.getElementById("cantidadAgregar").value == "" ||
    document.getElementById("v_unitario").value == "" ||
    document.getElementById("v_total").value == "") {
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "¡Los campos son obligatorios!",
    });

  } else if (document.getElementById("cantidadAgregar").value < 1) {
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "La cantidad ingresada no puede ser negativa",
    });
  } else if (document.getElementById("v_unitario").value < 1) {
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "El valor ingresado no puede ser negativo",
    });
  } else {
    $.ajax({
      data: {
        accion: "validar_stock",
        id_insumo: document.getElementById("listaInsumo").value,
        cantidad: document.getElementById("cantidadAgregar").value,
      },
      url: "../view/http/ventas.controller.php",
      type: "post",
      beforeSend: function () {
        //mostrar_loading();
      },
      success: function (data) {
        let response = JSON.parse(data);
        if (response == "sin_stock") {
          Swal.fire({
            position: "center",
            icon: "warning",
            title: "No hay stock suficiente",
          });
          return;
        }
        if (response == "disponible") {
          var insumoAgregado = {
            insumoId: document.getElementById("listaInsumo").value,
            nombreInsumo: selectorInsumo.options[selectorInsumo.selectedIndex].text,
            cantidad: document.getElementById("cantidadAgregar").value,
            valorUnitario: document.getElementById("v_unitario").value,
            valorTotal: document.getElementById("v_total").value,
          };
          ArregloInsumosAgregarVenta.push(insumoAgregado);
          //Formato de valor a dolar
          valorTotalProVenta = valorTotalProVenta + parseInt(document.getElementById("v_total").value);
          document.getElementById("totalVenta").innerHTML = valorTotalProVenta;
          listarInsumos();
        }
      },
      error: function (error) {
        console.log("No se ha podido obtener la información " + error);
      },
    });
  }

}

function ajaxMain(accion, url, nombreSelect) {
  var parametros = {
    accion: accion,
  };

  $.ajax({
    data: parametros,
    url: url,
    type: "post",
    beforeSend: function () {
      //mostrar_loading();
    },
    success: function (data) {
      if (accion == "listaCliente") {
        loadingSelect(data, nombreSelect);
      }
      if (accion == "listaInsumo") {
        loadingSelect(data, nombreSelect);
      }
      if (accion == "listaServicio") {
        loadingSelect(data, nombreSelect);
      }
      if (accion == "listaEmpleado") {
        loadingSelect(data, nombreSelect);
      }else if(JSON.parse(data) == "stock"){
        Swal.fire({
          position: "center",
          icon: "warning",
          title: "No hay stock suficiente",
      });
      return;
      }
    },
    error: function (error) {
      console.log("No se ha podido obtener la información " + error);
    },
  });
}


function loadingSelect(data, nombreSelect) {
  for (var i in JSON.parse(data).registros) {
    var select = document.getElementById(nombreSelect);
    let option = document.createElement("option");
    option.setAttribute("value", JSON.parse(data).registros[i].id);
    option.innerHTML = "" + JSON.parse(data).registros[i].nombre;

    select.appendChild(option);
  }
}

function selectListaCliente() {
  ajaxMain(
    "listaCliente",
    '../view/http/ventas.controller.php',
    "listaCliente"
  );
  setTimeout(() => {
    selectListaCliente();
  }, 200);
}

function selectListaServicio() {
  ajaxMain(
    "listaServicio",
    '../view/http/ventas.controller.php',
    "listaServicio"
  );
  setTimeout(() => {
    selectListaServicio();
  }, 200);
}

function selectListaEmpleado() {
  ajaxMain(
    "listaEmpleado",
    '../view/http/ventas.controller.php',
    "listaEmpleado"
  );
  setTimeout(() => {
    selectListaEmpleado();
  }, 200);
}

function selectListaInsumo() {
  ajaxMain("listaInsumos", "../view/http/ventas.controller.php'", "listaInsumos");
  cerrarAlert();
}


//Listar insumos agregados

function listarInsumos() {
  eliminarFilasTableInsumo();

  var tableVentas = $("#tableVentas").DataTable();
  tableVentas.clear();
  tableVentas.destroy();

  var parametros = {
    accion: "select_ListSupplys",
  };

  for (var i in ArregloInsumosAgregarVenta) {
    agregarFilaInsumo(
      ArregloInsumosAgregarVenta[i].insumoId,
      ArregloInsumosAgregarVenta[i].nombreInsumo,
      ArregloInsumosAgregarVenta[i].cantidad,
      ArregloInsumosAgregarVenta[i].valorUnitario,
      ArregloInsumosAgregarVenta[i].valorTotal
    );
  }
}

function eliminarFilasTableInsumo() {
  var n = 0;
  $("#tableVentas tbody tr").each(function () {
    n++;
  });
  for (i = n - 1; i > 1; i--) {
    $("#tableVentas tbody tr:eq('" + i + "')").remove();

  }
}


//Arreglo para enlistar insumos agregados
function agregarFilaInsumo(
  insumoId,
  nombreInsumo,
  cantidad,
  valorUnitario,
  valorTotal,
  accion
) {
  var htmlTags = `<tr>
    <td>${insumoId}</td>
    <td>${nombreInsumo}</td>
    <td>${cantidad}</td>
    <td>${valorUnitario}</td>
    <td>${valorTotal}</td>
    <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarInsumo(${insumoId})">x</button></td>
    </tr>`;

  $("#tableVentas tbody").append(htmlTags);
}


function eliminarInsumo(insumoId) {
  for (let i = 0; i < ArregloInsumosAgregarVenta.length; i++) {
    if (ArregloInsumosAgregarVenta[i].insumoId == insumoId) {
      ArregloInsumosAgregarVenta.splice(ArregloInsumosAgregarVenta[i], 1);
    }
  }
  listarInsumos();
}


//Listar ventas.
function listarVentas() {
  eliminarFilasTableVentas();

  var tableVentas = $("#tableVentas").DataTable();

  tableVentas.clear();
  tableVentas.destroy();

  var parametros = {
    accion: "select_listVentas",
  };

  $.ajax({
    data: parametros,
    url: "../view/http/ventas.controller.php",
    type: "post",
    beforeSend: function () {

    },

    success: function (data) {

      for (var i in JSON.parse(data).registros) {

        agregarFila_Ventas(
          JSON.parse(data).registros[i].idFactura,
          JSON.parse(data).registros[i].total,
          JSON.parse(data).registros[i].stateSale,
          ""
        );
      }

      $("#tableVentas").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
        order: [[1, "desc"]],

      });
    },

    error: function () {
      console.log("No se ha podido obtener la información");
    },
  });

}

function eliminarFilasTableVentas() {
  var n = 0;
  $("#tableVentas tbody tr").each(function () {
    n++;
  });
  for (i = n - 1; i > 1; i--) {
    $("#tableVentas tbody tr:eq('" + i + "')").remove();
  }
}


function agregarFila_Ventas(idFactura, cantidad, valor, stateSale, acciones) {

  if (stateSale == 1) {
    mostrarStateSale = '<button class= "btn btn-success btn-sm col-6">Activo</button/>'
  } else if (stateSale == 0) {
    mostrarStateSale = '<button class= "btn btn-danger btn-sm col-6">Anulada</button/>'
  }

  let datosVentas = "'" + idFactura + "', '" + cantidad + "', '" + valor + "', '" + stateSale + "'";

  var htmlTags = `<tr>
      <td> ${idFactura} </td>
      <td> ${cantidad} </td>
      <td> ${valor} </td>
      <td> ${idSupply} </td>
      <td>Cliente</td>
      <td>Insumo</td>
      <td> ${mostrarStateSale} </td>
      <td>
        <button class= "btn btn-danger btn-sm " onclick="anularVenta(${idFactura})"><i class="bi bi-trash"></i></button/>
      </td>
  </tr>`;
  $("#tableVentas tbody").append(htmlTags);
}


// "LISTAR" Es la tabla de ventas verdadera

function listar() {
  eliminaFilastabla();

  var tablaLista = $("#tableInsumos").DataTable();
  tablaLista.clear();
  tablaLista.destroy();

  var parametros = {
    accion: "seleccionarLista",
  };

  $.ajax({
    data: parametros,
    url: '../view/http/ventas.controller.php',
    type: "post",
    beforeSend: function () {

    },
    success: function (data) {
      for (var i in JSON.parse(data).registros) {
        agregarFila(
          JSON.parse(data).registros[i].idFactura,
          JSON.parse(data).registros[i].cliente,
          JSON.parse(data).registros[i].servicio,
          JSON.parse(data).registros[i].empleado,
          JSON.parse(data).registros[i].total,
          JSON.parse(data).registros[i].descriptionSale,
          JSON.parse(data).registros[i].stateSale,


          ""
        );
      }

      $("#tableInsumos").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
        order: [[1, "desc"]],
      });
    },

    error: function (error) {
      console.log("No se ha podido obtener la información " + error);
    },
  });
}


function agregarFila(idFactura, cliente, servicio, empleado, total, descriptionSale, stateSale, accion) {
  if (stateSale == 1) {
    mostrarStateSale =
      '<button class="btn btn-success btn-sm col-8">Activo</button>';
  } else if (stateSale == 0) {
    mostrarStateSale =
      '<button class="btn btn-danger btn-sm col-8">Anulada</button>';
  }
  if (stateSale == 1) {
    anular = `<button class="btn btn-danger btn-sm" onclick="actualizarEstado(${idFactura},${stateSale})"><i class="bi bi-trash3"></button>`;
  } else if (stateSale == 0) {
    anular = "";
  }

  let datosVentas = "'" + idFactura + "', '" + cliente + "', '" + servicio + "', '" + empleado + "', '" + total + "', '" + descriptionSale + "', '" + stateSale + "'";

  var htmlTags = `<tr>
    <td>${idFactura}</td>
    <td>${cliente}</td>
    <td>${servicio}</td>
    <td>${empleado}</td>
    <td>${total}</td>
    <td>${descriptionSale}</td>
    <td>${mostrarStateSale}</td>
   
    <td><button data-toggle="modal" data-target="#detalleVenta" class="btn btn-success btn-sm" onclick="tomarDatos(${datosVentas})"><i class="bi bi-eye"></i></button> ${anular}</td>
    </tr>`;

  $("#tableInsumos tbody").append(htmlTags);
}


function eliminaFilastabla() {
  var n = 0;
  $("#tableInsumos tbody tr").each(function () {
    n++;
  });
  for (i = n - 1; i > 1; i--) {
    $("#tableInsumos tbody tr:eq('" + i + "')").remove();
  }
}


//Cambiar de ESTADO

function actualizarEstado(idFactura, estado) {
  let parametros = {
    accion: "actualizarEstadoActivo",
    id: idFactura,
    estado: estado,
  };

  $.ajax({
    data: parametros,
    url: '../view/http/ventas.controller.php',
    type: "POST",
    beforeSend: function () {
      //mostrar cargando
    },
    success: function (data) {
      if (JSON.parse(data) == "ok") {
        Swal.fire({
          icon: 'success',
          title: '¡Venta anulada!',
          text: '',
          heightAuto: false,
          confirmButtonText: "Aceptar",
        })
        listar();
      }
    },
    error: function (error) {
      console.log("No se a podido editar la información " + error);
    },
  });
}


//Ver detalles de ventas

function tomarDatos(idFactura, cliente, servicio, empleado, total, descriptionSale, estado) {

  if (estado == 1) {
    var status = 'Activo';
  } else if (estado == 0) {
    var status = 'Anulado';
  }

  const formatoPesoDetalle = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
    minimumFractionDigits: 2,
  });
  var amount = formatoPesoDetalle.format(total);


  document.getElementById("id_sale_detail").value = idFactura;
  document.getElementById("idClientDetail").value = cliente;
  document.getElementById("idServiceDetail").value = servicio;
  document.getElementById("idEmployeeDetail").value = empleado;
  document.getElementById("totalDetail").value = amount;
  document.getElementById("descriptionSaleDetail").value = descriptionSale;
  //document.getElementById("dateRegistrationDetail").value = dateRegistration;
  document.getElementById("estadoDetail").value = status;
  ListarDetalle();

}

function ListarDetalle() {
  eliminaFilastablaDetalleInsumos();

  var tablaInsumo = $("#tablaInsumos").DataTable();
  tablaInsumo.clear();
  tablaInsumo.destroy();

  let parametros = {
    accion: "seleccionarListaInsumos",
    id: document.getElementById("id_sale_detail").value
  };

  $.ajax({
    data: parametros,
    url: "../view/http/ventas.controller.php",
    type: "post",
    beforeSend: function () {
      //cargando();
    },
    success: function (data) {
      for (var i in JSON.parse(data).registros) {
        agregarFilaTablaInsumoss(
          JSON.parse(data).registros[i].insumo,
          JSON.parse(data).registros[i].cantidad,
          JSON.parse(data).registros[i].total,
          ""
        );
      }


    },

    error: function (error) {
      console.log("No se ha podido obtener la información " + error);
    },
  });

}



function agregarFilaTablaInsumoss(
  nombreInsumo,
  cantidad,
  valorTotal

) {
  var htmlTags = `<tr>
  <td>${nombreInsumo}</td>
  <td>${cantidad}</td>
  <td>${valorTotal}</td>
  </tr>`;

  $("#tablaInsumos tbody").append(htmlTags);
}

function eliminaFilastablaDetalleInsumos() {
  var n = 0;
  $("#tablaInsumos tbody tr").each(function () {
    n++;
  });
  for (i = n - 1; i > 1; i--) {
    $("#tablaInsumos tbody tr:eq('" + i + "')").remove();
  }
}
/*
function anularVenta(id) {
  var parametros = {
    "accion": "anularVenta",
    "idSale": id
  };

  $.ajax({
    data: parametros,
    url: '../view/http/ventas.controller.php',
    type: 'post',
    beforeSend: function () {

    },

    success: function (data) {
      console.log(data);
      if (JSON.parse(data) == "ok") {
        Swal.fire({
          icon: 'success',
          title: '¡Venta anulada!',
          text: '',
          heightAuto: false,
          confirmButtonText: "Aceptar",
        })
        listarVentas()
      }

    },

    error: function (error) {
      console.log("No se ha podido obtener la información " + error);
    },

  });
}
*/