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

// Realiza la consulta SQL para obtener los libros y los nombres de los usuarios que los publicaron
$sql = "SELECT libros.*, usuarios.nombre AS nombreUsuario 
        FROM libros 
        INNER JOIN usuarios ON libros.iduser = usuarios.idusuario";

// Ejecuta la consulta y verifica si hay resultados
$resultado = mysqli_query($conn, $sql);
if (!$resultado) {
  // Si hay un error en la consulta, muestra un mensaje y termina el script
  echo "Error en la consulta SQL: " . mysqli_error($conn);
  exit();
}
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
      <h2>Panel de Administrador - Libros</h2>
      <a href="./admin.php">Administrar Usuarios</a>

      <table>
        <thead>
          <tr>
            <th>IdLibro</th>
            <th>Nombrelibro</th>
            <th>autor</th>
            <th>descripcion libro</th>
            <th>fecha Libro</th>
            <th>portadas</th>
            <th>Usuario que publicó</th> <!-- Agregamos una nueva columna -->
            <th>eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          // Muestra filas con la información de los libros y los nombres de los usuarios que los publicaron
          while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<tr>";
            echo "<td>{$fila['idlibros']}</td>";
            echo "<td>{$fila['nombreLibro']}</td>";
            echo "<td>{$fila['autorLibro']}</td>";
            echo "<td>{$fila['fechaLibro']}</td>";
            echo "<td>{$fila['descripcionLibro']}</td>";
            echo "<td>";
            // Obtiene la ruta de la imagen del libro
            $rutaImagen = $fila['portadas'];
            // Verifica si la imagen del libro existe en la ruta especificada
            if (file_exists($rutaImagen)) {
              // Muestra la imagen del libro
              echo "<img class='imagen_admin' src='{$rutaImagen}' alt='Imagen del Libro'>";
            } else {
              // Muestra la imagen por defecto si la imagen del libro no existe
              echo "<img class='imagen_admin' src='./images/librospublicados/foto_defecto.png' alt='Imagen por defecto'>";
            }
            echo "</td>";
            echo "<td>{$fila['nombreUsuario']}</td>"; // Mostramos el nombre del usuario que publicó el libro
            echo "<td><center><button class='delete-btn' onclick='eliminarLibro({$fila['idlibros']})'>Eliminar</button></center></td>";
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
      function eliminarLibro(idlibros) {
        if (confirm("Estas seguro de que quieres eliminar este libro?")) {
          // Redirige al script de PHP que manejará la eliminación
          console.log(`ID de libro: ${idlibros}`);
          window.location.href = `./conexion/eliminarlibro.php?idlibros=${idlibros}`;

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