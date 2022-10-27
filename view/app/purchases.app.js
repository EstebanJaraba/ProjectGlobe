
function registrarCompra() {
    
    var parametros = {
        accion: "registrarCompra",
        factura: document.getElementById("facturaCompra").value,
        total: document.getElementById("totalCompra").innerHTML,
        proveedor: document.getElementById("proveedorPurchase").value,
        insumo: document.getElementById("insumoPurchase").value,
        description: document.getElementById("descriptionPurchase").value,
        cantidad: document.getElementById("cantidadAgregar").value,
        valor: document.getElementById("v_unitario").value,

    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "Registro exitoso",
                    showConfirmButton: false,
                    timer: 1500,
                });
                listar();
            }
            if (JSON.parse(data) == "error") {
                Swal.fire({
                    position: "top",
                    icon: "success",
                    title: "Registro f",
                    showConfirmButton: false,
                    timer: 1500,
                });
                listar();
            }
        },
        error: function (error) {
            console.log("No se a podido obtener la información " + error);
        },
    });
}

function calcularValorTotal() {
    document.getElementById("v_total").value = document.getElementById("cantidadAgregar").value * document.getElementById("v_unitario").value;
}

let ArregloProductosAgregarCompra = Array();
let valorTotalProCompra = 0;

function agregarProducto() {
    let selectorPruducto = document.getElementById("insumoPurchase");

    var productoAgregado = {
        productoId: document.getElementById("insumoPurchase").value,
        nombreProducto: selectorPruducto.options[selectorPruducto.selectedIndex].text,
        cantidad: document.getElementById("cantidadAgregar").value,
        valorUnitario: document.getElementById("v_unitario").value,
        valorTotal: document.getElementById("v_total").value,
    };

    ArregloProductosAgregarCompra.push(productoAgregado);

    valorTotalProCompra = valorTotalProCompra + parseInt(document.getElementById("v_total").value);
    document.getElementById("totalCompra").innerHTML = valorTotalProCompra;


    listarProducto();
}


function listarProducto() {
    eliminaFilastablaProducto();

    var tablaCompra = $("#tablaCompras").DataTable();
    tablaCompra.clear();
    tablaCompra.destroy();

    var parametros = {
        accion: "seleccionarListaProducto",
    };

    for (var i in ArregloProductosAgregarCompra) {
        agregarFilaProducto(
            ArregloProductosAgregarCompra[i].productoId,
            ArregloProductosAgregarCompra[i].nombreProducto,
            ArregloProductosAgregarCompra[i].cantidad,
            ArregloProductosAgregarCompra[i].valorUnitario,
            ArregloProductosAgregarCompra[i].valorTotal
        );
    }

    $("#tablaCompras").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
    });
}

function eliminarProducto(productoId) {
    for (let i = 0; i < ArregloProductosAgregarCompra.length; i++) {
        if (ArregloProductosAgregarCompra[i].productoId == productoId) {
            ArregloProductosAgregarCompra.splice(ArregloProductosAgregarCompra[i], 1);
        }
    }

    listarProducto();
}

function agregarFilaProducto(
    productoId,
    nombreProducto,
    cantidad,
    valorUnitario,
    valorTotal,
    accion
) {
    var htmlTags = `<tr>
      <td>${productoId}</td>
      <td>${nombreProducto}</td>
      <td>${cantidad}</td>
      <td>${valorUnitario}</td>
      <td>${valorTotal}</td>
      <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarProducto(${productoId})">x</button></td>
      </tr>`;

    $("#tablaCompras tbody").append(htmlTags);
}

function eliminaFilastablaProducto() {
    var n = 0;
    $("#tablaCompras tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tablaCompras tbody tr:eq('" + i + "')").remove();
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
            trar_loading();
        },
        success: function (data) {
            if (accion == "listaProveedor") {
                loadingSelect(data, nombreSelect);
            }
            if (accion == "listaProducto") {
                loadingSelect(data, nombreSelect);
            }
        },
        error: function (error) {
            console.log("No se ha podido obtener la informaciín " + error);
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

function selectListaProveedor() {
    ajaxMain(
        "listaProveedor",
        "../view/http/purchases.controller.php",
        "listaProveedor"
    );
    cargando();
    setTimeout(() => {
        selectListaProducto();
    }, 200);
}

function selectListaProducto() {
    ajaxMain("listaProducto", "../view/http/purchases.controller.php", "listaProducto");
    cerrarAlert();
}

//Listar Productos Agregados

function listarProducto() {
    eliminaFilastablaProducto();

    var tablaCompra = $("#tablaCompras").DataTable();
    tablaCompra.clear();
    tablaCompra.destroy();

    var parametros = {
        accion: "seleccionarListaProducto",
    };

    for (var i in ArregloProductosAgregarCompra) {
        agregarFilaProducto(
            ArregloProductosAgregarCompra[i].productoId,
            ArregloProductosAgregarCompra[i].nombreProducto,
            ArregloProductosAgregarCompra[i].cantidad,
            ArregloProductosAgregarCompra[i].valorUnitario,
            ArregloProductosAgregarCompra[i].valorTotal
        );
    }

    $("#tablaCompras").DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
        },
    });
}

