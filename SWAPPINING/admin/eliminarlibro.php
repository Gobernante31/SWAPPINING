<?php
require_once '../conexion.php';

if (isset($_GET['idlibros'])) {
  $idlibros = $_GET['idlibros'];

  // Realiza la consulta para eliminar el usuario
  $conn = "DELETE FROM libros WHERE idlibros = $idlibros";
  $resultadoEliminar = mysqli_query($conexion, $conn);

  if ($resultadoEliminar) {
    header("location: ../adminlibro.php");
  } else {
    echo "Error al eliminar el libro: " . mysqli_error($conexion);
  }
} else {
  echo "libro no proporcionado.";
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
