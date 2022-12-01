function registrarCompra() {

    var factura = document.getElementById("facturaCompra").value;
    var total = document.getElementById("totalCompra").value;
    var provee = document.getElementById("proveedorPurchase").value;
    var insumo = document.getElementById("insumoPurchase").value;
    var des = document.getElementById("descriptionPurchase").value;
    var cant = document.getElementById("cantidadAgregar").value;
    var uni = document.getElementById("v_unitario").value;

    if (
        factura.length == 0 ||
        provee.length == 0 ||
        insumo.length == 0 ||
        des.length == 0 ||
        cant.length == 0 ||
        uni.length == 0
    ) {
        Swal.fire({
            position: "center",
            icon: "warning",
            text: "Sin campos vacios por favor",
        });
    } else if (factura < 1 || total < 1 || cant < 1 || uni < 1) {
        Swal.fire({
            position: "center",
            icon: "warning",
            text: "Los valores del número de factura no pueden ser negativos",
        });
    } else if (cant >= 101) {
        Swal.fire({
            position: "center",
            icon: "warning",
            text: "La cantidad no debe sobrepasar las 100 unidades",
        });
    } else {

        var parametros = {
            accion: "registrarCompra",
            "factura": document.getElementById("facturaCompra").value,
            "total": document.getElementById("totalCompra").innerHTML,
            "proveedor": document.getElementById("proveedorPurchase").value,
            "insumo": document.getElementById("insumoPurchase").value,
            "description": document.getElementById("descriptionPurchase").value,
            "cantidad": document.getElementById("cantidadAgregar").value,
            "valor": document.getElementById("v_unitario").value,
            "arreglo": ArregloProductosAgregarCompra,

        };

        $.ajax({
            data: parametros,
            url: "../view/http/purchases.controller.php",
            type: "post",
            beforeSend: function () {

            },
            success: function (data) {
                if (JSON.parse(data) == "ok") {
                    Swal.fire({
                        position: "top",
                        icon: "success",
                        tittle: "Hecho",
                        text: "Registro exitoso",
                        timer: 1500,
                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            location.href = 'compra.php';
                        } else {
                            //if no clicked => do something else
                        }
                    });
                    listar();
                    ocultar();
                    limpiar();
                } else if (JSON.parse(data) == "fac") {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        text: "La factura ya existe, ingrese una diferente",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    listar();
                } else if (JSON.parse(data) == "errorIn") {
                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        text: "Actualización de stock fallida",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    listar();
                    ocultar();
                }
            },
            error: function (error) {
                console.log("No se a podido obtener la información " + error);
            },
        });
    }

}


function mostrar() {
    document.getElementById('showRegister').style.display = 'flex';
}

function ocultar() {
    document.getElementById('showRegister').style.display = 'none';
}

function limpiar() {
    let formulario = document.getElementById('registroProducto');
    formulario.addEventListener('submit', function () {
        formulario.reset();
    });
}

function calcularValorTotal() {
    document.getElementById("v_total").value = document.getElementById("cantidadAgregar").value * document.getElementById("v_unitario").value;
}

let ArregloProductosAgregarCompra = Array();
let valorTotalProCompra = 0;

function agregarInsumo() {
    let selectorPruducto = document.getElementById("insumoPurchase");

    var insumo = document.getElementById("insumoPurchase").value;
    var cantidad = document.getElementById("cantidadAgregar").value;
    var unitario = document.getElementById("v_unitario").value;
    var total = document.getElementById("v_total").value;

    if (insumo.length == 0 || cantidad.length == 0 || unitario.length == 0 || total.length == 0) {
        Swal.fire({
            position: "center",
            icon: "warning",
            text: "Sin campos vacios por favor",
        });

    } else if (cantidad < 1) {
        Swal.fire({
            position: "center",
            icon: "warning",
            text: "Los valores del número de factura no pueden ser negativos",
        });
    } else {
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


        listarInsumos();
    }


}

