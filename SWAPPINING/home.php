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
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">

  <link rel="shortcut icon" href="images/img/SWAP.png">
</head>

<body>

  <!-- Header -->
  <?php navbar() ?>

  <!-- Nosotros -->
  <section class="about container">
    <h2>Nosotros</h2>
    <p>
      Una página web como Swappining, que se dedica al intercambio de libros sin requerir pagos monetarios, es una
      plataforma muy beneficiosa y ofrece múltiples ventajas tanto para los amantes de la lectura como para la
      comunidad en general. Swappining sigue el concepto de trueque, lo que significa que las personas no tienen que
      gastar dinero en la adquisición de libros nuevos. Esto puede ayudar a quienes tienen presupuestos limitados y
      promover una forma más sostenible de consumo de libros. Y finalmente es una iniciativa valiosa que puede fomentar
      la lectura, la sostenibilidad, la interacción social y la economía local. Su enfoque en el trueque de libros
      proporciona una plataforma emocionante para los amantes de la lectura que buscan nuevas oportunidades de explorar
      el mundo literario sin tener que gastar dinero.
    </p>
    <div class="icons-about">
      <div class="icon-about">
        <img src="images/calendario.svg" alt="">
        <div class="icon-text">
          <h3>2023</h3>
          <p>Nuestro comienzo</p>
        </div>
      </div>
      <div class="icon-about">
        <img src="images/mobileapp.svg" alt="">
        <div class="icon-text">
          <h3>2024</h3>
          <p>Metas</p>
        </div>
      </div>
      <div class="icon-about">
        <img src="images/computador.svg" alt="">
        <div class="icon-text">
          <h3>2023 - ∞</h3>
          <p>Entregar conocimiento</p>
        </div>
      </div>
    </div>
    <a class="btn-b" href="IndexUsuario.html">Más información</a>
  </section>

  <!-- Servicios -->
  <main class="services">
    <div class="container">
      <div class="services-container">
        <div>
          <div class="services-cards">
            <div class="card">
              <img src="images/book1.svg" alt="" class="iconos">
              <h3>Facilidad</h3>
              <p>Solo subes tu libro a la plataforma y esperas que alguien más quiera intercambiar tu libro.</p>
            </div>
            <div class="card">
              <img src="images/mapa.svg" alt="" class="iconos">
              <h3>Alcance nacional</h3>
              <p>Fácil acceso a usuarios a nivel nacional.</p>
            </div>
          </div>
          <div class="services-cards">
            <div class="card">
              <img src="images/intercambio.svg" alt="" class="iconos">
              <h3>Trueque</h3>
              <p>El poseer un libro te permite comerciarlo por otro.</p>
            </div>
            <div class="card">
              <img src="images/conocimiento.svg" alt="" class="iconos">
              <h3>Conocimiento</h3>
              <p>Compartir conocimiento es la clave para el avance del mundo.</p>
            </div>
          </div>
        </div>
        <div class="services-txt">
          <h2>Servicios</h2>
          <p>
            Uno de los principales objetivos de Swappining como plataforma de intercambio es la sencillez con la que
            puedes hacer un canje por otro libro, sin ninguna otra forma monetaria de por medio. Por lo tanto, si eres
            poseedor de uno, ya puedes usar nuestra plataforma.
          </p>
          <a class="btn-c" href="IndexUsuario.html">Contacto</a>
        </div>
      </div>
    </div>
  </main>

  <!-- Información -->
  <section class="portfolio">
    <div class="container">
      <div class="container-portfolio">
        <h2>Información</h2>
        <p class="p-txt">
          El gran reto virtual para nosotros no para en esta página, sino en poder traer varios atributos y enviarlos a
          múltiples plataformas para que todos tengan un fácil acceso.
        </p>
        <div class="content-portfolio">
          <img class="img-01" src="images/camera_film_phone_movie_call_video_icon_250762.svg" alt="" style="width: 300px;">
          <div class="txt-portfolio">
            <h3>APP</h3>
            <p>Llegar a los dispositivos móviles es uno de los retos a cumplir.</p>
          </div>
        </div>
        <div class="content-portfolio">
          <div class="txt-portfolio">
            <h3>Alcance</h3>
            <p>Conocer nuevos horizontes es un sueño.</p>
          </div>
          <img class="img-02" src="images/map_115126.svg" alt="" style="width: 200px;">
        </div>
        <div class="content-portfolio">
          <img class="img-03" src="images/favorite_romantic_wedding_count_love_like_icon_250750.svg" alt="" style="width: 250px;">
          <div class="txt-portfolio">
            <h3>Actualización</h3>
            <p>Las constantes actualizaciones y el trabajo con el corazón son un hecho.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container-f">
      <div class="footer-link">
        <div class="link">
          <h3>Menú</h3>
          <ul>
            <li><a href="IndexUsuario.html">Inicio</a></li>
            <li><a href="IndexUsuario.html">Nosotros</a></li>
            <li><a href="descubrirlibros.php">Descubrir</a></li>
            <li><a href="IndexUsuario.html">Contacto</a></li>
          </ul>
        </div>
        <div class="link">
          <h3>Síguenos</h3>
          <div class="socials">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
          <h3>Suscríbete</h3>
          <form>
            <input type="email" placeholder="Correo">
            <input class="btn-f" type="submit" value="Enviar">
          </form>
        </div>
      </div>
      <hr>
      <div class="footer-text">
        <p>Política de privacidad</p>
        <p>Todos los derechos reservados</p>
      </div>
    </div>
  </footer>

  <script src="./js/chat.js"></script>
</body>

</html>