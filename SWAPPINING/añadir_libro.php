<?php
session_start();

if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
  die();
}

require_once './lib/navbar.php';
require_once './lib/funciones.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swappining</title>
  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <link rel="stylesheet" href="./css/añadirlibro.css">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">

  <link rel="shortcut icon" href="images/img/SWAP.png">
</head>

<body>
  <!-- Header -->
  <?php navbar() ?>

  <div class="formulario_section">
    <h1>PUBLICA TU LIBRO</h1>
    <form class="formulario_libros" action="" method="post" enctype="multipart/form-data">
      <div>
        <?php
        require_once './php/controlador_subir_libro.php';
        ?>
      </div>

      <div class="form-group">
        <label for="nombreLibro">Nombre del libro:</label>
        <input type="text" id="nombreLibro" name="nombreLibro" placeholder="Ingresa el nombre del libro" required>
      </div>
      <div class="form-group">
        <label for="autorLibro">Autor del libro:</label>
        <input type="text" id="autorLibro" name="autorLibro" placeholder="Ingresa el autor del libro" required>
      </div>
      <div class="form-group">
        <label for="fechaLibro">Fecha de publicación:</label>
        <input type="date" id="fechaLibro" name="fechaLibro" required>
      </div>
      <div class="form-group">
        <label for="descripcionLibro">Descripción del libro:</label>
        <textarea id="descripcionLibro" name="descripcionLibro" placeholder="Ingresa una breve descripción del libro" required></textarea>
      </div>
      <div class="form-group">
        <label for="portadas">Imagen del libro:</label>
        <input type="file" id="portadas" name="portadas" accept="image/*" required>
      </div>
      <button type="submit">Guardar Cambios</button>
    </form>
  </div>



  <footer class="footer">
    <div class="container-f">
      <div class="footer-link">
        <div class="link">
          <h3>Menu</h3>
          <ul>
            <li><a href="Index.html">Inicio</a></li>
            <li><a href="Index.html">Nosotros</a></li>
            <li><a href="descubrirlibros.php">Descubrir</a></li>
            <li><a href="Index.html">Contacto</a></li>
          </ul>
        </div>
        <div class="link">
          <h3>Siguenos</h3>
          <div class="socials">
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
          </div>
          <h3>Suscribete</h3>
          <form>
            <input type="email" placeholder="Correo">
            <input class="btn-f" type="submit" value="Enviar">
          </form>
        </div>
      </div>
      <hr>
      <div class="footer-text">
        <p>Politica de privacidad</p>
        <p>Todos los derechos reservados</p>
      </div>
    </div>
  </footer>

  <script src="./js/chat.js"></script>
</body>

</html>