function listarInsumos() {
    eliminaFilastablaRegistrarInsumos();

    var tablaCompra = $("#tablaCompras").DataTable();
    tablaCompra.clear();
    tablaCompra.destroy();

    var parametros = {
        accion: "seleccionarListaProducto",
    };

    for (var i in ArregloProductosAgregarCompra) {
        agregarFilaTablaInsumos(
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

function eliminarInsumos(productoId) {
    for (let i = 0; i < ArregloProductosAgregarCompra.length; i++) {
        if (ArregloProductosAgregarCompra[i].productoId == productoId) {
            ArregloProductosAgregarCompra.splice(ArregloProductosAgregarCompra[i], 1);
        }
    }

    listarInsumos();
}

function agregarFilaTablaInsumos(
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
      <td><button type="button" class="btn btn-sm btn-danger" onclick="eliminarInsumos(${productoId})">x</button></td>
      </tr>`;

    $("#tablaCompras tbody").append(htmlTags);
}

function eliminaFilastablaRegistrarInsumos() {
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

        },
        success: function (data) {
            if (accion == "proveedorPurchase") {
                loadingSelect(data, nombreSelect);
            }
            if (accion == "insumoPurchase") {
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

function selects() {
    ajaxMain(
        "insumoPurchase",
        "../view/http/purchases.controller.php",
        "insumoPurchase"
    );

    setTimeout(() => {
        selectP();
    }, 200);
}

function selectP() {
    ajaxMain("proveedorPurchase", "../view/http/purchases.controller.php", "proveedorPurchase");
    cerrarAlert();
}

//Listar Productos Agregados

function cerrarAlert() {
    Swal.close();
}

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
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
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
            '<button class="btn btn-danger btn-sm col-12" style="cursor: text">ANULADO</button>';
    }
    if (estado == 1) {
        anular = `<button class="btn btn-outline-danger btn-sm" onclick="actualizarEstado(${IdFactura},${estado})"><i class="bi bi-cart-dash"></i></button>`

    } else if (estado == 0) {
        anular = ``
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
       <button data-toggle="modal" data-target="#detalleCompra" class="btn btn-outline-success btn-sm" onclick="tomarDatos(${datosProvider})"><i class="bi bi-eye"></i></button>
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
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Vas a deshabilitar una compra?",
        icon: 'warning',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
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
                            text: "Estado editado con exito",
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
    })
    

}

function actualizarEstado1(IdFactura, estado) {
    let parametros = {
        accion: "actualizarEstadoInactivo",
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
                    text: "Estado editado con exito",
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

function tomarDatos(IdFactura, proveedor, description, total, estado) {

    if (estado == 1) {
        var estadoC = 'Activo'
    } else if (estado == 0) {
        var estadoC = 'Anulado';
    }

    document.getElementById("id_detalle").value = IdFactura;
    document.getElementById("proveedor").value = proveedor;
    document.getElementById("estado").value = estadoC;

    ListarDetalle();
}

function ListarDetalle() {
    eliminaFilastablaDetalleInsumos();

    var tablaInsumo = $("#tablaInsumos").DataTable();
    tablaInsumo.clear();
    tablaInsumo.destroy();

    let parametros = {
        accion: "seleccionarListaInsumos",
        id: document.getElementById("id_detalle").value
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
                agregarFilaTablaInsumoss(
                    JSON.parse(data).registros[i].insumo,
                    JSON.parse(data).registros[i].cantidad,
                    JSON.parse(data).registros[i].total,
                    ""
                );
            }

            // $("#tablaInsumos").DataTable({
            //     language: {
            //         url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            //     },
            // });
        },

        error: function (error) {
            console.log("No se ha podido obtener la información " + error);
        },
    });

}

function agregarFilaTablaInsumoss(
    nombreProducto,
    cantidad,
    valorTotal

) {
    var htmlTags = `<tr>
      <td>${nombreProducto}</td>
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