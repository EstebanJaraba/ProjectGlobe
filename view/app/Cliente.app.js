
function registroCliente() {

    var parametros = {
        "accion": 'registroCliente',
        "documentClient": document.getElementById('documentClient').value,
        "nameClient": document.getElementById('nameClient').value,
        "email": document.getElementById('email').value,
        "neighborhood": document.getElementById('neighborhood').value,
        "address": document.getElementById('address').value,
        "phone": document.getElementById('phone').value,
        "stateClient": document.getElementById('stateClient').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/clientes.controller.php',
        type: 'post',
        beforeSend: function () {

        },

        success: function (data) {

            if (JSON.parse(data) == 'max') {
                Swal.fire({
                    icon: 'error',
                    position: 'center',
                    text: 'Ingrese un documento valido.'
                })
                listarClientes()
            } else if (JSON.parse(data) == 'max2') {
                Swal.fire({
                    icon: 'error',
                    position: 'center',
                    text: 'Ingrese un número de teléfono valido.'
                })
                listarClientes()
            } else if (JSON.parse(data) == 'fallo') {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    title: "¡Los campos son obligatorios!",
                });
                listarClientes()
            } else if (JSON.parse(data) == 'emailError') {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    position: 'center',
                    text: '!El correo electrónico ya existe!',
                    footer: ''
                })
                listarClientes()
            } else if (JSON.parse(data) == 'email') {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    position: 'center',
                    text: '!Correo electrónico inválido!',
                    footer: ''
                })
                listarClientes()
            } else if (JSON.parse(data) == 'doc') {
                Swal.fire({
                    icon: 'warning',
                    title: '',
                    position: 'center',
                    text: '!El número de documento ya existe!',
                    footer: ''
                })
                listarClientes()
            }
            else if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    position: 'center',
                    text: '¡Registro exitoso!',
                    footer: ''
                })
                listarClientes();
                limpiar();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '',
                    position: 'center',
                    text: '¡Fallo en el registro!',
                    footer: ''
                })
            }
        },

        error: function (error) {
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

function limpiar() {
    $('#registroCliente').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    setTimeout(function () {
        location.href = "clientes.php";
    }, 1500);
}

function listarClientes() {
    eliminarFilasTableCliente();

    var tableClientes = $("#tableClientes").DataTable();

    tableClientes.clear();
    tableClientes.destroy();

    var parametros = {
        accion: "select_listClientes",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/clientes.controller.php",
        type: "post",
        beforeSend: function () {

        },

        success: function (data) {

            for (var i in JSON.parse(data).registros) {

                agregarFila_Clientes(
                    JSON.parse(data).registros[i].idClient,
                    JSON.parse(data).registros[i].documentClient,
                    JSON.parse(data).registros[i].nameClient,
                    JSON.parse(data).registros[i].email,
                    JSON.parse(data).registros[i].neighborhood,
                    JSON.parse(data).registros[i].address,
                    JSON.parse(data).registros[i].phone,
                    JSON.parse(data).registros[i].stateClient,
                    ""
                );
            }

            $("#tableClientes").DataTable({
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                },
                order: [[1, "asc"]],

            });
        },

        error: function () {
            console.log("No se ha podido obtener la información");
        },
    });

}


function agregarFila_Clientes(idClient, documentClient, nameClient, email, neighborhood, address, phone, stateClient, acciones) {

    if (stateClient == 1) {
        verstateClient = '<button class= "btn btn-success btn-sm col-8">Activo</button/>'
    } else if (stateClient == 0) {
        verstateClient = '<button class= "btn btn-danger btn-sm col-10">Inactivo</button/>'
    }
    if(stateClient == 1){
        bot = `<button class="btn btn-danger btn-sm" onclick="anularCliente(${idClient},${stateClient})"><i class="bi bi-trash3"></i></button>`
    }else if (stateClient == 0) {
        bot = ``
    }

    let datosClientes = "'" + idClient + "', '" + documentClient + "', '" + nameClient + "', '" + email + "', '" + neighborhood + "', '" + address + "', '" + phone + "', '" + stateClient + "'";

    var htmlTags = `<tr>
        <td> ${idClient} </td>
        <td> ${documentClient} </td>
        <td> ${nameClient} </td>
        <td> ${email} </td>
        <td> ${neighborhood} </td>
        <td> ${address} </td>
        <td> ${phone} </td>
        <td> ${verstateClient} </td>
        <td>
            <button data-toggle= "modal" data-target="#editarCliente" class= "btn btn-success btn-sm " onclick="tomarDatos(${datosClientes})" ><i class="bi bi-pencil-square"></i> </button/>
            ${bot}
        </td>
    </tr>`;
    $("#tableClientes tbody").append(htmlTags);
}


function eliminarFilasTableCliente() {
    var n = 0;
    $("#tableClientes tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableClientes tbody tr:eq('" + i + "')").remove();

    }
}


function tomarDatos(idClient, documentClient, nameClient, email, neighborhood, address, phone, stateClient) {
    document.getElementById('idClientEditar').value = idClient
    document.getElementById('documentClientEditar').value = documentClient
    document.getElementById('nameClientEditar').value = nameClient
    document.getElementById('emailClientEditar').value = email
    document.getElementById('neighborhoodClientEditar').value = neighborhood
    document.getElementById('addressClientEditar').value = address
    document.getElementById('phoneClientEditar').value = phone
    document.getElementById('stateClientEditar').value = stateClient
}

function editarCliente() {
    var parametros = {
        "accion": 'editarCliente',
        "idClient": document.getElementById('idClientEditar').value,
        "documentClient": document.getElementById('documentClientEditar').value,
        "nameClient": document.getElementById('nameClientEditar').value,
        "email": document.getElementById('emailClientEditar').value,
        "neighborhood": document.getElementById('neighborhoodClientEditar').value,
        "address": document.getElementById('addressClientEditar').value,
        "phone": document.getElementById('phoneClientEditar').value,
        "stateClient": document.getElementById('stateClientEditar').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/clientes.controller.php',
        type: 'post',
        beforeSend: function () {

        },

        success: function (data) {

            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: '¡Actualizado con éxito!',
                    text: '',
                    heightAuto: false,
                    confirmButtonText: "Aceptar",
                })
                listarClientes()
            }

        },

        error: function (error) {
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

function anularCliente(idClient) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "¡Vas a inhabilitar un cliente!",
        icon: 'warning',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            var parametros = {
                "accion": "anularCliente",
                "idClient": idClient
            };

            $.ajax({
                data: parametros,
                url: "../view/http/clientes.controller.php",
                type: "post",
                beforeSend: function () {

                },
                success: function (data) {

                    if (JSON.parse(data) == 'ok') {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: '¡Se inhabilitó con éxito!',
                            showConfirmButton: false,
                            timer: 1500

                        })
                        listarClientes()
                    }
                },
                error: function () {
                    console.log("No se ha podido obtener la información")
                },
            });
        }
    })

}
