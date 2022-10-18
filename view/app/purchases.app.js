function registerPurchase() {
    

    var parametros = {
        "accion": "registerPurchase",
        "proveedor": document.getElementById('proveedorPurchase').value,
        "insumo": document.getElementById('insumoPurchase').value,
        "description": document.getElementById('descriptionPurchase').value,
        "state": document.getElementById('statePurchase').value,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {

            if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarCompras()
            } else if (JSON.parse(data) == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '¡Registro fallido!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarCompras()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });

}

function listarCompras() {
    eliminarFilasTablePurchases();

    var tablePurchases = $("#tablePurchases").DataTable();

    tablePurchases.clear();
    tablePurchases.destroy();

    var parametros = {
        accion: "select_ListPurchases",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function (data) {
            //mostrar_loading();
        },
        success: function (data) {


            for (var i in JSON.parse(data).registros) {
                agregarFila_Purchases(
                    JSON.parse(data).registros[i].idPurchase,
                    JSON.parse(data).registros[i].idSupplier,
                    JSON.parse(data).registros[i].idSupply,
                    JSON.parse(data).registros[i].description,
                    JSON.parse(data).registros[i].price,
                    JSON.parse(data).registros[i].statePurchase,
                    " "
                );
            }

            $("#tablePurchases").DataTable({
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                },
                order: [
                    [1, "asc"]
                ],
            });

        },
        error: function () {
            console.log("no se ha podido obtener la informacion");
        },
    });
}

function agregarFila_Purchases(idPurchase, idSupplier, idSupply, description, price, statePurchase, acciones) {
    if (statePurchase == 0) {
        verEstado = '<button class="btn btn-success btn-sm col-12 " style="cursor: text">PENDIENTE</button>'
    } else if (statePurchase == 1) {
        verEstado = '<button class="btn btn-danger btn-sm col-12 " style="cursor: text">EN COBRO</button>'
    } else if (statePurchase == 2) {
        verEstado = '<button class="btn btn-warning btn-sm col-12 " style="cursor: text">PAGADO</button>'
    } else if (statePurchase == 3) {
        verEstado = '<button class="btn btn-secondary btn-sm col-12 " style="cursor: text">CANCELADO</button>'
    }

    let datosPurchase = "'" + idPurchase + "','" + idSupplier + "','" + idSupply + "','" + description + "','" + price + "','" + statePurchase + "'";

    var htmlTags = `
        <tr>
          <td> ${idPurchase}</td>
          <td> ${idSupplier}</td>
          <td> ${idSupply}</td>
          <td> ${description}</td>
          <td> ${price}</td>
          <td> ${verEstado}</td>
          <td >
          <button data-toggle="modal" data-target="#updatePurchase" class="btn btn-outline-success btn-sm" onclick="tomarDatos(${datosPurchase})"><i class="bi bi-pencil-square"></i></button>
          <button class="btn btn-outline-danger btn-sm" onclick="AnularPurchase(${idPurchase})"><i class="bi bi-cart-dash"></i></button>
          </td>
        </tr>`;
    $("#tablePurchases tbody").append(htmlTags);
}


function eliminarFilasTablePurchases() {
    var n = 0;
    $("#tablePurchases tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tablePurchases tbody tr:eq('" + i + "')").remove();
    }
}

function tomarDatos(idPurchase, idSupplier, idSupply, description, price, statePurchase) {
    document.getElementById('idPurchaseUpdate').value = idPurchase
    document.getElementById('namePurchaseUpdate').value = idSupplier
    document.getElementById('dateEntregaPurchaseUpdate').value = idSupply
    document.getElementById('datePedidoPurchaseUpdate').value = description
    document.getElementById('proveedorPurchaseUpdate').value = price
    document.getElementById('statePurchaseUpdate').value = statePurchase
}



function updatePurchase() {
    var parametros = {
        "accion": "updatePurchase",
        "id": document.getElementById('idPurchaseUpdate').value,
        "name": document.getElementById('namePurchaseUpdate').value,
        "dateEntrega": document.getElementById('dateEntregaPurchaseUpdate').value,
        "datePedido": document.getElementById('datePedidoPurchaseUpdate').value,
        "idProveedor": document.getElementById('proveedorPurchaseUpdate').value,
        "idInsumo": document.getElementById('insumoPurchaseUpdate').value,
        "dateEspiration": document.getElementById('dateExpiracionPurchaseUpdate').value,
        "state": document.getElementById('statePurchaseUpdate').value
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {

            if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '¡Actualizacion exitosa!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarCompras()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}


function AnularPurchase(idPurchase) {
    var parametros = {
        "accion": "anularPurchase",
        "id": idPurchase
    };

    $.ajax({
        data: parametros,
        url: "../view/http/purchases.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {

            if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Anulación exitosa!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarCompras()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}