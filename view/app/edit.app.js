// function updateAccount() {
//     var parametros = {
//         "accion": "upAccount",
//         "id": document.getElementById('idAccount').value,
//         "name": document.getElementById('nameAccount').value,
//         "last_name": document.getElementById('last_nameAccount').value,
//         "document": document.getElementById('documentAccount').value,
//         "email": document.getElementById('emailAccount').value,
//         "phone": document.getElementById('phoneAccount').value,
//         "role": document.getElementById('roleAccount').value,

//     };

//     if (document.getElementById('nameAccount').value == "") {
//         Swal.fire({
//             icon: 'error',
//             position: 'center',
//             text: 'Por favor, completa todos los campos.'
//         })
//     } else {
//         $.ajax({
//             data: parametros,
//             url: "../view/http/account.controller.php",
//             type: "post",
//             beforeSend: function () {

//             },
//             success: function (data) {

//                 if (JSON.parse(data) == 'ok') {
//                     Swal.fire({
//                         icon: 'success',
//                         title: '',
//                         position: 'center',
//                         text: 'Perfil actualizado',
//                         footer: ''
//                     }).then(function (isConfirm) {
//                         if (isConfirm) {
//                             location.href = 'http/logout.controller.php';
//                         } else {

//                         }
//                     });
//                 } else if (JSON.parse(data) == 'error') {
//                     Swal.fire({
//                         position: 'center',
//                         icon: 'error',
//                         title: '¡Actualizacion fallida!',
//                         ShowConfirmbutton: false,
//                         timer: 1500
//                     })
//                 }
//             },
//             error: function () {
//                 console.log("No se ha podido obtener la información")
//             },
//         });
//     }


// }

function updatePass() {
    var parametros = {
        "accion": "updatePass",
        "id": document.getElementById('idup').value,
        "pass": document.getElementById('passUpdate').value,
        "repetir": document.getElementById('passr').value,
    };

    if (document.getElementById('passUpdate').value != document.getElementById('passr').value) {
        Swal.fire({
            icon: 'warning',
            title: '',
            position: 'center',
            text: 'las contraseñas no cinciden',
            footer: ''
        })
    } else {
        $.ajax({
            data: parametros,
            url: "../view/http/account.controller.php",
            type: "post",
            beforeSend: function () {

            },
            success: function (data) {

                if (JSON.parse(data) == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        position: 'center',
                        text: 'Contraseña actualizada',
                        footer: ''
                    }).then(function (isConfirm) {
                        if (isConfirm) {
                            location.href = 'http/logout.controller.php';
                        } else {

                        }
                    });
                } else if (JSON.parse(data) == 'no') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        text: 'Las contraseñas no coinciden',
                        ShowConfirmbutton: false,
                        timer: 1500
                    })
                } else if (JSON.parse(data) == 'error') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        text: '¡Actualizacion fallida!',
                        ShowConfirmbutton: false,
                        timer: 1500
                    })
                }
            },
            error: function () {
                console.log("No se ha podido obtener la información")
            },
        });
    }


}


function mostrar() {
    document.getElementById('update').style.display = 'flex';
}

function ocultar() {
    document.getElementById('update').style.display = 'none';
}