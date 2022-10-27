
function registroEmpleado() {
    
    var parametros = {
        "accion": 'registroEmpleado',
        "documentEmployee": document.getElementById('documentEmployee').value,
        "nameEmployee": document.getElementById('nameEmployee').value,
        "email": document.getElementById('email').value,
        "phone": document.getElementById('phone').value,
        "stateEmployee": document.getElementById('stateEmployee').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/empleados.controller.php',
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
                  listarEmpleados()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

function listarEmpleados(){
    eliminarFilasTableEmpleado();

    var tableEmpleados = $("#tableEmpleados").DataTable();
    
    tableEmpleados.clear();
    tableEmpleados.destroy();

    var parametros = {
        accion: "select_listEmpleados",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/empleados.controller.php",
        type: "post",
        beforeSend: function(){
           
        },

        success: function(data){
            
            for (var i in JSON.parse(data).registros) {

                agregarFila_Empleados(
                    JSON.parse(data).registros[i].idEmployee,
                    JSON.parse(data).registros[i].documentEmployee,
                    JSON.parse(data).registros[i].nameEmployee,
                    JSON.parse(data).registros[i].email,
                    JSON.parse(data).registros[i].phone,
                    JSON.parse(data).registros[i].stateEmployee,
                    ""
                );
            }

            $("#tableEmpleados").DataTable({
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

function agregarFila_Empleados(idEmployee, documentEmployee, nameEmployee, email, phone, stateEmployee, acciones){

    if(stateEmployee == 1){
        verstateEmployee = '<button class= "btn btn-success btn-sm col-8">Activo</button/>'
    }else if(stateEmployee == 0){
        verstateEmployee = '<button class= "btn btn-danger btn-sm col-8">Anulado</button/>'
    }

    let datosEmpleado = "'"+idEmployee+"', '"+documentEmployee+"', '"+nameEmployee+"', '"+email+"', '"+phone+"', '"+stateEmployee+"'";

    var htmlTags = `<tr>
        <td> ${idEmployee} </td>
        <td> ${documentEmployee} </td>
        <td> ${nameEmployee} </td>
        <td> ${email} </td>
        <td> ${phone} </td>
        <td> ${verstateEmployee} </td>
        <td>
            <button data-toggle= "modal" data-target="#editarEmpleado" class= "btn btn-success btn-sm " onclick="tomarDatos(${datosEmpleado})" ><i class="bi bi-pencil-square"></i> </button/>
            <button class= "btn btn-danger btn-sm " onclick="anularEmpleado(${idEmployee})"><i class="bi bi-trash3"></i></button/>
        </td>
    </tr>`;
    $("#tableEmpleados tbody").append(htmlTags);
}


function eliminarFilasTableEmpleado(){
    var n = 0;
    $("#tableEmpleados tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableEmpleados tbody tr:eq('" + i + "')").remove();
        
    }
}

function tomarDatos(idEmployee, documentEmployee, nameEmployee, email, phone, stateEmployee){
    document.getElementById('idEmployeeEditar').value = idEmployee
    document.getElementById('documentEmployeeEditar').value = documentEmployee
    document.getElementById('nameEmployeeEditar').value = nameEmployee
    document.getElementById('emailEmployeeEditar').value = email
    document.getElementById('phoneEmployeeEditar').value = phone
    document.getElementById('stateEmployeeEditar').value = stateEmployee
}

function editarEmpleado(){
    var parametros = {
        "accion": 'editarEmpleado',
        "idEmployee": document.getElementById('idEmployeeEditar').value,
        "documentEmployee": document.getElementById('documentEmployeeEditar').value,
        "nameEmployee": document.getElementById('nameEmployeeEditar').value,
        "email": document.getElementById('emailEmployeeEditar').value,
        "phone": document.getElementById('phoneEmployeeEditar').value,
        "stateEmployee": document.getElementById('stateEmployeeEditar').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/empleados.controller.php',
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
                  listarEmpleados()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

function anularEmpleado(idEmployee){
    var parametros = {
        "accion": "anularEmpleado",
        "idEmployee": idEmployee
    };

    $.ajax({
        data: parametros,
        url: '../view/http/empleados.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Empleado inactivo!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                listarEmpleados()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}