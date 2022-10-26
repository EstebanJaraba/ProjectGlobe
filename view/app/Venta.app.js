function registrarVenta() {
    var parametros = {
      accion: "registrarVenta",
      cliente: document.getElementById("listaCliente").value,
      servicio: document.getElementById("listaServicio").value,
      insumo: document.getElementById("listaInsumo").value,
      cantidad: document.getElementById("cantidadAgregar").value,
      valor: document.getElementById("v_unitario").value,
      total: document.getElementById("totalVenta").innerHTML,
      descriptionSale: document.getElementById("descriptionSale").value,
      dateRegistration: document.getElementById("dateRegistration").value,
    };
  
  
    $.ajax({
        data: parametros,
        url: '../view/http/ventas.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro exitoso!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  listar();
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },
    });
}


function calcularValorTotal() {
    document.getElementById("v_total").value =
    document.getElementById("cantidadAgregar").value *
    document.getElementById("v_unitario").value;
}


let ArregloInsumosAgregarVenta = Array();
let valorTotalProVenta = 0;
function agregarInsumo() {
  let selectorInsumo = document.getElementById("listaInsumo");

  var insumoAgregado = {
    insumoId: document.getElementById("listaInsumo").value,
    nombreInsumo:
      selectorInsumo.options[selectorInsumo.selectedIndex].text,
    cantidad: document.getElementById("cantidadAgregar").value,
    valorUnitario: document.getElementById("v_unitario").value,
    valorTotal: document.getElementById("v_total").value,
  };

  ArregloInsumosAgregarVenta.push(insumoAgregado);

  //Formato de valor a dolar
  

  valorTotalProVenta =
    valorTotalProVenta + parseInt(document.getElementById("v_total").value);
  document.getElementById("totalVenta").innerHTML = valorTotalProVenta;

  listarInsumos();

  // var factur = document.getElementById("facturaCompra").value;
  // var proveedr = document.getElementById("listaProveedor").value;
  // var product = document.getElementById("listaProducto").value;
  // $("#registroProducto")[0].reset();
  // $("#facturaCompra").val(factur);
  // $("#listaProveedor").val(proveedr);
  // $("#listaProducto").val(product);
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
  
    $("#tableVentas").DataTable({
        dom: "Bfrtip",
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
        order: [[1, "desc"]],

    });
}

function eliminarFilasTableInsumo(){
    var n = 0;
    $("#tableVentas tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableVentas tbody tr:eq('" + i + "')").remove();
        
    }
}


//Arreglo para listar insumos agregados
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
        ArregloInsumosAgregarVenta.splice(ArregloInsumosAgregarVenta[i],1);
      }
    }
    listarInsumos();
}


//Listar ventas.
function listarVentas(){
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
        beforeSend: function(){
        
        },

        success: function(data){
            
            for (var i in JSON.parse(data).registros) {

                agregarFila_Ventas(
                    JSON.parse(data).registros[i].id,
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

        error: function(){
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


function agregarFila_Ventas(id, cantidad, valor, stateSale, acciones){

    if(stateSale == 1){
        mostrarStateSale = '<button class= "btn btn-success btn-sm col-6">Activo</button/>'
    }else if(stateSale == 0){
        mostrarStateSale = '<button class= "btn btn-danger btn-sm col-6">Anulada</button/>'
    }

    let datosVentas = "'"+id+"', '"+cantidad+"', '"+valor+"', '"+stateSale+"'";

    var htmlTags = `<tr>
        <td> ${id} </td>
        <td> ${cantidad} </td>
        <td> ${valor} </td>
        <td> ${idSupply} </td>
        <td>Cliente</td>
        <td>Insumo</td>
        <td> ${mostrarStateSale} </td>
        <td>
            <button class= "btn btn-danger btn-sm " onclick="anularVenta(${id})"><i class="bi bi-trash3"></i></button/>
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
            JSON.parse(data).registros[i].id,
            JSON.parse(data).registros[i].cliente,
            JSON.parse(data).registros[i].servicio,
            JSON.parse(data).registros[i].total,
            JSON.parse(data).registros[i].descriptionSale,
            JSON.parse(data).registros[i].dateRegistration,
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


function agregarFila(id, cliente, servicio, total, descriptionSale, dateRegistration, stateSale, accion) {
    if (stateSale == 1) {
        mostrarStateSale =
        '<button class="btn btn-success btn-sm col-8">Activo</button>';
    } else if (stateSale == 0) {
        mostrarStateSale =
        '<button class="btn btn-danger btn-sm col-8">Anulada</button>';
    }
    if (stateSale == 1) {
      anular = `<button class="btn btn-danger" onclick="actualizarEstado(${id},${stateSale})"><i class="bi bi-x-octagon"></i></button>`;
    } else if (stateSale == 0) {
      anular = "";
    }
  
    let datosVentas = "'"+id+"', '"+cliente+"', '"+servicio+"', '"+total+"', '"+descriptionSale+"', '"+dateRegistration+"', '"+stateSale+"'";
  
    var htmlTags = `<tr>
      <td>${id}</td>
      <td>${cliente}</td>
      <td>${servicio}</td>
      <td>${total}</td>
      <td>${descriptionSale}</td>
      <td>${dateRegistration}</td>
      <td>${mostrarStateSale}</td>
      <td><button data-toggle="modal" data-target="#detalleVenta" class="btn btn-warning" onclick="tomarDatos(${datosVentas})"><i class="bi bi-pencil-square"></i></button> ${anular}</td>
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

function actualizarEstado(id, estado) {
    let parametros = {
      accion: "actualizarEstadoActivo",
      id: id,
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
            position: "top",
            icon: "success",
            title: "Estado editado con exito",
            showConfirmButton: false,
            timer: 1500,
          });
          listar();
        }
      },
      error: function (error) {
        console.log("No se a podido editar la información " + error);
      },
    });
}


//Ver detalles ventas
function tomarDatos(id, cliente, servicio, total, descriptionSale, dateRegistration, estado) {
  
    if(estado == 1){
      var status = 'Activo';
    }else if(estado == 0){
      var status = 'Anulado';
    }
  
    const formatoPesoDetalle = new Intl.NumberFormat("en-US", {
      style: "currency",
      currency: "USD",
      minimumFractionDigits: 2,
    });
    var amount = formatoPesoDetalle.format(total);
  
  
    document.getElementById("idDetail").value = id;
    document.getElementById("idClientDetail").value = cliente;
    document.getElementById("idServiceDetail").value = servicio;
    document.getElementById("descriptionSaleDetail").value = descriptionSale;
    document.getElementById("idSupplyDetail").value = insumo;
    document.getElementById("totalDetail").value = amount;
    document.getElementById("dateRegistration").value = dateRegistration;
    document.getElementById("estadoDetail").value = status;
}

function anularVenta(id){
    var parametros = {
        "accion": "anularVenta",
        "id": id
    };

    $.ajax({
        data: parametros,
        url: '../view/http/ventas.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Venta anulada!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  listarVentas()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

