<?php


   session_start();
   $_SESSION['cat']="";
    // Redirige al usuario a la página de inicio de sesión o a otra página
    header("Location: login.php"); // Cambia "login.php" por la página que deseas redirigir
    exit();
?>