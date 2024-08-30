<?php
// Inicia la sesión
session_start();

// Verifica si no hay una sesión activa
if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
}

// Incluye los archivos necesarios
require_once './lib/navbar.php';
require_once './lib/funciones.php';

// Obtén el ID del usuario actual de la sesión
$idusuario = $_SESSION['idusuario'];

// Obtén los datos del usuario actual
$usuario = obtenerUsuarioPorId($conn, $idusuario);

// Verifica si se encontraron los datos del usuario
if ($usuario) {
  // Extrae el nombre y correo del usuario
  $nombre = $usuario['nombre'];
  $correo = $usuario['correo'];

  // Obtén los libros publicados por el usuario
  $libros = obtenerLibrosPorUsuario($conn, $idusuario);
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo $nombre; ?></title>
    <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
    <link rel="stylesheet" href="./css/perfil.css">
    <link rel="stylesheet" href="./css/fondoPerfil.css">
    <link rel="stylesheet" href="./css/imagen.css">
    <link rel="stylesheet" href="./css/estiloindexusuario.css">
    <link rel="shortcut icon" href="images/img/SWAP.png">
  </head>

  <body>
    <!-- Barra de navegación -->
    <?php navbar() ?>

    <!-- Contenido del perfil -->
    <main class="container">
      <div class="header">
        <img class="avatar" src="images/SWAPPINNING.png">
        <h1><?php echo $nombre; ?></h1>
        <p><?php echo $correo; ?></p>
      </div>

      <!-- Lista de libros publicados -->
      <div class="libros">
        <h2>Mis libros</h2>
        <div class="grid-container">
          <?php foreach ($libros as $libro) : ?>
            <div class="libro">
              <div class="libro-imagen">
                <?php
                // Verifica si la imagen del libro existe en la ruta especificada
                $imagenLibro = "" . $libro['portadas']; // Corregido el inicio de la ruta
                if (file_exists($imagenLibro)) {
                  echo "<img src='{$imagenLibro}' alt='Imagen del Libro'>";
                } else {
                  // Si la imagen no existe, muestra la imagen por defecto
                  echo "<img src='./images/librospublicados/foto_defecto.png' alt='Imagen por defecto'>"; // Corregida la ruta de la imagen por defecto
                }
                ?>
              </div>
              <div class="libro-detalles">
                <h4><?php echo $libro['nombreLibro']; ?></h4>
                <p>Autor: <?php echo $libro['autorLibro']; ?></p>
                <p><?php echo $libro['descripcionLibro']; ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        <?php
      } else {
        // Si no se encontraron los datos del usuario
        echo "No se encontraron datos del usuario.";
      }
        ?>
        </div>
      </div>


      <section class="comments">
        <h2>Comentarios</h2>

        <div class="comment">
          <img src="images/SWAPPINNING.png" alt="Usuario 1">
          <div class="comment-content">
            <h3>Usuario 1</h3>
            <p>¡Gran publicación! Me encantó.</p>
          </div>
        </div>

        <div class="comment">
          <img src="images/SWAPPINNING.png" alt="Usuario 2">
          <div class="comment-content">
            <h3>Usuario 2</h3>
            <p>Gracias por compartir esta información.</p>
          </div>
        </div>

        <!-- Agrega más comentarios aquí -->

        <div class="comment-form">
          <h3>Deja un comentario</h3>
          <form>
            <textarea placeholder="Escribe tu comentario"></textarea>
            <button>Enviar</button>
          </form>
        </div>
      </section>
    </main>


    <footer class="footer">

      <div class="container-f">

        <div class="footer-link">

          <div class="link">
            <h3>Menu</h3>
            <ul>
              <li><a href="IndexUsuario.html">Inicio</a></li>
              <li><a href="IndexUsuario.html">Nosotros</a></li>
              <li><a href="descubrirlibros.php">Descubrir</a></li>
              <li><a href="IndexUsuario.html">Contacto</a></li>
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

    <script src="./js/editarPerfil.js"></script>
    <script src="./js/chat.js"></script>

  </body>

  </html>