<?php
require_once("../php/cn.php");
$id=$_POST['id'];
$query=mysqli_query($cn,"SELECT * FROM visitante WHERE idVisitante=$id");
$query=mysqli_fetch_array($query);

?>
<form id="frmActualizar">
    
    <input type="hidden" name="id" value="<?php echo $query['idVisitante'];?>" id='id'>
   
                       
                        <label for="">Nombre:</label>
                        <input type="text" id="nombreA" name="nombreA" class="form-control"value="<?php echo $query['nombre'];?>">
                        
                        <label for="">Apellidos:</label>
                         <input type="text" id="apellidosA" name="apellidosA" class="form-control" value="<?php echo $query['apellidos'];?>">
                        

                         <label for="">Telefono:</label>
                        <input type="tel" id="telefonoA" name="telefonoA" class="form-control" value="<?php echo $query['telefono'];?>">
                       
  
                        <label for="">Fecha de Nacimiento:</label>
                        <input type="date" id="fechaNA" name="fechaNA" class="form-control"  value="<?php echo $query['fechaNacimiento'];?>">
                        <label for="">Correo Electronico:</label>
                     <input type="email" id="emailA" name="emailA" class="form-control" value="<?php echo $query['email'];?>">


                     <label for="">Contraseña:</label>
                     <input type="password" id="passwordA" name="passwordA" class="form-control" value="<?php echo $query['contrasena'];?>">



  
                     <label for="">Categoria:</label>
                     <select name="categoriaA" id="categoriaA" class="form-select" aria-label=".form-select">
        <option value="" selected disabled>Selecciona una categoría</option>
        <option value="1" <?php echo ($query['idcategoria'] == 1) ? 'selected' : ''; ?>>Admin</option>
        <option value="2" <?php echo ($query['idcategoria'] == 2) ? 'selected' : ''; ?>>Normal</option>
    </select>
                
                       
                         
</form>
<script>
    //al cargar el documento se ejecuta una funcion
  
    </script>