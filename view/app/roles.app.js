function registrarRol() {

  var parametros = {
      "accion": "registrarRol",
      "nombre": document.getElementById('name_rol').value,
      "estado": document.getElementById('state_rol').value,
      "permissions" : ""
  }
  var checks = Array();
  $("input[type=checkbox]:checked").each(function(index,check){
       checks.push(check.value);
  });
  parametros.permissions = checks.join(",");
  $.ajax({
      data: parametros,
      url: 'http/roles.controller.php',
      type: 'post',
      beforeSend: function () {
         
      },
      success: function (data) {
          

          if (JSON.parse(data) == 'ok') {
              Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Registro exitoso',
                  showConfirmButton: false,
                  timer: 1500
              })
              listarRoles()
          }

      },
      error: function (error) {
          console.log("No se a podido obtener la información " + error);
      }
  })
}

function listarRoles() {
  eliminaFilastablaRoles();

  var tablaRoles = $('#tablaRoles').DataTable();
  tablaRoles.clear();
  tablaRoles.destroy();

  var parametros = {
      "accion": "seleccionarListaRoles"
  };

  $.ajax({
      data: parametros,
      url: 'http/roles.controller.php',
      type: 'post',
    
      success: function (data) {

          for (var i in JSON.parse(data).registros) {

              agregarFilaRoles(
                  JSON.parse(data).registros[i].id,
                  JSON.parse(data).registros[i].nombre,
                  JSON.parse(data).registros[i].permission,
                  JSON.parse(data).registros[i].id_permisions,
                  JSON.parse(data).registros[i].estado,
                  ""
                );
            }

          $("#tablaRoles").DataTable({
            dom: "Bfrtip",
            buttons: ["csv", "excel", "pdf", "print"],
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            },
            order: [[1, "desc"]],

            });

          
        },


      error: function (error) {
          console.log("No se ha podido obtener la información " + error);
      },
  });
}

function eliminaFilastablaRoles() {
  var n = 0;
  $("#tablaRoles tbody tr").each(function () {
      n++;
  });
  for (i = n - 1; i > 1; i--) {
      $("#tablaRoles tbody tr:eq('" + i + "')").remove();

  }
}

function agregarFilaRoles(id, nombre,permission,id_permisions,estado,acciones) {

  if (estado == 'Activo') {
      varEstado = '<button class="btn btn-success btn-sm col-8">Activo</button>'
  } else if(estado == 'Inactivo') {
      varEstado = '<button class="btn btn-danger btn-sm col-8">Inactivo</button>'
  }

  let datosRol = "'"+id+"', '"+nombre+"', '"+id_permisions+"', '"+estado+"' ";

  var htmlTags = `<tr>
  <td> ${id}</td>
  <td> ${nombre}</td>
  <td><div>${permission}</div></td>
  <td> ${varEstado}</td>
  <td><button data-toggle="modal" data-target="#actualizacionRol" class="btn btn-success btn-sm" onclick="tomarDatos(${datosRol})"><i class="bi bi-pencil-square"></i></button></td>
  </tr>`;

  $("#tablaRoles tbody").append(htmlTags);
}

function tomarDatos(id, nombre,id_permisions,estado) {
  let permission = id_permisions.split(",");
  permission.sort();
  document.getElementById('id_rol_update').value=id
  document.getElementById('name_rol_update').value=nombre
  $("input[name=permisions_update]").each(function(index,check){
        for (const key in permission) {
            if(check.value === permission[key]){
                document.getElementById('permisions_update').checked = true;
            }
        }
  });
  document.getElementById('state_rol_update').value=estado

}

function actualizarRoles() {
  let parametros = {
      "accion": "actualizarRoles",
      "id": document.getElementById('id_rol_update').value,
      "nombre": document.getElementById('name_rol_update').value,
      "state": document.getElementById('state_rol_update').value,
      "permissions" : ""
  }
  var checks = Array();
  $("input[type=checkbox]:checked").each(function(index,check){
       checks.push(check.value);
  });
  parametros.permissions = checks.join(",");
  $.ajax({
      data: parametros,
      url: 'http/roles.controller.php',
      type: 'POST',
      beforeSend: function () {
          
      },
      success: function (data) {
          if (JSON.parse(data) == 'ok') {
              Swal.fire({
                  position: 'top',
                  icon: 'success',
                  title: 'Rol editado con éxito!',
                  showConfirmButton: false,
                  timer: 1500
              })
              listarRoles()
          }
      },
      error: function (error) {
          console.log("No se a podido editar la información " + error);
      }
  })
}

