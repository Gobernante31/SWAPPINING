<?php
session_start();

if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
}

require_once './lib/navbar.php';
require_once './lib/funciones.php';

// Obtener los libros con el nombre del usuario
$libros = obtenerLibrosConUsuario($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swappining</title>
  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <link rel="stylesheet" href="./css/estilodescubrirlibros.css">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">
  <link rel="shortcut icon" href="images/img/SWAP.png">
</head>

<body>

  <!-- Header -->
  <?php navbar() ?>


  <main class="main-contenedor">
    <section class="grid">
      <?php if ($libros) : ?>
        <?php foreach ($libros as $libro) : ?>
          <article>
            <?php
            $imagenLibro = "" . $libro['portadas']; // Corregido el inicio de la ruta
            if (file_exists($imagenLibro)) : ?>
              <img src="<?php echo $imagenLibro; ?>" alt="Imagen del Libro">
            <?php else : ?>
              <img src="./images/librospublicados/foto_defecto.png" alt="Imagen por defecto">
            <?php endif; ?>
            <div class="card-text">
              <?php
              $nombreUsuario = ucfirst(strtolower($libro['nombreUsuario']));
              ?>
              <h3><?php echo $libro['nombreLibro']; ?></h3>
              <p>Publicado por: <?php echo $nombreUsuario; ?></p>
              <div class="clasificacion">
                <p><?php echo $libro['fechaLibro']; ?></p>
                <p><?php echo $libro['autorLibro']; ?></p>
                <form action="./libro.php" method="post">
                  <input hidden type="text" name="idlibros" value="<?php echo $libro['idlibros']; ?>">
                  <button type="submit">Solicitar</button>
                </form>
              </div>

            </div>
          </article>
        <?php endforeach; ?>
      <?php else : ?>
        <p>No hay libros disponibles en este momento.</p>
      <?php endif; ?>
    </section>
  </main>



  <br><br><br><br><br><br><br><br><br><br>

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
        <p>Politica de provacidad</p>
        <p>Todos los derechos reservados</p>
      </div>

    </div>

  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./js/chat.js"></script>

</body>

</html>