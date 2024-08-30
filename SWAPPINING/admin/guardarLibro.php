<?php
error_reporting(0);
ini_set('display_errors', 1);
require_once '../conexion.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtener datos del formulario
  $nombreLibro = $_POST['nombreLibro'];
  $autorLibro = $_POST['autorLibro'];
  $fechaLibro = $_POST['fechaLibro'];
  $descripcion = $_POST['descripcionLibro'];



  // Guardar la imagen en el servidor
  $portadas = $_FILES['portadas']['name'];
  $imagen_temp = $_FILES['portadas']['tmp_name'];
  $carpeta_destino = 'C:\\xampp1\\htdocs\\Proyecto3\\images\\librospublicados\\'; // Cambia esto con la ruta correcta
  move_uploaded_file($imagen_temp, $carpeta_destino . '/' . $portadas);

  // Insertar datos en la base de datos
  $conn = "INSERT INTO libros (nombreLibro, autorLibro, fechaLibro,descripcionLibro , portadas)
                 VALUES ('$nombreLibro', '$autorLibro', '$fechaLibro', '$descripcion','$portadas')";

  $resultado = mysqli_query($conexion, $conn);

  if ($resultado) {
    header("location: ../descubrirlibros.php");
  } else {
    echo "Error al guardar el libro: " . mysqli_error($conexion);
  }

  // Cierra la conexión a la base de datos
  mysqli_close($conexion);
}
