function registroVenta() {
    
    var parametros = {
        "accion": 'registroVenta',
        "nameSale": document.getElementById('nameSale').value,
        "idClient": document.getElementById('idClient').value,
        "idService": document.getElementById('idService').value,
        "stateSale": document.getElementById('stateSale').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/ventas.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Registro exitoso!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  listarVentas()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },
    });
}




function listarVentas(){
    eliminarFilasTableVentas();

    var tableVentas = $("#tableVentas").DataTable();
    
    tableVentas.clear();
    tableVentas.destroy();

    var parametros = {
        accion: "select_listVentas",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/ventas.controller.php",
        type: "post",
        beforeSend: function(){
        
        },

        success: function(data){
            
            for (var i in JSON.parse(data).registros) {

                agregarFila_Ventas(
                    JSON.parse(data).registros[i].idSale,
                    JSON.parse(data).registros[i].nameSale,
                    JSON.parse(data).registros[i].idClient,
                    JSON.parse(data).registros[i].idService,
                    JSON.parse(data).registros[i].stateSale,
                    ""
                );
            }

            $("#tableVentas").DataTable({
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                },
                order: [[1, "desc"]],

            });
        },

        error: function(){
            console.log("No se ha podido obtener la información");
        },
    });

}



function agregarFila_Ventas(idSale, nameSale, idClient, idService, stateSale, acciones){

    if(stateSale == 1){
        mostrarStateSale = '<button class= "btn btn-success btn-sm col-6">Activo</button/>'
    }else if(stateSale == 0){
        mostrarStateSale = '<button class= "btn btn-danger btn-sm col-6">Anulada</button/>'
    }

    let datosVentas = "'"+idSale+"', '"+nameSale+"', '"+idClient+"', '"+idService+"', '"+stateSale+"'";

    var htmlTags = `<tr>
        <td> ${idSale} </td>
        <td> ${nameSale} </td>
        <td> ${idClient} </td>
        <td> ${idService} </td>
        <td> ${mostrarStateSale} </td>
        <td>
           
            <button class= "btn btn-danger btn-sm " onclick="anularVenta(${idSale})"><i class="bi bi-trash3"></i></button/>
        </td>
    </tr>`;
    $("#tableVentas tbody").append(htmlTags);
}


function eliminarFilasTableVentas(){
    var n = 0;
    $("#tableVentas tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableVentas tbody tr:eq('" + i + "')").remove();
        
    }
}


function tomarDatos(idSale, nameSale, idClient, idService, stateSale){
    document.getElementById('idSaleEditar').value = idSale
    document.getElementById('nameSaleEditar').value = nameSale
    document.getElementById('clientSaleEditar').value = idClient
    document.getElementById('serviceSaleEditar').value = idService
    document.getElementById('stateSaleEditar').value = stateSale
}


function editarVenta(){
    var parametros = {
        "accion": 'editarVenta',
        "idSale": document.getElementById('idSaleEditar').value,
        "nameSale": document.getElementById('nameSaleEditar').value,
        "idClient": document.getElementById('clientSaleEditar').value,
        "idService": document.getElementById('serviceSaleEditar').value,
        "stateSale": document.getElementById('stateSaleEditar').value
    };

    $.ajax({
        data: parametros,
        url: '../view/http/ventas.controller.php',
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
                  listarVentas()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}



function anularVenta(idSale){
    var parametros = {
        "accion": "anularVenta",
        "idSale": idSale
    };

    $.ajax({
        data: parametros,
        url: '../view/http/ventas.controller.php',
        type: 'post',
        beforeSend: function(){
            
        },

        success: function(data){
            console.log(data);
            if (JSON.parse(data) == "ok") {
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Venta anulada!...',
                    showConfirmButton: false,
                    timer: 1500
                  })
                  listarVentas()
            }

        },

        error: function(error){
            console.log("No se ha podido obtener la información " + error);
        },

    });
}

