<?php
session_start();

if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
  die();
}

require_once './lib/navbar.php';
require_once './lib/funciones.php';

// Verificar si el usuario logeado es administrador
$idUsuario = $_SESSION['idusuario'];
if (!esAdmin($conn, $idUsuario)) {
  header("Location: ./perfil.php");
  exit();
}
// Obtener todos los usuarios excepto el usuario actual
$usuarios = obtenerUsuariosExceptoActual($conn, $idUsuario);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Swappining - Panel de Administrador</title>
  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <link rel="stylesheet" href="./css/estiloindex.css">
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">

  <link rel="shortcut icon" href="images/img/SWAP.png">
</head>

<body>

  <!-- Header -->
  <?php navbar() ?>



  <main>
    <div class="container">
      <h2>Panel de Administrador - Usuarios</h2>
      <a href="./adminlibro.php">Administrar libros</a>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo Electrónico</th>
            <th>Fecha de Nacimiento</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Muestra filas con la información de los usuarios
          foreach ($usuarios as $fila) {
            echo "<tr>";
            echo "<td>{$fila['idusuario']}</td>";
            echo "<td>{$fila['nombre']}</td>";
            echo "<td>{$fila['correo']}</td>";
            echo "<td>{$fila['fechaNacimiento']}</td>";
            echo "<td><center><button class='delete-btn' onclick='eliminarUsuario({$fila['idusuario']})'>Eliminar</button></center></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </main>

  <footer class="footer">

    <div class="container-f">

      <div class="footer-link">

        <div class="link">
          <h3>Menu</h3>
          <ul>
            <li><a href="Index.html">Inicio</a></li>
            <li><a href="Index.html">Nosotros</a></li>
            <li><a href="Indexlibros.html">Descubrir</a></li>
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

    <script>
      function editarUsuario(idUsuario) {

        window.location.href = 'adminlibro.php';
      }

      function eliminarUsuario(idUsuario) {
        if (confirm("Estas seguro de que quieres eliminar este usuario?")) {
          // Redirige al script de PHP que manejará la eliminación
          console.log(`ID de usuario: ${idUsuario}`);
          window.location.href = `./admin/eliminar.php?idUsuario=${idUsuario}`;

        }
      }
    </script>


  </footer>

  <script src="./js/chat.js"></script>
</body>

</html>

<?php
// Cierra la conexión a la base de datos
mysqli_close($conn);
?>