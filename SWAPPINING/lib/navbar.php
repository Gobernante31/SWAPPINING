<?php
function navbar()
{

?>
  <!-- ——————————————— HEADER ——————————————— -->
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
        <li><a class="active" href="home.php">Inicio</a></li>
        <li><a href="descubrirlibros.php">Libros</a></li>
        <li><a href="chatusuarios.php">Chat</a></li>
        <li><a href="añadir_libro.php">Subir libro</a></li>
        <li class="chat-sidebar-profile">
          <button type="button" class="chat-sidebar-profile-toggle">
            <img src="images/img/SWAP.png" alt="">
          </button>
          <ul class="chat-sidebar-profile-dropdown">
            <li><a href="perfil.php"><i class="ri-user-line"></i>Perfil</a></li>
            <li><a href="editarperfil.php"><i class="ri-user-line"></i>Editar Perfil</a></li>
            <li><a href="./php/controlador_logout.php"><i class="ri-logout-box-line"></i>Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </nav>

    <div class="banner-text container">
      <div class="text-header">
        <h1><strong>SWAPPINING</strong> Disfruta tu libro</h1>
        <p>Publica e intercambia tus libros para poder disfrutar de nuevas aventuras con fácil accesibilidad.</p>
        <a class="btn-a" href="descubrirlibros.php">Descubrir</a>
      </div>
      <div class="img-header">
        <img src="images/SWAPPINNING.png" alt="">
      </div>
    </div>
  </header>

<?php
}
?>