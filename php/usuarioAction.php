<?php
// Indica que requiere la conexión a la BD
require_once "cn.php";

// Parámetros enviados desde login con AJAX
if (!isset($_POST["accion"])) {
    $accion = "comprobarUsuario";
} else {
    $accion = $_POST["accion"];
}

switch ($accion) {
    case "comprobarUsuario":
        $email = $_POST["email"];
        $contrasena = $_POST["password"];

        // Query a la base de datos para revisar si existe el usuario
        $stmt = $cn->prepare("SELECT b.nombreCategoria FROM visitante a INNER JOIN categoria b ON a.idcategoria=b.idcategoria WHERE email=? AND contrasena=?");
        $stmt->bind_param("ss", $email, $contrasena);
        $stmt->execute();
        $result = $stmt->get_result();

        // Revisa si devuelve un valor
        if ($result->num_rows == 1) {
            // Abre la sesión
            $row = $result->fetch_assoc();
            session_start();
            $_SESSION["cat"] = $row["nombreCategoria"];
            echo "T";
        } else {
            echo "F";
        }

        $stmt->close();
        break;

    case "nuevoUsuario":
        $nombreN = $_POST["nombreN"];
        $apellidosN = $_POST["apellidosN"];
        $emailN = $_POST["emailN"];
        $fechaN = $_POST["fechaN"];
        $telefono = $_POST["telefono"];
        $categoria = $_POST["categoria"];
        $password = $_POST["passwordN"];

        $stmt = $cn->prepare("SELECT * FROM visitante WHERE email=?");
        $stmt->bind_param("s", $emailN);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            echo "F";
        } else {
            $stmt = $cn->prepare("INSERT INTO visitante (nombre, apellidos, email, telefono, fechaNacimiento, contrasena, idcategoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssi", $nombreN, $apellidosN, $emailN, $telefono, $fechaN, $password, $categoria);
            if ($stmt->execute()) {
                echo "T";
            } else {
                echo "F";
            }
            $stmt->close();
        }

        $stmt->close();
        break;

    case "leer":
        $stmt = $cn->prepare("SELECT a.idVisitante, a.nombre, a.apellidos, a.email, a.telefono, a.fechaNacimiento, b.nombreCategoria FROM visitante a INNER JOIN categoria b ON a.idcategoria=b.idcategoria");
        $stmt->execute();
        $result = $stmt->get_result();
        session_start();

        while ($row = $result->fetch_assoc()) {
            $idVisitante = $row["idVisitante"];
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $email = $row["email"];
            $telefono = $row["telefono"];
            $fechaNacimiento = $row["fechaNacimiento"];
            $nombreCategoria = $row["nombreCategoria"];

            echo "<tr id='$idVisitante'>
                <td>$idVisitante</td>
                <td>$nombre</td>
                <td>$apellidos</td>
                <td>$email</td>
                <td>$telefono</td>
                <td>$fechaNacimiento</td>
                <td>$nombreCategoria</td>
                <td>";

            if (isAdminUser()) {
                echo "<i class='fas fa-pencil-alt edit' data-idv='$idVisitante'></i>
                    <i class='fas fa-trash delete' data-idv='$idVisitante'></i>";
            } else {
                echo "No tiene Permiso";
            }

            echo "</td></tr>";
        }

        $stmt->close();
        break;

    case "delete":
        $id = $_POST["id"];
        session_start();

        if (isAdminUser()) {
            $stmt = $cn->prepare("DELETE FROM visitante WHERE idVisitante=?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                // Eliminación exitosa
                echo "success";
            } else {
                // Error al eliminar
                echo "error";
            }

            $stmt->close();
        } else {
            echo "error";
        }

        break;

    case "update":
        session_start();
        $id = $_POST["id"];
        $nombre = $_POST["nombreA"];
        $apellidos = $_POST["apellidosA"];
        $email = $_POST["emailA"];
        $fecha = $_POST["fechaNA"];
        $telefono = $_POST["telefonoA"];
        $categoria = $_POST["categoriaA"];
        $password = $_POST["passwordA"];

        if (isAdminUser()) {
            $stmt = $cn->prepare("UPDATE visitante SET nombre=?, apellidos=?, email=?, telefono=?, fechaNacimiento=?, contrasena=?, idcategoria=? WHERE idVisitante=?");
            $stmt->bind_param("ssssssii", $nombre, $apellidos, $email, $telefono, $fecha, $password, $categoria, $id);

            if ($stmt->execute()) {
                // Actualización exitosa
                echo "success";
            } else {
                // Error al actualizar
                echo "error";
            }

            $stmt->close();
        } else {
            echo "error";
        }

        break;
}

function isAdminUser()
{
    return ($_SESSION["cat"] == "Admin");
}
?>