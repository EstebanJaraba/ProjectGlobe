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

    };

    if (document.getElementById('nameUserUpdate').value == "") {
        Swal.fire({
            icon: 'error',
            position: 'center',
            text: 'Por favor, completa todos los campos.'
        })
    } else {
        $.ajax({
            data: parametros,
            url: "../view/http/users.controller.php",
            type: "post",
            beforeSend: function () {

            },
            success: function (data) {

                if (JSON.parse(data) == 'ok') {
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        position: 'center',
                        text: '¡Perfil actualizado!',
                        footer: ''
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                          location.href = 'http/logout.controller.php';
                        } else {
                          
                        }
                      });
                } else if (JSON.parse(data) == 'error') {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: '¡Actualizacion fallida!',
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