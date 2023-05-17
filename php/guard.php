<?php



//indica que se inicia la sesion
session_start();
//si la sesion no existe entonces mostrara el login
if(!isset($_SESSION['cat'])){
    header("location:../login.php");
    die();
}
//si el cliente no es igual te mostrara el login de vuelta
if($_SESSION['cat']!='Admin' && $_SESSION['cat'] != 'General')
{
    header("location:../login.php");
    die();  
}

?>
