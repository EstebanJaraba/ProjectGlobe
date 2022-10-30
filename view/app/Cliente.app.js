
function registroCliente() {
    
    var parametros = {
        "accion": 'registroCliente',
        "documentClient": document.getElementById('documentClient').value,
        "nameClient": document.getElementById('nameClient').value,
        "last_name": document.getElementById('last_name').value,
        "email": document.getElementById('email').value,
        "phone": document.getElementById('phone').value,
        "stateClient": document.getElementById('stateClient').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/clientes.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Registro exitoso!',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  listarClientes()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

function listarClientes(){
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
        beforeSend: function(){
           
        },

        success: function(data){
            
            for (var i in JSON.parse(data).registros) {

                agregarFila_Clientes(
                    JSON.parse(data).registros[i].idClient,
                    JSON.parse(data).registros[i].documentClient,
                    JSON.parse(data).registros[i].nameClient,
                    JSON.parse(data).registros[i].last_name,
                    JSON.parse(data).registros[i].email,
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

        error: function(){
            console.log("No se ha podido obtener la información");
        },
    });

}


function agregarFila_Clientes(idClient, documentClient, nameClient, last_name, email, phone, stateClient, acciones){

    if(stateClient == 1){
        verstateClient = '<button class= "btn btn-success btn-sm col-6">Activo</button/>'
    }else if(stateClient == 0){
        verstateClient = '<button class= "btn btn-danger btn-sm col-6">Anulado</button/>'
    }

    let datosClientes = "'"+idClient+"', '"+documentClient+"', '"+nameClient+"', '"+last_name+"', '"+email+"', '"+phone+"', '"+stateClient+"'";

    var htmlTags = `<tr>
        <td> ${idClient} </td>
        <td> ${documentClient} </td>
        <td> ${nameClient} </td>
        <td> ${last_name} </td>
        <td> ${email} </td>
        <td> ${phone} </td>
        <td> ${verstateClient} </td>
        <td>
            <button data-toggle= "modal" data-target="#editarCliente" class= "btn btn-success btn-sm " onclick="tomarDatos(${datosClientes})" ><i class="bi bi-pencil-square"></i> </button/>
            <button class= "btn btn-danger btn-sm " onclick="anularCliente(${idClient})"><i class="bi bi-trash3"></i></button/>
        </td>
    </tr>`;
    $("#tableClientes tbody").append(htmlTags);
}


function eliminarFilasTableCliente(){
    var n = 0;
    $("#tableClientes tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableClientes tbody tr:eq('" + i + "')").remove();
        
    }
}


function tomarDatos(idClient, documentClient, nameClient, last_name, email, phone, stateClient){
    document.getElementById('idClientEditar').value = idClient
    document.getElementById('documentClientEditar').value = documentClient
    document.getElementById('nameClientEditar').value = nameClient
    document.getElementById('last_nameClientEditar').value = last_name
    document.getElementById('emailClientEditar').value = email
    document.getElementById('phoneClientEditar').value = phone
    document.getElementById('stateClientEditar').value = stateClient
}

function editarCliente(){
    var parametros = {
        "accion": 'editarCliente',
        "idClient": document.getElementById('idClientEditar').value,
        "documentClient": document.getElementById('documentClientEditar').value,
        "nameClient": document.getElementById('nameClientEditar').value,
        "last_name": document.getElementById('last_nameClientEditar').value,
        "email": document.getElementById('emailClientEditar').value,
        "phone": document.getElementById('phoneClientEditar').value,
        "stateClient": document.getElementById('stateClientEditar').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/clientes.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Actualización exitosa!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  listarClientes()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}


function anularCliente(idClient){
    var parametros = {
        "accion": "anularCliente",
        "idClient": idClient
    };

    $.ajax({
        data: parametros,
        url: '../view/http/clientes.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Cliente inactivo!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                listarClientes()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

