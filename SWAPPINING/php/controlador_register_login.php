<?php
session_start();

// Establecer la variable de acción
$accion = "";

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"])) {
  $accion = $_POST["accion"];
}

// PROCESO DE REGISTRO
if ($accion == "register") {
  // Obtener los datos del formulario y limpiar espacios en blanco
  require_once 'conexion.php';
  require_once './lib/funciones.php';

  // Utilizar funciones de filtrado para asegurar datos limpios
  $nombre = trim($_POST["nombre"]);
  $email = trim($_POST["correo"]);
  $contraseña = trim($_POST["password"]);
  $fechaNacimiento = trim($_POST["fechanacimiento"]);
  $Token = generarToken();

  // Validar la contraseña usando una función
  $validacionContraseña = validarContraseña($contraseña);
  if ($validacionContraseña !== true) {
    echo '<div class="mensaje_error" id="message">' . $validacionContraseña . '</div>';
  } else {
    require_once 'mailer.php';
    // Validar y escapar los datos de entrada
    $nombre = filter_var($nombre, FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Crear una instancia de la clase Mailer
    $mailer = new Mailer();

    try {
      // Inicia una transacción
      $conn->begin_transaction();

      // Verificar si ya existe un usuario con el mismo correo electrónico
      $select_stmt = $conn->prepare("SELECT idusuario FROM usuarios WHERE correo = ?");
      $select_stmt->bind_param("s", $email);
      $select_stmt->execute();
      $select_stmt->store_result();

      if ($select_stmt->num_rows > 0) {
        echo '<div class="mensaje_error" id="message">Ya existe un usuario con ese correo.</div>';
      } else {
        // Utilizar password_hash() para cifrar la contraseña
        $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario si no existe duplicado
        $insert_stmt = $conn->prepare("INSERT INTO usuarios (nombre, Activacion, correo, fechaNacimiento, password, Token, PrivilegioID) VALUES (?, 0, ?, ?, ?, ?, 1)");
        $insert_stmt->bind_param("sssss", $nombre, $email, $fechaNacimiento, $hashed_password, $Token);


        if ($insert_stmt->execute()) {
          $userID = mysqli_insert_id($conn);

          // Éxito al insertar en todas las tablas
          $url = 'http://localhost:3000/php/verify.php?user=' . $nombre . '&token=' . $Token;

          // Define el asunto y el cuerpo antes de usarlos
          $asunto = "Activar cuenta";
          $cuerpo = "<h4>¡Hola " . ucfirst($nombre). " Me alegra verte!</h4>";
          $cuerpo .= "<p>¡Gracias por registrarte en Swappining! <br>Antes de comenzar, solo necesitamos confirmar que eres tú. <br><br>Haga clic a continuación para verificar su dirección de correo electrónico: </p>";
          $cuerpo .= "<a href='$url'>Activar cuenta</a>";

          if ($mailer->enviarEmail($email, $asunto, $cuerpo)) {
            // Éxito al enviar el correo electrónico
            echo '<div class="mensaje_ok" id="verify-message">El correo de verificación se ha enviado a la dirección: ' . $email . '</div>';
          } else {
            // Error al enviar el correo electrónico
            throw new Exception("Ha ocurrido un error al enviar el correo. Asegúrate de que la dirección de correo sea válida.");
          }
        } else {
          throw new Exception("¡Lo siento, ha ocurrido un error al registrar al usuario!");
        }
      }

      // Confirma la transacción
      $conn->commit();
    } catch (Exception $e) {
      // Revierte la transacción en caso de error
      $conn->rollback();
      echo '<div class="mensaje_error" id="message">' . $e->getMessage() . '</div>';
    }
  }
  // Cierra la conexión
  $conn->close();
}

// PROCESO DE LOGIN
if ($accion == "login") {
  if (isset($_POST["txtcorreo"]) && isset($_POST["txtpassword"])) {
    $email_ingresado = $_POST["txtcorreo"];
    $contraseña_ingresada = $_POST["txtpassword"];

    // Incluir el archivo de conexión a la base de datos
    require_once 'conexion.php';

    // Consultar la base de datos para obtener el hash de contraseña y la columna de activación
    $stmt = $conn->prepare("SELECT idusuario, nombre, password, activacion FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $email_ingresado);
    $stmt->execute();
    $stmt->bind_result($userID, $username, $hashed_password, $activacion);
    $stmt->fetch();
    $stmt->close();

    if ($hashed_password && password_verify($contraseña_ingresada, $hashed_password)) {
      if ($activacion == 1) {
        $_SESSION['idusuario'] = $userID;
        $_SESSION['nombre'] = $username;
        header("Location: home.php"); // Redirigir a la página de inicio después de iniciar sesión
        exit();
      } else {
        echo '<div class="mensaje_error" id="message">Su cuenta aún no ha sido activada.</div>';
      }
    } else {
      echo '<div class="mensaje_error" id="message">Credenciales incorrectas.</div>';
    }
    $conn->close();
  }
}
