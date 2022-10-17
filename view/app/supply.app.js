function registerSupply() {

    var parametros = {
        "accion": "registerSupplys",
        "name": document.getElementById('nameSupply').value,
        "partNumber": document.getElementById('partNumberSupply').value,
        "quantity": document.getElementById('quantitySupply').value,
        "state": document.getElementById('stateSupply').value,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
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
                listarInsumos()
            }
            else if (JSON.parse(data) == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '¡Registro fallido!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarInsumos()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });

}

function listarInsumos() {
    eliminarFilasTableSupplys();

    var tableSupplys = $("#tableSupplys").DataTable();

    tableSupplys.clear();
    tableSupplys.destroy();

    var parametros = {
        accion: "select_ListSupplys",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
        type: "post",
        beforeSend: function (data) {
            //mostrar_loading();
        },
        success: function (data) {


            for (var i in JSON.parse(data).registros) {
                agregarFila_Supplys(
                    JSON.parse(data).registros[i].idSupply,
                    JSON.parse(data).registros[i].nameSupply,
                    JSON.parse(data).registros[i].partNumber,
                    JSON.parse(data).registros[i].quantity,
                    JSON.parse(data).registros[i].stateSupply,
                    " "
                );
            }

            $("#tableSupplys").DataTable({
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

function agregarFila_Supplys(idSupply, nameSupply, partNumber,quantity, stateSupply, acciones) {
    if (stateSupply == 1) {
        verEstado = '<button class="btn btn-success btn-sm col-6 " style="cursor: text">ACTIVO</button>'
    } else if (stateSupply == 0) {
        verEstado = '<button class="btn btn-danger btn-sm col-6 " style="cursor: text">INACTIVO</button>'
    }

    let datosSupply = "'"+idSupply+"','"+nameSupply+"','"+partNumber+"','"+quantity+"','"+stateSupply+"'";

    var htmlTags = `
        <tr>
          <td class="d-flex justify-content-center"> ${idSupply}</td>
          <td> ${nameSupply}</td>
          <td> ${partNumber}</td>
          <td> ${quantity}</td>
          <td class="d-flex justify-content-center"> ${verEstado}</td>
          <td >
            <button data-toggle="modal" data-target="#updateSupplys" class="btn btn-outline-success btn-sm" onclick="tomarDatos(${datosSupply})"><i class="bi bi-pencil-square"></i></button>
            <button class="btn btn-outline-danger btn-sm" onclick="AnularSupply(${idSupply})"><i class="bi bi-file-earmark-minus"></i></button>
          </td>
        </tr>`;
    $("#tableSupplys tbody").append(htmlTags);
}


function eliminarFilasTableSupplys() {
    var n = 0;
    $("#tableSupplys tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableSupplys tbody tr:eq('" + i + "')").remove();
    }
}

function tomarDatos(idSupply,nameSupply,partNumber,stateSupply){
    document.getElementById('idSupplyUpdate').value=idSupply  
    document.getElementById('nameSupplyUpdate').value=nameSupply 
    document.getElementById('partNumberSupplyUpdate').value=partNumber  
    document.getElementById('stateSupplyUpdate').value=stateSupply  
}



function updateSupply(){
    var parametros = {
        "accion": "updateSupply",
        "id": document.getElementById('idSupplyUpdate').value,
        "name": document.getElementById('nameSupplyUpdate').value,
        "partNumber": document.getElementById('partNumberSupplyUpdate').value,
        "state": document.getElementById('stateSupplyUpdate').value
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
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
                listarInsumos()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}


function AnularSupply(idSupply){
    var parametros = {
        "accion": "anularSupply",
        "id": idSupply
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
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
                listarInsumos()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}