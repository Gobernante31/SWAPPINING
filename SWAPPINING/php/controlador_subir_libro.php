<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verificar si se ha enviado el formulario
  if (isset($_POST['nombreLibro']) && isset($_POST['autorLibro']) && isset($_POST['fechaLibro']) && isset($_POST['descripcionLibro']) && isset($_FILES['portadas'])) {

    $nombreLibro = $_POST['nombreLibro'];
    $autorLibro = $_POST['autorLibro'];
    $fechaLibro = $_POST['fechaLibro'];
    $descripcionLibro = $_POST['descripcionLibro'];
    $idUsuario = $_SESSION['idusuario']; // Asumiendo que tienes el ID del usuario en la sesión

    require_once 'conexion.php';
    require_once './lib/funciones.php';

    // Obtener la fecha y hora actual
    $fechaHoraActual = date("m-d-Y_H-i-s");
    // Limpiar la fecha y hora para que sea adecuada como nombre de archivo
    $fechaHoraNombreArchivo = str_replace("-", "", $fechaHoraActual);

    // Generar el nombre de la imagen con el ID del usuario, la fecha y la hora de publicación
    $nombreImagen = $idUsuario . '_' . $fechaHoraNombreArchivo . '.png';

    // Guardar la imagen en el servidor
    $rutaImagen = './images/librospublicados/' . $nombreImagen;
    move_uploaded_file($_FILES['portadas']['tmp_name'], $rutaImagen);

    // Guardar el libro en la base de datos
    guardarLibro($nombreLibro, $autorLibro, $fechaLibro, $descripcionLibro, $rutaImagen, $idUsuario, $conn);
  }
}
