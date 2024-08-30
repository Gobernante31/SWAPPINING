<?php
session_start();

if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
}

$idusuario = $_SESSION['idusuario'];

require_once './lib/navbar.php';
require_once './lib/funciones.php'; // Incluye el archivo con las funciones

// Verificar si se ha enviado el ID del libro por POST
if (isset($_POST['idlibros'])) {
  $idLibroSolicitado = $_POST['idlibros'];

  // Obtener la información del libro por su ID
  $libro = obtenerLibroPorId($conn, $idLibroSolicitado);

  // Verificar si el libro se encontró
  if (!$libro) {
    header("Location: ./descubrirlibros.php");
    exit();
  }

  // Obtener la información del usuario por el ID del libro
  $usuario = obtenerInformacionUsuarioPorIDLibro($conn, $libro['idlibros']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/SWAP.ico">
  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/libro.css">
  <link rel="stylesheet" href="./css/perfil.css">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">

  <link rel="shortcut icon" href="images/img/SWAP.png">
  <title>Libro — <?php echo $libro['nombreLibro']; ?></title>
</head>

<body>
  <?php navbar() ?>


  <section class="contenidodavid">
    <div class="cajas c1">
      <img class="imagen-perfil" src="images/img/sesion.png" title="perfil">
      <h3><?php echo isset($usuario['nombre']) ? htmlspecialchars($usuario['nombre']) : 'Nombre de usuario'; ?></h3>
      <div class="rating-box">
        <div class="stars">
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
          <i class="fa-solid fa-star"></i>
        </div>
      </div>
      <p class="p1"><?php echo isset($usuario['descripcion']) ? htmlspecialchars($usuario['descripcion']) : 'Descripción del usuario'; ?></p>
      <a href=""><img src="images/iconos/face.ico"></a>
      <a href=""><img class="imagen-red" src="images/iconos/insta.ico"></a>
      <a href=""><img src="images/iconos/whats.ico"></a>
      <br><br><br><br><br>
      <button class="btn_1">Intercambiar</button>
    </div>

    <div class="book-container">
      <div class='book-image-title'>
        <img class='book-cover' src='<?php echo isset($libro['portadas']) ? htmlspecialchars($libro['portadas']) : 'images/default_cover.jpg'; ?>' alt='Imagen del Libro'>
      </div>

      <div class='book-info'>
        <h1 class='book-title'><?php echo isset($libro['nombreLibro']) ? htmlspecialchars($libro['nombreLibro']) : 'Título del Libro'; ?></h1>
        <h2 class='book-details'><?php echo isset($libro['fechaLibro']) ? htmlspecialchars($libro['fechaLibro']) : 'Fecha del Libro'; ?> - <?php echo isset($libro['autorLibro']) ? htmlspecialchars($libro['autorLibro']) : 'Autor del Libro'; ?></h2>
        <p class='book-description'><?php echo isset($libro['descripcionLibro']) ? htmlspecialchars($libro['descripcionLibro']) : 'Descripción del Libro'; ?></p>
      </div>
    </div>

    <div class="libros-usuario">
      <h2>Libros del Usuario</h2>
      <div class="card-container">
        <?php
        // Aquí debes proporcionar el idusuario deseado en lugar del idusuario actual
        $idUsuarioDeseado = $usuario['idusuario'];

        // Obtener los libros del usuario deseado
        $librosUsuario = obtenerLibrosPorUsuario($conn, $idUsuarioDeseado);

        foreach ($librosUsuario as $libro) : ?>
          <div class="book-card">
            <div class="book-image">
              <img src="<?php echo $libro['portadas']; ?>" alt="Imagen del Libro">
            </div>
            <div class="book-details">
              <h3 class="book-title"><?php echo $libro['nombreLibro']; ?></h3>
              <p class="book-author"><?php echo $libro['autorLibro']; ?></p>
              <p class="book-description"><?php echo $libro['descripcionLibro']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>




    <div class="cajas c3">
      <section class="comments">
        <h2>Comentarios</h2>

        <div class="comment">
          <img src="images/img/sesion.png" alt="Usuario 1">
          <div class="comment-content">
            <h3>Usuario 1</h3>
            <p>¡Gran publicación! Me encantó.</p>
          </div>
        </div>

        <div class="comment">
          <img src="images/img/sesion2.png" alt="Usuario 2">
          <div class="comment-content">
            <h3>Usuario 2</h3>
            <p>Gracias por compartir esta información.</p>
          </div>
        </div>

        <!-- Agrega más comentarios aquí -->

        <div class="comment-form">
          <h3>Deja un comentario</h3>
          <form id="commentForm">
            <textarea id="commentText" placeholder="Escribe tu comentario"></textarea>
            <button type="submit">Enviar</button>
          </form>
        </div>

        <script>
          // Función para manejar el envío del formulario
          function enviarComentario(event) {
            event.preventDefault(); // Evitar que el formulario se envíe automáticamente

            // Obtener el texto del comentario
            var commentText = document.getElementById("commentText").value;

            // Validar que el comentario no esté vacío
            if (commentText.trim() === "") {
              alert("Por favor, escribe un comentario antes de enviar.");
              return;
            }

            // Aquí podrías enviar el comentario a través de una solicitud AJAX
            // Simularemos el envío del comentario con un mensaje en la consola
            console.log("Comentario enviado:", commentText);

            // Limpiar el campo de texto después de enviar el comentario
            document.getElementById("commentText").value = "";
          }

          // Agregar un evento al formulario para manejar el envío del comentario
          document.getElementById("commentForm").addEventListener("submit", enviarComentario);
        </script>

      </section>
    </div>
  </section>

  <footer class="footer">
    <!-- Footer content -->
  </footer>

  <script src="./js/editarPerfil.js"></script>
  <script src="./js/chat.js"></script>
</body>

</html>