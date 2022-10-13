function registerSupplier() {

    var parametros = {
        "accion": "registerSuppliers",
        "nombre": document.getElementById('nameSupplier').value,
        "apellido": document.getElementById('last_nameSupplier').value,
        "documento": document.getElementById('documentSupplier').value,
        "correo": document.getElementById('emailSupplier').value,
        "celular": document.getElementById('phoneSupplier').value,
        "estado": document.getElementById('stateSupplier').value
    };

    $.ajax({
        data: parametros,
        url: "../view/http/suppliers.controller.php",
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
                listarProveedores()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });

}

function listarProveedores() {
    eliminarFilasTableSuppliers();

    var tableSuppliers = $("#tableSuppliers").DataTable();

    tableSuppliers.clear();
    tableSuppliers.destroy();

    var parametros = {
        accion: "select_ListSuppliers",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/suppliers.controller.php",
        type: "post",
        beforeSend: function (data) {
            //mostrar_loading();
        },
        success: function (data) {


            for (var i in JSON.parse(data).registros) {
                agregarFila_Suppliers(
                    JSON.parse(data).registros[i].idSupplier,
                    JSON.parse(data).registros[i].name,
                    JSON.parse(data).registros[i].last_name,
                    JSON.parse(data).registros[i].document,
                    JSON.parse(data).registros[i].email,
                    JSON.parse(data).registros[i].phone,
                    JSON.parse(data).registros[i].stateSupplier,
                    " "
                );
            }

            $("#tableSuppliers").DataTable({
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

function agregarFila_Suppliers(idSupplier, name, last_name, document, email, phone, stateSupplier, acciones) {
    if (stateSupplier == 1) {
        verEstado = '<button class="btn btn-success btn-sm col-12" style="cursor: text">ACTIVO</button>'
    } else if (stateSupplier == 0) {
        verEstado = '<button class="btn btn-danger btn-sm col-12" style="cursor: text">INACTIVO</button>'
    }

    let datosSupplier = "'" + idSupplier + "','" + name + "','" + last_name + "','" + document + "','" + email + "','" + phone + "','" + stateSupplier + "'";

    var htmlTags = `
         <tr>
           <td> ${idSupplier}</td>
           <td> ${name}</td>
           <td> ${last_name}</td>
           <td> ${document}</td>
           <td> ${email}</td>
           <td> ${phone}</td>
           <td> ${verEstado}</td>
           <td>
             <button data-toggle="modal" data-target="#updateSupplier" class="btn btn-outline-success btn-sm" onclick="tomarDatosSupplier(${datosSupplier})"><i class="bi bi-pencil-square"></i></button>
             <button class="btn btn-outline-danger btn-sm" onclick="AnularSupplier(${idSupplier})"><i class="bi bi-folder-minus"></i></button>
           </td>
         </tr>`;
    $("#tableSuppliers tbody").append(htmlTags);
}


function eliminarFilasTableSuppliers() {
    var n = 0;
    $("#tableSuppliers tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableSuppliers tbody tr:eq('" + i + "')").remove();
    }
}

function tomarDatosSupplier(idSupplier, name, last_name, documento, email, phone, stateSupplier){    
    document.getElementById('idSupplierUpdate').value=idSupplier
    document.getElementById('nameSupplierUpdate').value=name
    document.getElementById('last_nameSupplierUpdate').value=last_name
    document.getElementById('documentSupplierUpdate').value=documento
    document.getElementById('emailSupplierUpdate').value=email
    document.getElementById('phoneSupplierUpdate').value=phone
    document.getElementById('stateSupplierUpdate').value=stateSupplier
}

function updateSupplier() {
    var parametros = {
        "accion": "updateSupplier",
        "id": document.getElementById('idSupplierUpdate').value,
        "nombre": document.getElementById('nameSupplierUpdate').value,
        "apellido": document.getElementById('last_nameSupplierUpdate').value,
        "documento": document.getElementById('documentSupplierUpdate').value,
        "correo": document.getElementById('emailSupplierUpdate').value,
        "celular": document.getElementById('phoneSupplierUpdate').value,
        "estado": document.getElementById('stateSupplierUpdate').value
    };

    $.ajax({
        data: parametros,
        url: "../view/http/suppliers.controller.php",
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
                listarProveedores()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}


function AnularSupplier(idSupplier) {
    var parametros = {
        "accion": "anularSupplier",
        "id": idSupplier
    };

    $.ajax({
        data: parametros,
        url: "../view/http/suppliers.controller.php",
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
                listarProveedores()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}