function eliminaFilastablaProducto() {
    var n = 0;
    $("#tablaCompras tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tablaCompras tbody tr:eq('" + i + "')").remove();
    }
}

//   //Arreglo para enlistar productos agregados
function agregarFilaProducto(
    productoId,
    nombreProducto,
    cantidad,
    valorUnitario,
    valorTotal,
    accion
) {
    var htmlTags = `<tr>
    <td>${productoId}</td>
    <td>${nombreProducto}</td>
    <td>${cantidad}</td>
    <td>${valorUnitario}</td>
    <td>${valorTotal}</td>
    <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarProducto(${productoId})">x</button></td>
    </tr>`;

    $("#tablaCompras tbody").append(htmlTags);
}

function eliminarProducto(productoId) {
    for (let i = 0; i < ArregloProductosAgregarCompra.length; i++) {
        if (ArregloProductosAgregarCompra[i].productoId == productoId) {
            ArregloProductosAgregarCompra.splice(ArregloProductosAgregarCompra[i], 1);
        }
    }

    listarProducto();
}

//Listar Compras

function listarCompra() {
    eliminaFilastablaCompra();

    var tablaCompra = $("#tablaCompras").DataTable();
    tablaCompra.clear();
    tablaCompra.destroy();

    var parametros = {
        accion: "seleccionarListaCompra",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function () {
            cargando();
        },
        success: function (data) {
            //console.log(JSON.parse(data));
            //if(JSON.parse(data).registros == ""){

            for (var i in JSON.parse(data).registros) {
                agregarFilaCompra(
                    JSON.parse(data).registros[i].id,
                    JSON.parse(data).registros[i].descripcion,
                    JSON.parse(data).registros[i].cantidad,
                    JSON.parse(data).registros[i].valor,
                    JSON.parse(data).registros[i].estado
                );
            }

            $("#tablaCompra").DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                },
            });

            setTimeout(() => {
                cerrarAlert();
            }, 1200);
        },

        error: function (error) {
            console.log("No se ha podido obtener la información " + error);
        },
    });
}

// function cargando() {
//     let timerInterval;
//     Swal.fire({
//         title: "cargando...",
//         html: "Cargando registros",
//         timer: 20000,
//         timerProgressBar: true,
//         didOpen: () => {
//             Swal.showLoading();
//             const b = Swal.getHtmlContainer().querySelector("b");
//             timerInterval = setInterval(() => {}, 1000);
//         },
//         willClose: () => {
//             clearInterval(timerInterval);
//         },
//     }).then((result) => {
//         /* Read more about handling dismissals below */
//         if (result.dismiss === Swal.DismissReason.timer) {
//             console.log("Error de conexión con la BD");
//         }
//     });
// }

function cerrarAlert() {
    Swal.close();
}

function eliminaFilastablaCompra() {
    var n = 0;
    $("#tablaCompras tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tablaCompras tbody tr:eq('" + i + "')").remove();
    }
}

function agregarFilaCompra(id, descripcion, cantidad, valor, estado) {
    if (estado == 1) {
        varEstado =
            '<button class="btn btn-success btn-sm col-8" style="cursor: text">Activo</button>';
    } else if (estado == 0) {
        varEstado =
            '<button class="btn btn-danger btn-sm col-8" style="cursor: text">Inactivo</button>';
    }

    let datosProvider =
        "'" +
        id +
        "', '" +
        descripcion +
        "', '" +
        cantidad +
        "', '" +
        valor +
        "', '" +
        estado +
        "' ";

    var htmlTags = `<tr>
       <td>${id}</td>
       <td>${descripcion}</td>
       <td>${cantidad}</td>
       <td>${valor}</td>
       <td>Proveedor</td>
       <td>Producto</td>
       <td>${varEstado}</td>
       <td><button data-toggle="modal" data-target="#actualizacionCompra" class="btn btn-success btn-sm" onclick="tomarDatos(${datosProvider})"><i class="bi bi-pencil-square"></i></button></td>
       </tr>`;

    $("#tablaCompras tbody").append(htmlTags);
}

