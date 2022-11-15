function registerUser() {

    var parametros = {
        "accion": "registerUsers",
        "name": document.getElementById('nameUser').value,
        "last_name": document.getElementById('last_nameUser').value,
        "document": document.getElementById('documentUser').value,
        "email": document.getElementById('emailUser').value,
        "phone": document.getElementById('phoneUser').value,
        "password": document.getElementById('passwordUser').value,
        "role": document.getElementById('roleUser').value,
    };

    if (document.getElementById('nameUser').value == "" || document.getElementById('last_nameUser').value == "" || document.getElementById('documentUser').value == "" || document.getElementById('emailUser').value == "" || document.getElementById('phoneUser').value == "" || document.getElementById('passwordUser').value == "") {
        Swal.fire({
            icon: 'error',
            position: 'center',
            text: 'Por favor, completa todos los campos.'
        })
        listarUsuarios()
    } else if (document.getElementById('documentUser').value.length <= 6) {
        Swal.fire({
            icon: 'error',
            position: 'center',
            text: 'Ingrese un documento valido.'
        })
        listarUsuarios()
    } else {
        $.ajax({
            data: parametros,
            url: "http/users.controller.php",
            type: "post",
            beforeSend: function () {

            },
            success: function (data) {

                //  if (JSON.parse(data) == 'max') {
                //      Swal.fire({
                //          icon: 'error',
                //          position: 'center',
                //          text: 'Ingrese un documento valido.'
                //      })
                //      listarUsuarios()
                //  }else if (JSON.parse(data) == 'max2') {
                //      Swal.fire({
                //          icon: 'error',
                //          position: 'center',
                //          text: 'Ingrese un número de telefono valido.'
                //      })
                //      listarUsuarios()
                //  }else if (JSON.parse(data) == 'fallo') {
                //      Swal.fire({
                //          icon: 'error',
                //          position: 'center',
                //          text: 'Por favor, completa todos los campos.'
                //      })
                //      listarUsuarios()
                //  }else if (JSON.parse(data) == 'emailError') {
                //      Swal.fire({
                //          icon: 'warning',
                //          title: '',
                //          position: 'center',
                //          text: '!El correo electrónico ya existe!',
                //          footer: ''
                //      })
                //      listarUsuarios()
                //  }else if (JSON.parse(data) == 'email') {
                //      Swal.fire({
                //          icon: 'warning',
                //          title: '',
                //          position: 'center',
                //          text: '!Correo electrónico inválido!',
                //          footer: ''
                //      })
                //      listarUsuarios()
                //  }else if (JSON.parse(data) == 'doc') {
                //      Swal.fire({
                //          icon: 'warning',
                //          title: '',
                //          position: 'center',
                //          text: '!El número de documento ya existe!',
                //          footer: ''
                //      })
                //      listarUsuarios()
                //  }
                if (JSON.parse(data) == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        position: 'center',
                        text: '¡Registro exitoso!',
                        footer: ''
                    })
                    listarUsuarios()
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
            error: function () {
                console.log("No se ha podido obtener la información")
            },
        });
    }



}

function limpiar(){
    $('#registerUsers').on('show.bs.modal', function (event) {
        $("#registerUsers input").val("");
        $("#registerUsers select").val("");
    });
}

function assinmenetPassword() {
    document.getElementById('passwordUser').value = document.getElementById('documentUser').value
}

