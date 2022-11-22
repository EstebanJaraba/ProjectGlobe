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
    } else if (document.getElementById('documentUser').value.length <= 6) {
        Swal.fire({
            icon: 'error',
            position: 'center',
            text: 'Ingrese un documento valido.'
        })
    }else{
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
                }else if (JSON.parse(data) == 'emailError') {
                    Swal.fire({
                        icon: 'warning',
                        title: '',
                        position: 'center',
                        text: '!El correo electrónico ya existe!',
                        footer: ''
                    })
                    
                } else if (JSON.parse(data) == 'email') {
                    Swal.fire({
                        icon: 'warning',
                        title: '',
                        position: 'center',
                        text: '!Correo electrónico inválido!',
                        footer: ''
                    })
                    
                } else if (JSON.parse(data) == 'doc') {
                    Swal.fire({
                        icon: 'warning',
                        title: '',
                        position: 'center',
                        text: '!El número de documento ya existe!',
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

    

}