// LISTAR ES LA TABLA DE COMPRAS REAL

function listar() {
    eliminaFilastabla();

    var tablaLista = $("#tablePurchases").DataTable();
    tablaLista.clear();
    tablaLista.destroy();

    var parametros = {
        accion: "seleccionarLista",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function () {
            //cargando();
        },
        success: function (data) {
            for (var i in JSON.parse(data).registros) {
                agregarFila(
                    JSON.parse(data).registros[i].IdFactura,
                    JSON.parse(data).registros[i].proveedor,
                    JSON.parse(data).registros[i].description,
                    JSON.parse(data).registros[i].total,
                    JSON.parse(data).registros[i].estado,
                    ""
                );
            }

            $("#tablePurchases").DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                },
            });

            setTimeout(() => {
                cerrarAlert();
            }, 1200);
        },

        error: function (error) {
            console.log("No se ha podido obtener la información " + error);
        },
    });
}

function agregarFila(IdFactura, proveedor, description, total, estado, accion) {
    if (estado == 1) {
        varEstado =
            '<button class="btn btn-success btn-sm col-12" style="cursor: text">ACTIVO</button>';
    } else if (estado == 0) {
        varEstado =
            '<button class="btn btn-danger btn-sm col-12" style="cursor: text">INACTIVO</button>';
    }
    if (estado == 1) {
        anular = `<button class="btn btn-outline-danger btn-sm" onclick="actualizarEstado(${IdFactura},${estado})"><i class="bi bi-cart-dash"></i></button>`

    } else if (estado == 0) {
        anular = "";
    }

    let datosProvider =
        "'" +
        IdFactura +
        "', '" +
        proveedor +
        "', '" +
        description +
        "', '" +
        total +
        "', '" +
        estado +
        "'";

    var htmlTags = `<tr>
       <td>${IdFactura}</td>
       <td>${proveedor}</td>
       <td>${description}</td>
       <td>${total}</td>
       <td>${varEstado}</td>
       <td>
       <button data-toggle="modal" data-target="#updateUser" class="btn btn-outline-success btn-sm" onclick="tomarDatos(${datosProvider})"><i class="bi bi-pencil-square"></i></button>
            ${anular}
       </td>
       </tr>`;

    $("#tablePurchases tbody").append(htmlTags);
}

function eliminaFilastabla() {
    var n = 0;
    $("#tablaProducto tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tablaProducto tbody tr:eq('" + i + "')").remove();
    }
}

//Cambiar de ESTADO

