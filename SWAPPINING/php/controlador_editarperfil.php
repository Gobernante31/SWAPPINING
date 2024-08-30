<?php
require_once 'conexion.php';
require_once './lib/funciones.php';

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener el ID del usuario actual desde la sesión
  $userID = $_SESSION['idusuario'];

  // Verificar y actualizar el nombre de usuario si se envió
  if (!empty($_POST['nombre'])) {
    $newNombre = $_POST['nombre'];
    if (actualizarNombreUsuario($userID, $newNombre, $conn)) {
      echo '<div class="mensaje_ok" id="message">Nombre de usuario actualizado con éxito.</div>';
      $_SESSION['nombre'] = $newNombre; // Actualizar la variable de sesión
    } else {
      echo '<div class="mensaje_error" id="message">Error al actualizar el nombre de usuario.</div>';
    }
  }


  // Verificar y actualizar la contraseña si se envió
  if (!empty($_POST['password'])) {
    $newPassword = $_POST['password'];
    $currentPassword = $_POST['currentPassword'];
    if (verificarContraseñaActual($userID, $currentPassword, $conn)) {
      if (actualizarContraseña($userID, $newPassword, $conn)) {
        echo '<div class="mensaje_ok" id="message">Se actualizó la contraseña correctamente.</div>';
      } else {
        echo '<div class="mensaje_error" id="message">Error al actualizar la contraseña.</div>';
      }
    } else {
      echo '<div class="mensaje_error" id="message">La contraseña actual no es válida.</div>';
    }
  }

  // Verificar y actualizar el correo electrónico si se envió
  if (!empty($_POST['correo'])) {
    $newCorreo = $_POST['correo'];
    $currentPassword = $_POST['currentPassword'];
    // Aquí puedes agregar la validación del correo electrónico si es necesario
    if (verificarContraseñaActual($userID, $currentPassword, $conn)) {
      if (actualizarCorreoUsuario($userID, $newCorreo, $conn)) {
        echo '<div class="mensaje_ok" id="message">Correo electrónico actualizado con éxito.</div>';
        $_SESSION['correo'] = $newCorreo; // Actualizar la variable de sesión
      } else {
        echo '<div class="mensaje_error" id="message">Error al actualizar el correo electrónico.</div>';
      }
    } else {
      echo '<div class="mensaje_error" id="message">La contraseña actual no es válida.</div>';
    }
  }

  // Verificar y actualizar la fecha de nacimiento si se envió
  if (!empty($_POST['fechaNacimiento'])) {
    $newFechaNacimiento = $_POST['fechaNacimiento'];
    // Puedes agregar validaciones adicionales para la fecha de nacimiento si es necesario
    if (actualizarFechaNacimiento($userID, $newFechaNacimiento, $conn)) {
      echo '<div class="mensaje_ok" id="message">Fecha de nacimiento actualizada con éxito.</div>';
      $_SESSION['fechaNacimiento'] = $newFechaNacimiento; // Actualizar la variable de sesión
    } else {
      echo '<div class="mensaje_error" id="message">Error al actualizar la fecha de nacimiento.</div>';
    }
  }

  // Verificar y actualizar la descripción del usuario si se envió
  if (!empty($_POST['txtdescripcion'])) {
    $newDescription = $_POST['txtdescripcion'];
    if (actualizarDescripcionUsuario($userID, $newDescription, $conn)) {
      echo '<div class="mensaje_ok" id="message">Descripción actualizada con éxito.</div>';
    } else {
      echo '<div class="mensaje_error" id="message">Error al actualizar la descripción.</div>';
    }
  }
}
