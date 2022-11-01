function recuperar (){
    var correo = document.getElementById('email').value;
    if(correo.trim() == ""){
        Swal.fire({
            icon: 'warnin',
            position: 'center',
            text: 'Por favor ingrese bien su correo.'
        })
    }

    var parametros = {
        "accion": "recuperarContra",
        "correo": document.getElementById('email').value,
        
    };


    $.ajax({
        data: parametros,
        url: "http/mail_reset.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {

            if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    icon: 'error',
                    position: 'center',
                    text: 'Envio satisfactorio'
                })

            }else {
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