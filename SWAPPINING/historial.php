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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swappining</title>
  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <link rel="stylesheet" href="./css/perfil.css">
  <link rel="stylesheet" href="./css/fondoPerfil.css">
  <link rel="stylesheet" href="./css/imagen.css">
  <link rel="shortcut icon" href="images/img/SWAP.png">
</head>

<body>
  <header>

    <nav>
      <div>
        <img src="images/logo.svg" alt="" class="logo">
      </div>
      <input type="checkbox" id="check">
      <label for="check" class="bar-btn">
        <i class="fas fa-bars"></i>
      </label>
      <ul class="nav-menu">
        <li><a class="active" href="Index.html">Inicio</a></li>
        <li><a href="Index.html">Nosotros</a></li>
        <li><a href="descubrirlibros.php">Categorias</a></li>
        <li><a href="#">chat</a></li>
      </ul>
      <div class="profile-button" id="profile-button" id="profile-menu" class="profile-menu">
        <div class="profile-image">
          <a id="profile-button" href="#"> <img src="images/SWAPPINNING.png" alt="Foto de perfil"></a>
        </div>
      </div>

      <div class="profile-menu" id="profile-menu">
        <a href="Index.html" id="logout-button">Cerrar Sesión</a>
        <a href="editarperfil.html" id="edit-profile-button">Editar Perfil</a>
      </div>
    </nav>

    <div class="banner-text container">
      <div class="text-header">

        <h1> <strong>SWAPPINING</strong>
          Disfruta tu libro
        </h1>

        <p>
          Publica e intercambia tus libros para poder disfrutar de nuevas aventuras con facil accesibildad </p>

        <a class="btn-a" href="Indexlibros.html">Descubrir</a>
        <a href="#"></a>


      </div>

      <div class="img-header">
        <img src="images/SWAPPINNING.png" alt="">
      </div>

    </div>

  </header>


  <center>
    <h1>Historial de Intercambio</h1>
    <center />



    <div class="grid-container">
      <div class="favorite-books">
        <div class="favorite-book">
          <div class="book-image">
            <img src="images/SWAPPINNING.png" alt="Libro 1">
          </div>
          <div class="book-details">
            <h2>Libro 1</h2>
            <p>Fecha de intercambio: 2023-11-01</p>
            <p>Usuario: Usuario 1</p>
          </div>
        </div>
      </div>
      <div class="favorite-books">
        <div class="favorite-book">
          <div class="book-image">
            <img src="images/SWAPPINNING.png" alt="Libro 1">
          </div>
          <div class="book-details">
            <h2>Libro 2</h2>
            <p>Fecha de intercambio: 2023-11-02</p>
            <p>Usuario: Usuario 1</p>
          </div>
        </div>
      </div>
      <div class="favorite-books">
        <div class="favorite-book">
          <div class="book-image">
            <img src="images/SWAPPINNING.png" alt="Libro 1">
          </div>
          <div class="book-details">
            <h2>Libro 3</h2>
            <p>Fecha de intercambio: 2023-12-02</p>
            <p>Usuario: Usuario 1</p>
          </div>
        </div>
      </div>
      <div class="favorite-books">
        <div class="favorite-book">
          <div class="book-image">
            <img src="images/SWAPPINNING.png" alt="Libro 1">
          </div>
          <div class="book-details">
            <h2>Libro 4</h2>
            <p>Fecha de intercambio: 2023-10-02</p>
            <p>Usuario: Usuario 1</p>
          </div>
        </div>
      </div>

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
          <p>Politica de provacidad</p>
          <p>Todos los derechos reservados</p>
        </div>

      </div>

    </footer>
    <script src="./js/editarPerfil.js"></script>
</body>

</html>