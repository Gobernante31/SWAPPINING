<?php
session_start();

require_once './lib/navbar.php';
require_once './lib/funciones.php';

// Obtener el ID del usuario actual
$userId = $_SESSION['idusuario'];

// Uso de la función para obtener la información del usuario
$Usuario = obtenerInformacionUsuario($conn, $userId);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Perfil</title>
  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <link rel="stylesheet" href="./css/perfil.css">
  <link rel="stylesheet" href="./css/fondoPerfil.css">
  <link rel="stylesheet" href="./css/imagen.css">
  <link rel="stylesheet" href="./css/editar.css">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">
  <link rel="shortcut icon" href="images/img/SWAP.png">
</head>

<body>
  <!-- Header -->
  <?php navbar() ?>

  <!-- Contenido del perfil -->
  <div class="container1">
    <form action="" method="POST">
      <center>
        <h1>Editar Perfil</h1>
        <?php
        require_once './php/controlador_editarperfil.php';
        ?>
      </center>
      <div class="profile-picture">
        <img src="images/img/SWAP.png" alt="Tu Foto de Perfil">
      </div>
      <div class="form-group">
        <label for="nombre">Nombre de Usuario</label>
        <input type="text" id="nombre" name="nombre" placeholder="<?php echo $Usuario['nombre']; ?>">
      </div>
      <div class="form-group">
        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="<?php echo $Usuario['correo']; ?>">
      </div>
      <div class="form-group">
        <label for="fechaNacimiento">Fecha de Nacimiento</label>
        <p><?php echo $Usuario['fechaNacimiento']; ?></p>
        <input type="date" id="fechaNacimiento" name="fechaNacimiento">
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Contraseña">
      </div>
      <div class="form-group">
        <label for="currentPassword">Contraseña Actual</label>
        <input type="password" id="currentPassword" name="currentPassword" placeholder="Contraseña Actual">
      </div>
      <div class="form-group">
        <label for="txtdescripcion">Acerca de Mí</label>
        <textarea id="txtdescripcion" name="txtdescripcion" placeholder="<?php echo $Usuario['descripcion']; ?>"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" name="guardar_cambios">Guardar Cambios</button>
      </div>
    </form>
  </div>


  <!-- Footer -->
  <footer class="footer">
    <!-- Footer content -->
  </footer>

  <script src="./js/editarPerfil.js"></script>
  <script src="./js/chat.js"></script>
</body>

</html>