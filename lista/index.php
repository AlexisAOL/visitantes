<?php  include_once("../php/guard.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <title>Lista de visitantes</title>
</head>
<body>
    <?php include_once("../components/navbar.php"); 
    ?>
    <div class="container">
                  <table class='table table-striped table-bordered table-hover' id="lista">
                    <thead>
                      <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Email</th>
                      <th>Telefono</th>
                      <th>Fecha de Nacimiento</th>
                      <th>Categoria</th>
                      <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
    
      <!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar informacion del cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"id="formularioModal">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id='btnCerrar'data-bs-dismiss="modal">Cerrar</button>
        <button type="button" id="btnActualizar"class="btn btn-primary">Actualizar</button>
      </div>
    </div>
  </div>
</div>
<script src="../js/jquery-3.6.0.min.js"></script>
<script src="../js/all.min.js"></script>
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/jquery.validate.js"></script>



<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>


<script>
 $(document).ready(function() {
    var tabla = $('#lista').DataTable({
        "lengthMenu": [[10, 25, 50, 75, 100], [10, 25, 50, 75, 100]],
        "iDisplayLength": 50
    });

    cargarDatos();

    $(document).on('click', '.delete', function() {
        var id = $(this).data('idv');
        borrar(id);
    });

    $(document).on('click', '.edit', function() {
        var id = $(this).data('idv');
        editar(id);
    });

    $('#editarModal').on('shown.bs.modal', function() {
        var id = $('#id').val();
        $('#formularioModal').load('../components/frmInformacion.php', { 'id': id });
    });

    $('#editarModal').on('hide.bs.modal', function() {
        cargarDatos(); // Volver a cargar los datos después de cerrar el modal
    });

    $('#btnActualizar').on('click', function() {
        const datos = $('#frmActualizar').serialize() + "&accion=update";
        $.ajax({
            url: "../php/usuarioAction.php",
            type: "POST",
            data: datos,
            success: function(response) {
                if (response === "success") {
                    console.log(response);
                    $('#editarModal').modal('hide'); // Cerrar el modal
                    cargarDatos(); // Actualizar la fila en el DataTable
                }
            }
        });
    });

    function cargarDatos() {
        $.ajax({
            url: "../php/usuarioAction.php",
            type: "POST",
            data: { accion: "leer" },
            success: function(response) {
                var datos = $(response);
                tabla.clear().draw();
                tabla.rows.add(datos).draw();

                // Opcional: Puedes resaltar la fila actualizada utilizando un identificador único
                var idActualizado = $('#id').val();
                tabla.row('#' + idActualizado).nodes().to$().addClass('table-success');
            }
        });
    }

    // ...

});
  
    function alerta(msg){
      $("#msg").html(msg);
      $("#msg").fadeIn(300,function(){
        setTimeout(function(){
          $("#msg").fadeOut(300);
        },2000);
      });
    }
    function borrar(id) {
  if (confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
    $.ajax({
      url: '../php/usuarioAction.php',
      data: {
        id: id,
        accion: 'delete'
      },
      type: 'POST',
      success: function(response) {
        if (response === 'success') {
          // Eliminar la fila del DataTable
          $('#lista').DataTable().row('#' + id).remove().draw();

          // Opcional: Mostrar un mensaje de éxito o realizar otras acciones después de borrar el elemento
          alerta('El elemento ha sido eliminado correctamente.');
        } else {
          // Opcional: Mostrar un mensaje de error o realizar otras acciones si ocurre un error al borrar el elemento
          alert('Ocurrió un error al eliminar el elemento.');
        }
      }
    });
  }
}


  
 
    //--------------cambiar boton a activado
    function editar(id) {
  $('#formularioModal').load('../components/frmInformacion.php', { 'id': id });
  $('#editarModal').modal('show');
}
                
                
                
           
 

</script>
</body>
</html>
    
