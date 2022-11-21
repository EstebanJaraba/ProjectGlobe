function registroServicio() {
    
    var parametros = {
        "accion": 'registroServicio',
        "nameService": document.getElementById('nameService').value,
        "costService": document.getElementById('costService').value,
        "stateService": document.getElementById('stateService').value
    };

    if (document.getElementById("nameService").value == "" || document.getElementById("costService").value == "" ||
    document.getElementById("stateService").value == "") 
    {
        Swal.fire({
        position: "center",
        icon: "warning",
        title: "¡Los campos son obligatorios!",
        });
    }
    else {
        $.ajax({
            data: parametros,
            url: '../view/http/servicios.controller.php',
            type: 'post',
            beforeSend: function(){
                
            },
    
            success: function(data){
                console.log(data);
                if (JSON.parse(data) == "ok") {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registro exitoso!',
                        text: '',
                        heightAuto: false,
                        confirmButtonText: "Aceptar",
                    })
                    listarServicio();
                    limpiar();
                }
    
            },
    
            error: function(error){
                console.log("No se ha podido obtener la información " + error);
            },
        });
    }
}

function limpiar() {
    $('#registroServicio').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    setTimeout(function () {
        location.href = "servicios.php";
    }, 1500);
}


function  listarServicio(){
    eliminarFilasTableServicios();

    var tableServicio = $("#tableServicio").DataTable();
    
    tableServicio.clear();
    tableServicio.destroy();

    var parametros = {
        accion: "select_listServicios",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/servicios.controller.php",
        type: "post",
        beforeSend: function(){
           
        },

        success: function(data){
            
            for (var i in JSON.parse(data).registros) {

                agregarFila_Servicios(
                    JSON.parse(data).registros[i].idService,
                    JSON.parse(data).registros[i].nameService,
                    JSON.parse(data).registros[i].costService,
                    JSON.parse(data).registros[i].stateService,
                    ""
                );
            }

            $("#tableServicio").DataTable({
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



function agregarFila_Servicios(idService, nameService, costService, stateService, acciones){

    if(stateService == 1){
        mostrarStateService = '<button class= "btn btn-success btn-sm col-6">Disponible</button/>'
    }else if(stateService == 0){
        mostrarStateService = '<button class= "btn btn-danger btn-sm col-6">No disponible</button/>'
    }

    let datosServicio = "'"+idService+"', '"+nameService+"', '"+costService+"', '"+stateService+"'";

    var htmlTags = `<tr>
        <td> ${idService} </td>
        <td> ${nameService} </td>
        <td> ${costService} </td>
        <td> ${mostrarStateService} </td>
        <td>
            <button data-toggle= "modal" data-target="#editarServicio" class= "btn btn-success btn-sm " onclick="tomarDatos(${datosServicio})" ><i class="bi bi-pencil-square"></i> </button/>
            <button class= "btn btn-danger btn-sm " onclick="anularServicio(${idService})"><i class="bi bi-trash3"></i></button/>
        </td>
    </tr>`;
    $("#tableServicio tbody").append(htmlTags);
}



function eliminarFilasTableServicios(){
    var n = 0;
    $("#tableServicio tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableServicio tbody tr:eq('" + i + "')").remove();
        
    }
}


function tomarDatos(idService, nameService, costService, stateService){
    document.getElementById('idServiceEditar').value = idService
    document.getElementById('nameServiceEditar').value = nameService
    document.getElementById('costServiceEditar').value = costService
    document.getElementById('stateServiceEditar').value = stateService
}


function editarServicio(){
    var parametros = {
        "accion": 'editarServicio',
        "idService": document.getElementById('idServiceEditar').value,
        "nameService": document.getElementById('nameServiceEditar').value,
        "costService": document.getElementById('costServiceEditar').value,
        "stateService": document.getElementById('stateServiceEditar').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/servicios.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: '¡Acualizado con éxito!',
                    text: '',
                    heightAuto: false,
                    confirmButtonText: "Aceptar",
                })
                listarServicio()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}


function anularServicio(idService){
    var parametros = {
        "accion": "anularServicio",
        "idService": idService
    };

    $.ajax({
        data: parametros,
        url: '../view/http/servicios.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    icon: 'success',
                    title: 'Cambio de estado con éxito',
                    text: '',
                    heightAuto: false,
                    confirmButtonText: "Aceptar",
                })
                listarServicio()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

