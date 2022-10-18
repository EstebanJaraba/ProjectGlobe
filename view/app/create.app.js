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
        "state": document.getElementById('stateUser').value,
    };

    $.ajax({
        data: parametros,
        url: "view/http/users.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {

            if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    icon: 'success',
                    title: '',
                    position: 'center',
                    text: '¡Registro exitoso!',
                    footer: ''
                })
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