function actualizarEstado(IdFactura, estado) {
    let parametros = {
        accion: "actualizarEstadoActivo",
        id: IdFactura,
        estado: estado,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "POST",
        beforeSend: function () {
            //         //mostrar cargando
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

//Listar Detalles de Compra

function tomarDatos(IdFactura, total, proveedor, estado) {

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


    document.getElementById("idDetail").value = IdFactura;
    document.getElementById("totalDetail").value = amount;
    document.getElementById("proveedorDetail").value = proveedor;
    document.getElementById("estadoDetail").value = status;
}














// function listarCompras() {
//     eliminarFilasTablePurchases();

//     var tablePurchases = $("#tablePurchases").DataTable();

//     tablePurchases.clear();
//     tablePurchases.destroy();

//     var parametros = {
//         accion: "select_ListPurchases",
//     };

//     $.ajax({
//         data: parametros,
//         url: "../view/http/purchases.controller.php",
//         type: "post",
//         beforeSend: function (data) {
//             //mostrar_loading();
//         },
//         success: function (data) {


//             for (var i in JSON.parse(data).registros) {
//                 agregarFila_Purchases(
//                     JSON.parse(data).registros[i].idPurchase,
//                     JSON.parse(data).registros[i].idSupplier,
//                     JSON.parse(data).registros[i].idSupply,
//                     JSON.parse(data).registros[i].description,
//                     JSON.parse(data).registros[i].price,
//                     JSON.parse(data).registros[i].statePurchase,
//                     " "
//                 );
//             }

//             $("#tablePurchases").DataTable({
//                 dom: "Bfrtip",
//                 buttons: ["copy", "csv", "excel", "pdf", "print"],
//                 language: {
//                     url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
//                 },
//                 order: [
//                     [1, "asc"]
//                 ],
//             });

//         },
//         error: function () {
//             console.log("no se ha podido obtener la informacion");
//         },
//     });
// }

// function agregarFila_Purchases(idPurchase, idSupplier, idSupply, description, price, statePurchase, acciones) {
//     if (statePurchase == 0) {
//         verEstado = '<button class="btn btn-success btn-sm col-12 " style="cursor: text">PENDIENTE</button>'
//     } else if (statePurchase == 1) {
//         verEstado = '<button class="btn btn-danger btn-sm col-12 " style="cursor: text">EN COBRO</button>'
//     } else if (statePurchase == 2) {
//         verEstado = '<button class="btn btn-warning btn-sm col-12 " style="cursor: text">PAGADO</button>'
//     } else if (statePurchase == 3) {
//         verEstado = '<button class="btn btn-secondary btn-sm col-12 " style="cursor: text">CANCELADO</button>'
//     }

//     let datosPurchase = "'" + idPurchase + "','" + idSupplier + "','" + idSupply + "','" + description + "','" + price + "','" + statePurchase + "'";

//     var htmlTags = `
//         <tr>
//           <td> ${idPurchase}</td>
//           <td> ${idSupplier}</td>
//           <td> ${idSupply}</td>
//           <td> ${description}</td>
//           <td> ${price}</td>
//           <td> ${verEstado}</td>
//           <td >
//           <button data-toggle="modal" data-target="#updatePurchase" class="btn btn-outline-success btn-sm" onclick="tomarDatos(${datosPurchase})"><i class="bi bi-pencil-square"></i></button>
//           <button class="btn btn-outline-danger btn-sm" onclick="AnularPurchase(${idPurchase})"><i class="bi bi-cart-dash"></i></button>
//           </td>
//         </tr>`;
//     $("#tablePurchases tbody").append(htmlTags);
// }


// function eliminarFilasTablePurchases() {
//     var n = 0;
//     $("#tablePurchases tbody tr").each(function () {
//         n++;
//     });
//     for (i = n - 1; i > 1; i--) {
//         $("#tablePurchases tbody tr:eq('" + i + "')").remove();
//     }
// }

// function tomarDatos(idPurchase, idSupplier, idSupply, description, price, statePurchase) {
//     document.getElementById('idPurchaseUpdate').value = idPurchase
//     document.getElementById('namePurchaseUpdate').value = idSupplier
//     document.getElementById('dateEntregaPurchaseUpdate').value = idSupply
//     document.getElementById('datePedidoPurchaseUpdate').value = description
//     document.getElementById('proveedorPurchaseUpdate').value = price
//     document.getElementById('statePurchaseUpdate').value = statePurchase
// }



// function updatePurchase() {
//     var parametros = {
//         "accion": "updatePurchase",
//         "id": document.getElementById('idPurchaseUpdate').value,
//         "name": document.getElementById('namePurchaseUpdate').value,
//         "dateEntrega": document.getElementById('dateEntregaPurchaseUpdate').value,
//         "datePedido": document.getElementById('datePedidoPurchaseUpdate').value,
//         "idProveedor": document.getElementById('proveedorPurchaseUpdate').value,
//         "idInsumo": document.getElementById('insumoPurchaseUpdate').value,
//         "dateEspiration": document.getElementById('dateExpiracionPurchaseUpdate').value,
//         "state": document.getElementById('statePurchaseUpdate').value
//     };

//     $.ajax({
//         data: parametros,
//         url: "../view/http/purchases.controller.php",
//         type: "post",
//         beforeSend: function () {

//         },
//         success: function (data) {

//             if (JSON.parse(data) == 'ok') {
//                 Swal.fire({
//                     position: 'center',
//                     icon: 'success',
//                     title: '¡Actualizacion exitosa!',
//                     ShowConfirmbutton: false,
//                     timer: 1500
//                 })
//                 listarCompras()
//             }
//         },
//         error: function () {
//             console.log("No se ha podido obtener la información")
//         },
//     });
// }


// function AnularPurchase(idPurchase) {
//     var parametros = {
//         "accion": "anularPurchase",
//         "id": idPurchase
//     };

//     $.ajax({
//         data: parametros,
//         url: "../view/http/purchases.controller.php",
//         type: "post",
//         beforeSend: function () {

//         },
//         success: function (data) {

//             if (JSON.parse(data) == 'ok') {
//                 Swal.fire({
//                     position: 'center',
//                     icon: 'success',
//                     title: 'Anulación exitosa!',
//                     ShowConfirmbutton: false,
//                     timer: 1500
//                 })
//                 listarCompras()
//             }
//         },
//         error: function () {
//             console.log("No se ha podido obtener la información")
//         },
//     });
// }