function listarUsuarios() {
    eliminarFilasTableUsers();

    var tableUsers = $("#tableUsers").DataTable();

    tableUsers.clear();
    tableUsers.destroy();

    var parametros = {
        accion: "select_ListUsers",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/users.controller.php",
        type: "post",
        beforeSend: function (data) {
            //mostrar_loading();
        },
        success: function (data) {


            for (var i in JSON.parse(data).registros) {
                agregarFila_Users(
                    JSON.parse(data).registros[i].idUser,
                    JSON.parse(data).registros[i].userName,
                    JSON.parse(data).registros[i].last_name,
                    JSON.parse(data).registros[i].document,
                    JSON.parse(data).registros[i].email,
                    JSON.parse(data).registros[i].phone,
                    JSON.parse(data).registros[i].passwordUser,
                    JSON.parse(data).registros[i].id_rol,
                    JSON.parse(data).registros[i].stateUser,
                    ""
                );
            }
            $("#tableUsers").DataTable({
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

function agregarFila_Users(idUser, userName, last_name, document, email, phone, passwordUser, idRole, stateUser, acciones) {
    if (stateUser == 1) {
        verEstado = '<button class="btn btn-success btn-sm col-12" style="cursor: text">ACTIVO</button>'
    } else if (stateUser == 0) {
        verEstado = '<button class="btn btn-danger btn-sm col-12" style="cursor: text">INACTIVO</button>'
    }
    if (stateUser == 1) {
        anular = `<button class="btn btn-outline-danger btn-sm" onclick="actualizarEstado(${idUser},${stateUser})"><i class="bi bi-person-dash"></i></button>`

    } else if (stateUser == 0) {
        anular = `<button class="btn btn-outline-success btn-sm" onclick="actualizarEstado1(${idUser},${stateUser})"><i class="bi bi-person-plus"></i></button>`
    }

    let datosUser = "'" + idUser + "','" + userName + "','" + last_name + "','" + document + "','" + email + "','" + phone + "','" + passwordUser + "','" + idRole + "','" + stateUser + "'";

    var htmlTags = `
         <tr>
           <td> ${idUser}</td>
           <td> ${userName}</td>
           <td> ${last_name}</td>
           <td> ${document}</td>
           <td> ${email}</td>
           <td> ${phone}</td>
           <td> ${passwordUser}</td>
           <td> ${idRole}</td>
           <td> ${verEstado}</td>
           <td>
             <button data-toggle="modal" data-target="#updateUser" class="btn btn-outline-success btn-sm" onclick="tomarDatosUser(${datosUser})"><i class="bi bi-pencil-square"></i></button>
                ${anular}
           </td>
         </tr>`;
    $("#tableUsers tbody").append(htmlTags);
}


function eliminarFilasTableUsers() {
    var n = 0;
    $("#tableUsers tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableUsers tbody tr:eq('" + i + "')").remove();
    }
}

function tomarDatosUser(idUser, name, last_name, documento, email, phone, passwordUser, idRole, stateUser) {
    document.getElementById('idUserUpdate').value = idUser
    document.getElementById('nameUserUpdate').value = name
    document.getElementById('last_nameUserUpdate').value = last_name
    document.getElementById('documentUserUpdate').value = documento
    document.getElementById('emailUserUpdate').value = email
    document.getElementById('phoneUserUpdate').value = phone
    document.getElementById('passwordUserUpdate').value = passwordUser
    document.getElementById('roleUserUpdate').value = idRole
    document.getElementById('stateUserUpdate').value = stateUser
}

function updateUsers() {
    var parametros = {
        "accion": "updateUser",
        "id": document.getElementById('idUserUpdate').value,
        "name": document.getElementById('nameUserUpdate').value,
        "last_name": document.getElementById('last_nameUserUpdate').value,
        "document": document.getElementById('documentUserUpdate').value,
        "email": document.getElementById('emailUserUpdate').value,
        "phone": document.getElementById('phoneUserUpdate').value,
        "password": document.getElementById('passwordUserUpdate').value,
        "role": document.getElementById('roleUserUpdate').value,
        "state": document.getElementById('stateUserUpdate').value,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/users.controller.php",
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
                listarUsuarios()
            } else if (JSON.parse(data) == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: '¡Actualizacion fallida!',
                    ShowConfirmbutton: false,
                    timer: 1500
                })
                listarUsuarios()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}

function actualizarEstado(idUser, stateUser) {
    let parametros = {
        accion: "actualizarEstadoActivo",
        id: idUser,
        estado: stateUser,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/users.controller.php",
        type: "POST",
        beforeSend: function () {
            //         //mostrar cargando
        },
        success: function (data) {
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    text: "Estado editado con exito",
                    showConfirmButton: false,
                    timer: 1500,
                });
                listarUsuarios();
            } else if (JSON.parse(data) == "error") {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    text: "Actualización de estado fallido",
                    showConfirmButton: false,
                    timer: 1500,
                });
                listarUsuarios();
            }
        },
        error: function (error) {
            console.log("No se a podido editar la información " + error);
        },
    });
}

function actualizarEstado1(idUser, stateUser) {
    let parametros = {
        accion: "actualizarEstadoInactivo",
        id: idUser,
        estado: stateUser,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/users.controller.php",
        type: "POST",
        beforeSend: function () {
            //         //mostrar cargando
        },
        success: function (data) {
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    text: "Estado editado con exito",
                    showConfirmButton: false,
                    timer: 1500,
                });
                listarUsuarios();
            } else if (JSON.parse(data) == "error") {
                Swal.fire({
                    position: "center",
                    icon: "warning",
                    text: "Actualización de estado fallido",
                    showConfirmButton: false,
                    timer: 1500,
                });
                listarUsuarios();
            }
        },
        error: function (error) {
            console.log("No se a podido editar la información " + error);
        },
    });
}