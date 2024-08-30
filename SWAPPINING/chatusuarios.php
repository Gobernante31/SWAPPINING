<?php

// Verifica si hay una sesión de usuario activa
session_start();
if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
}

// Obtén el ID del usuario actual de la sesión
$idusuario = $_SESSION['idusuario'];

require_once 'conexion.php';
require_once './lib/funciones.php';
require_once './lib/navbar.php';

// Llama a la función obtenerUsuarios pasando la conexión y el ID del usuario actual
$usuarios = obtenerUsuarios($conn, $idusuario);

// Verifica si se obtuvieron usuarios
if (is_array($usuarios) && !empty($usuarios)) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
    <title>Inicio de chat</title>
    <link rel="stylesheet" href="./css/estiloindexusuario.css">
    <link rel="stylesheet" href="./css/chatusuarios.css">

  </head>

  <body>

    <!-- Header -->
    <?php navbar() ?>


    <main class="main_chats">
      <div class="container_usuarios">
        <h1>Lista de Usuarios</h1>
        <table>
          <tr>
            <th>Usuario</th>
            <th>Acciones</th>
          </tr>
          <?php foreach ($usuarios as $usuario) : ?>
            <tr>
              <td class="usuario">
                <img src="./images/SWAPPINNING.png" alt="Foto de perfil">
                <a href="chat.php?id=<?php echo $usuario['idusuario']; ?>"><?php echo $usuario['nombre']; ?></a>
              </td>
              <td class="chat-icon"><a href="chat.php?id=<?php echo $usuario['idusuario']; ?>"><i class="fas fa-comment"></i></a></td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </main>

    <script src="./js/chat.js"></script>
  </body>

  </html>
<?php
} else {
  // Si no se encontraron usuarios
  echo "No se encontraron usuarios.";
}
?>