<?php
require_once 'conexion.php';

function isNull($nombre, $correo, $contraseña, $edad)
{
  if (strlen(trim($nombre)) < 1 || strlen(trim($correo)) < 1 || strlen(trim($contraseña)) < 1 || strlen(trim($edad)) < 1) {
    return true;
  } else {
    return false;
  }
}

function validarContraseña($contraseña)
{
  // Verifica si la longitud de la contraseña es adecuada
  if (strlen($contraseña) < 8) {
    return "La contraseña debe tener al menos 8 caracteres.";
  }
  // Otras reglas de validación de contraseña pueden ir aquí según tus requisitos
  return true;
}

function checkIfEmailExists($conn, $email)
{
  $stmt = $conn->prepare("SELECT idusuario FROM usuarios WHERE correo = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  $num_rows = $stmt->num_rows;
  $stmt->close();

  return $num_rows; // Retorna el número de filas encontradas
}


function hashPassword($contraseña)
{
  $hash = password_hash($contraseña, PASSWORD_DEFAULT);
  return $hash;
}


function resultBlock($errors)
{
  if (count($errors) > 0) {
    echo "<div id='error' class='alert alert-danger' role='alert'> <a href='#' onclick=\"showHide('error');\">[X]</a><ul>";
    foreach ($errors as $error) {
      echo "<li>" . $error . "</li>";
    }
    echo "</ul>";
    echo "</div>";
  }
}

// Función para generar un token
function generarToken($length = 32)
{
  return bin2hex(random_bytes($length));
}



// Función para obtener todos los usuarios excluyendo al usuario actual
function obtenerUsuarios($conn, $idusuario)
{
  // Prepara la consulta SQL
  $stmt = $conn->prepare("SELECT idusuario, nombre FROM usuarios WHERE idusuario != ?");

  // Verifica si la preparación de la consulta fue exitosa
  if ($stmt === false) {
    return false;
  }

  // Asocia el parámetro a la consulta
  $stmt->bind_param("i", $idusuario);

  // Ejecuta la consulta
  if (!$stmt->execute()) {
    return false;
  }

  // Obtiene el resultado de la consulta
  $result = $stmt->get_result();

  // Verifica si hay filas encontradas
  if ($result->num_rows === 0) {
    return false;
  }

  // Obtiene los datos de los usuarios
  $usuarios = array();
  while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
  }

  // Cierra la consulta y devuelve los usuarios
  $stmt->close();
  return $usuarios;
}


// Función para obtener los libros publicados por un usuario
function obtenerLibrosPorUsuario($conn, $idusuario)
{
  $sql = "SELECT * FROM libros WHERE iduser = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idusuario);
  $stmt->execute();
  $result = $stmt->get_result();
  $libros = $result->fetch_all(MYSQLI_ASSOC);
  $stmt->close();
  return $libros;
}

// Función para obtener los datos de un usuario por su ID
function obtenerUsuarioPorId($conn, $idusuario)
{
  $sql = "SELECT * FROM usuarios WHERE idusuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idusuario);
  $stmt->execute();
  $result = $stmt->get_result();
  $usuario = $result->fetch_assoc();
  $stmt->close();
  return $usuario;
}

// Función para obtener la información del usuario
function obtenerInformacionUsuario($conn, $idUsuario)
{
  // Consultar la base de datos para obtener la información del usuario
  $sql = "SELECT idusuario, PrivilegioID, nombre, correo, fechaNacimiento, Activacion, Token, descripcion 
          FROM usuarios WHERE idusuario = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idUsuario); // Aquí debes usar $idUsuario en lugar de $idusuario
  $stmt->execute();
  $result = $stmt->get_result();
  $usuario = $result->fetch_assoc();
  $stmt->close();
  return $usuario;
}

// Función para obtener la información del usuario por su ID
function obtenerInformacionUsuarioPorID($conn, $idUsuario)
{
  $sql = "SELECT idusuario, PrivilegioID, nombre, correo, fechaNacimiento, Activacion, Token, descripcion 
          FROM usuarios WHERE idusuario = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idUsuario);
  $stmt->execute();
  $result = $stmt->get_result();
  $usuario = $result->fetch_assoc();
  $stmt->close();
  return $usuario;
}

// Función para obtener la información del usuario por el ID del libro
function obtenerInformacionUsuarioPorIDLibro($conn, $idLibro)
{
  $sql = "SELECT u.idusuario, u.PrivilegioID, u.nombre, u.correo, u.fechaNacimiento, u.Activacion, u.Token, u.descripcion 
          FROM usuarios u 
          INNER JOIN libros l ON u.idusuario = l.iduser 
          WHERE l.idlibros = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idLibro);
  $stmt->execute();
  $result = $stmt->get_result();
  $usuario = $result->fetch_assoc();
  $stmt->close();
  return $usuario;
}



// Suponiendo que tienes una conexión a la base de datos llamada $conn
function obtenerLibroPorId($conn, $idLibro)
{
  // Escapar el ID del libro para evitar inyección SQL
  $idLibro = mysqli_real_escape_string($conn, $idLibro);

  // Consulta SQL para obtener el libro por su ID
  $query = "SELECT libros.*, usuarios.nombre AS nombreUsuario, usuarios.correo AS correoUsuario, usuarios.fechaNacimiento AS fechaNacimientoUsuario, usuarios.descripcion AS descripcionUsuario FROM libros INNER JOIN usuarios ON libros.iduser = usuarios.idusuario WHERE libros.idlibros = '$idLibro'";

  // Ejecutar la consulta
  $resultado = mysqli_query($conn, $query);

  // Verificar si se encontró el libro
  if (mysqli_num_rows($resultado) > 0) {
    // Obtener el resultado como un array asociativo
    $libro = mysqli_fetch_assoc($resultado);
    return $libro;
  } else {
    // Si el libro no se encuentra, retornar false
    return false;
  }
}



