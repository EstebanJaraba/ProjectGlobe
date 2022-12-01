function registerSupplier() {

    var parametros = {
        "accion": "registerSuppliers",
        "nombre": document.getElementById('nameSupplier').value,
        "direction": document.getElementById('dire').value,
        "correo": document.getElementById('emailSupplier').value,
        "celular": document.getElementById('phoneSupplier').value,

    };

    $.ajax({
        data: parametros,
        url: "../view/http/suppliers.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {
            if (JSON.parse(data) == 'max2') {
                Swal.fire({
                    icon: 'error',
                    position: 'center',
                    text: 'Ingrese un número de telefono valido.'
                })
                listarProveedores()
            } else if (JSON.parse(data) == 'fallo') {
                Swal.fire({
                    icon: 'error',
                    position: 'center',
                    text: 'Por favor, completa todos los campos.'
                })
                listarProveedores()
            } else if (JSON.parse(data) == 'emailError') {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    position: 'center',
                    text: '!El correo electrónico ya existe!',
                    footer: ''
                })
                listarProveedores()
            } else if (JSON.parse(data) == 'email') {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    position: 'center',
                    text: '!Correo electrónico inválido!',
                    footer: ''
                })
                listarProveedores()
            } else if (JSON.parse(data) == 'doc') {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    position: 'center',
                    text: '!El número de documento ya existe!',
                    footer: ''
                })
                listarProveedores()
            } else if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '¡Registro exitoso!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarProveedores()
            }
            if (JSON.parse(data) == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '¡Registro fallido!',
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
                    JSON.parse(data).registros[i].nameSupplier,
                    JSON.parse(data).registros[i].phone,
                    JSON.parse(data).registros[i].direction,
                    JSON.parse(data).registros[i].email,
                    JSON.parse(data).registros[i].stateSupplier,
                    " "
                );
            }

            $("#tableSuppliers").DataTable({
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

function agregarFila_Suppliers(idSupplier, name, phone, direction, email, stateSupplier, acciones) {
    if (stateSupplier == 1) {
        verEstado = '<button class="btn btn-success btn-sm col-12" style="cursor: text">ACTIVO</button>'
    } else if (stateSupplier == 0) {
        verEstado = '<button class="btn btn-danger btn-sm col-12" style="cursor: text">INACTIVO</button>'
    }
    if (stateSupplier == 1) {
        bot = `<button class="btn btn-outline-danger btn-sm" onclick="AnularSupplier(${idSupplier},${stateSupplier})"><i class="bi bi-folder-minus"></i></button>`

    } else if (stateSupplier == 0) {
        bot = ``
    }

    let datosSupplier = "'" + idSupplier + "','" + name + "','" + phone + "','" + direction + "','" + email + "','" + stateSupplier + "'";

    var htmlTags = `
         <tr>
           <td> ${idSupplier}</td>
           <td> ${name}</td>
           <td> ${phone}</td>
           <td> ${direction}</td>
           <td> ${email}</td>
           <td> ${verEstado}</td>
           <td>
             <button data-toggle="modal" data-target="#updateSupplier" class="btn btn-outline-success btn-sm" onclick="tomarDatosSupplier(${datosSupplier})"><i class="bi bi-pencil-square"></i></button>
              ${bot}
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

function tomarDatosSupplier(idSupplier, name, phone, dire, email, stateSupplier) {
    document.getElementById('idSupplierUpdate').value = idSupplier
    document.getElementById('nameUpdate').value = name
    document.getElementById('phoneUpdate').value = phone
    document.getElementById('direUpdate').value = dire
    document.getElementById('emailUpdate').value = email
    document.getElementById('stateUpdate').value = stateSupplier
}

function updateSupplier() {
    var parametros = {
        "accion": "updateSupplier",
        "id": document.getElementById('idSupplierUpdate').value,
        "nombre": document.getElementById('nameUpdate').value,
        "celular": document.getElementById('phoneUpdate').value,
        "direction": document.getElementById('direUpdate').value,
        "correo": document.getElementById('emailUpdate').value,
        "estado": document.getElementById('stateUpdate').value
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
            if (JSON.parse(data) == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '¡Actualizacion fallida!',
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
    Swal.fire({
        title: '¿Estas seguro?',
        text: "¡Vas a inhabilitar un proveedor!",
        icon: 'warning',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
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
                            text: 'Acción exitosa!',
                            showConfirmButton: false,
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
    })

}