<?php
require_once '../conexion.php';

if (isset($_GET['idUsuario'])) {
  $idUsuario = $_GET['idUsuario'];

  // Realiza la consulta para eliminar el usuario
  $sql = "DELETE FROM usuarios WHERE idusuario = $idUsuario";
  $resultadoEliminar = mysqli_query($conn, $sql);

  if ($resultadoEliminar) {
    header("location: ../admin.php");
    exit(); // Agregamos la instrucción exit() después de redirigir para detener la ejecución del script
  } else {
    echo "Error al eliminar el usuario: " . mysqli_error($conn);
    exit(); // Agregamos la instrucción exit() para detener la ejecución del script en caso de error
  }
} else {
  echo "ID de usuario no proporcionado.";
}

// Cierra la conexión a la base de datos
mysqli_close($conn);