function obtenerLibrosConUsuario($conn)
{
  // Consulta SQL con un INNER JOIN para obtener el nombre del usuario que publicó el libro
  $sql = "SELECT libros.*, usuarios.nombre AS nombreUsuario FROM libros INNER JOIN usuarios ON libros.iduser = usuarios.idusuario";

  // Ejecutar la consulta
  $result = mysqli_query($conn, $sql);

  // Verificar si la consulta fue exitosa
  if ($result) {
    // Inicializar un array para almacenar los libros
    $libros = array();

    // Recorrer los resultados y almacenarlos en el array de libros
    while ($row = mysqli_fetch_assoc($result)) {
      $libros[] = $row;
    }

    // Liberar el resultado y devolver el array de libros
    mysqli_free_result($result);
    return $libros;
  } else {
    // Si la consulta falla, devolver false
    return false;
  }
}


function guardarLibro($nombreLibro, $autorLibro, $fechaLibro, $descripcionLibro, $rutaImagen, $idUsuario, $conn)
{
  // Preparar la consulta SQL para insertar el libro en la base de datos
  $sql = "INSERT INTO libros (iduser, nombreLibro, autorLibro, descripcionLibro, fechaLibro, portadas) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "isssss", $idUsuario, $nombreLibro, $autorLibro, $descripcionLibro, $fechaLibro, $rutaImagen);
  mysqli_stmt_execute($stmt);

  // Verificar si la consulta fue exitosa
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "El libro se ha guardado correctamente.";
  } else {
    echo "Error al guardar el libro: " . mysqli_error($conn);
  }

  // Cerrar la sentencia
  mysqli_stmt_close($stmt);
}


// Función para verificar si un usuario tiene privilegios de administrador
function esAdmin($conn, $idUsuario)
{
  // Consultar la base de datos para obtener el privilegio del usuario
  $sql = "SELECT PrivilegioID FROM usuarios WHERE idusuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $idUsuario);
  $stmt->execute();
  $stmt->bind_result($privilegioID);
  $stmt->fetch();
  $stmt->close();

  // Verificar si el privilegio del usuario es igual a 2 (privilegio de administrador)
  return $privilegioID == 2;
}

// Función para obtener todos los usuarios excepto el usuario actual
function obtenerUsuariosExceptoActual($conn, $idUsuarioActual)
{
  // Consulta SQL para obtener todos los usuarios excepto el usuario actual
  $query = "SELECT * FROM usuarios WHERE idusuario != ? AND PrivilegioID != 2";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $idUsuarioActual);
  $stmt->execute();
  $resultado = $stmt->get_result();

  // Verificar si la consulta fue exitosa
  if (!$resultado) {
    // Manejar el error
    echo "Error al ejecutar la consulta: " . $stmt->error;
    exit(); // Terminar la ejecución del script
  }

  // Array para almacenar los usuarios
  $usuarios = array();

  // Procesar los resultados de la consulta y guardarlos en el array
  while ($fila = $resultado->fetch_assoc()) {
    $usuarios[] = $fila;
  }

  // Cerrar la consulta
  $stmt->close();

  // Devolver el array de usuarios
  return $usuarios;
}

// Función para verificar la contraseña actual del usuario
function verificarContraseñaActual($userID, $currentPassword, $conn)
{
  $sql = "SELECT password FROM usuarios WHERE idusuario = ? LIMIT 1";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $userID);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows == 1) {
    $stmt->bind_result($password);
    $stmt->fetch();
    return password_verify($currentPassword, $password);
  } else {
    return false;
  }
}



// Función para actualizar el nombre de usuario en la base de datos
function actualizarNombreUsuario($userID, $newUsername, $conn)
{
  $sql = "UPDATE usuarios SET nombre = ? WHERE idusuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $newUsername, $userID);
  return $stmt->execute();
}

// Función para actualizar la contraseña del usuario en la base de datos
function actualizarContraseña($userID, $newPassword, $conn)
{
  $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  $sql = "UPDATE usuarios SET password = ? WHERE idusuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $hashedPassword, $userID);
  return $stmt->execute();
}

// Función para actualizar la descripción del usuario en la base de datos
function actualizarDescripcionUsuario($userID, $newDescription, $conn)
{
  $sql = "UPDATE usuarios SET descripcion = ? WHERE idusuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $newDescription, $userID);
  return $stmt->execute();
}

// Función para actualizar el correo electrónico del usuario en la base de datos
function actualizarCorreoUsuario($userID, $newEmail, $conn)
{
  $sql = "UPDATE usuarios SET correo = ? WHERE idusuario = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $newEmail, $userID);
  return $stmt->execute();
}

// Definición de la función actualizarFechaNacimiento
function actualizarFechaNacimiento($userID, $newFechaNacimiento, $conn)
{
  $stmt = $conn->prepare("UPDATE usuarios SET fechaNacimiento = ? WHERE idusuario = ?");
  $stmt->bind_param("si", $newFechaNacimiento, $userID);
  if ($stmt->execute()) {
    return true;
  } else {
    // La actualización falló
    return false;
  }
}
