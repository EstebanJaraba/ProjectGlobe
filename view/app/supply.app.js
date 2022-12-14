function registerSupply() {

    var parametros = {
        "accion": "registerSupplys",
        "name": document.getElementById('nameSupply').value,
        "partNumber": document.getElementById('partNumberSupply').value,
        "quantity": document.getElementById('quantitySupply').value,
        "price": document.getElementById('priceSupply').value,
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
        type: "post",
        beforeSend: function () {},
        success: function (data) {
            if (JSON.parse(data) == 'fallo') {
                Swal.fire({
                    icon: 'error',
                    position: 'center',
                    text: 'Debes ingresar todos los campos',
                    confirmButtonText: 'Aceptar',
                })
                listarInsumos()
            } else if (JSON.parse(data) == 'min') {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    text: '¡Ingrese un nombre valido!',
                    timer: 1500
                })
                listarInsumos()
            } else if (JSON.parse(data) == 'num') {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    text: '¡Los campos deben ser numericos!',
                    confirmButtonText: 'Aceptar'
                })
                listarInsumos()
            } else if (JSON.parse(data) == 'pa') {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                    text: 'Este insumo ya existe, ingrese otro'
                    
                })
                listarInsumos()
            } else if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: '¡Registro exitoso!',
                    confirmButtonText: 'Aceptar'
                })
                listarInsumos()
                Cerrar()
            } else if (JSON.parse(data) == 'error') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    text: '¡Registro fallido!',
                    timer: 1500
                })
                listarInsumos()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });

}

function Cerrar() {
    $('#registerSupplys').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $("#registerSupplys input").val("");
}

function listarInsumos() {
    eliminarFilasTableSupplys();

    var tableSupplys = $("#tableSupplys").DataTable();

    tableSupplys.clear();
    tableSupplys.destroy();

    var parametros = {
        accion: "select_ListSupplys",
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
        type: "post",
        beforeSend: function (data) {
            //mostrar_loading();
        },
        success: function (data) {


            for (var i in JSON.parse(data).registros) {
                agregarFila_Supplys(
                    JSON.parse(data).registros[i].idSupply,
                    JSON.parse(data).registros[i].nameSupply,
                    JSON.parse(data).registros[i].partNumber,
                    JSON.parse(data).registros[i].quantity,
                    JSON.parse(data).registros[i].price,
                    JSON.parse(data).registros[i].stateSupply,
                    " "
                );
            }

            $("#tableSupplys").DataTable({
                dom: "Bfrtip",
                buttons: ["copy", "csv", "excel", "pdf", "print"],
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

function agregarFila_Supplys(idSupply, nameSupply, partNumber, quantity, price, stateSupply, acciones) {
    if (stateSupply == 1) {
        verEstado = '<button class="btn btn-success btn-sm col-12 " style="cursor: text">ACTIVO</button>'
    } else if (stateSupply == 0) {
        verEstado = '<button class="btn btn-danger btn-sm col-12 " style="cursor: text">INACTIVO</button>'
    }
    if (stateSupply == 1) {
        anular = `<button class="btn btn-outline-danger btn-sm" onclick="actualizarEstado(${idSupply},${stateSupply})"><i class="bi bi-clipboard2-minus"></i></button>`

    } else if (stateSupply == 0) {
        anular = `<button class="btn btn-outline-success btn-sm" onclick="actualizarEstado1(${idSupply},${stateSupply})"><i class="bi bi-clipboard2-plus"></i></button>`
    }

    let datosSupply = "'" + idSupply + "','" + nameSupply + "','" + partNumber + "','" + quantity + "','" + price + "','" + stateSupply + "'";

    var htmlTags = `
        <tr>
          <td class="d-flex justify-content-center"> ${idSupply}</td>
          <td> ${nameSupply}</td>
          <td> ${partNumber}</td>
          <td> ${quantity}</td>
          <td> ${price} </td>
          <td > ${verEstado}</td>
          <td class="d-flex justify-content-center">
            <button data-toggle="modal" data-target="#updateSupplys" class="btn btn-outline-success btn-sm" onclick="tomarDatos(${datosSupply})"><i class="bi bi-pencil-square"></i></button>
            ${anular}
            </td>
        </tr>`;
    $("#tableSupplys tbody").append(htmlTags);
}


function eliminarFilasTableSupplys() {
    var n = 0;
    $("#tableSupplys tbody tr").each(function () {
        n++;
    });
    for (i = n - 1; i > 1; i--) {
        $("#tableSupplys tbody tr:eq('" + i + "')").remove();
    }
}

function tomarDatos(idSupply, nameSupply, partNumber, quantity, price, stateSupply) {
    document.getElementById('idSupplyUpdate').value = idSupply
    document.getElementById('nameSupplyUpdate').value = nameSupply
    document.getElementById('partNumberSupplyUpdate').value = partNumber
    document.getElementById('quantitySupplyUpdate').value = quantity
    document.getElementById('priceSupplyUpdate').value = price
    document.getElementById('stateSupplyUpdate').value = stateSupply
}

function updateSupply() {
    var parametros = {
        "accion": "updateSupply",
        "id": document.getElementById('idSupplyUpdate').value,
        "name": document.getElementById('nameSupplyUpdate').value,
        "partNumber": document.getElementById('partNumberSupplyUpdate').value,
        "quantity": document.getElementById('quantitySupplyUpdate').value,
        "price": document.getElementById('priceSupplyUpdate').value,
        "state": document.getElementById('stateSupplyUpdate').value
    };

    $.ajax({
        data: parametros,
        url: "../view/http/supplys.controller.php",
        type: "post",
        beforeSend: function () {

        },
        success: function (data) {

            if (JSON.parse(data) == 'ok') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: '¡Actualización exitosa!',
                    timer: 1500
                })
                listarInsumos()
                CerrarU()
            }
        },
        error: function () {
            console.log("No se ha podido obtener la información")
        },
    });
}

function CerrarU() {
    $('#updateSupplys').modal('hide');
    $('body').removeClass('modal-open');
    $('.modal-backdrop').remove();
    $("#updateSupplys input").val("");
}



function actualizarEstado(idSupply, stateSupply) {

    Swal.fire({
        title: '¿Estas seguro?',
        text: "Vas ha inhabilitar un insumo",
        icon: 'warning',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            let parametros = {
                accion: "actualizarEstadoActivo",
                id: idSupply,
                estado: stateSupply,
            };
        
            $.ajax({
                data: parametros,
                url: "../view/http/supplys.controller.php",
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
                        listarInsumos();
                    } else if (JSON.parse(data) == "error") {
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            text: "Actualización de estado fallida",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        listarInsumos();
                    }
                },
                error: function (error) {
                    console.log("No se a podido editar la información " + error);
                },
            });
        }
    })
    
}

function actualizarEstado1(idSupply, stateSupply) {

    Swal.fire({
        title: '¿Estas seguro?',
        text: "Vas ha habilitar este insumo",
        icon: 'warning',
        cancelButtonText: 'Cancelar',
        showCancelButton: true,
        confirmButtonText: 'Aceptar'
    }).then((result) => {
        if (result.isConfirmed) {
            let parametros = {
                accion: "actualizarEstadoInactivo",
                id: idSupply,
                estado: stateSupply,
            };
        
            $.ajax({
                data: parametros,
                url: "../view/http/supplys.controller.php",
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
                        listarInsumos();
                    } else if (JSON.parse(data) == "error") {
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            text: "Actualización de estado fallida",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                        listarInsumos();
                    }
                },
                error: function (error) {
                    console.log("No se a podido editar la información " + error);
                },
            });
        }
    })
    
}