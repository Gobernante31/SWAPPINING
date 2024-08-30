<?php
// Verificar si se envió el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] == "register") {
  $_SESSION['registro'] = true;
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion"]) && $_POST["accion"] == "login") {
  unset($_SESSION['registro']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="https://unpkg.com/ionicons@4.2.2/dist/css/ionicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/estilologin1.css">
  <link rel="shortcut icon" href="images/img/SWAP.png">
  <title>Iniciar Sesión</title>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-up-container <?php echo isset($_SESSION['registro']) ? 'active' : ''; ?>">
      <form action="" method="POST">
        <input type="hidden" name="accion" value="register"> <!-- Campo oculto para indicar registro -->
        <h1>Crear una cuenta</h1>
        <div class="social-container">
          <!-- Aquí puedes agregar botones o enlaces para registrarse con redes sociales -->
        </div>
        <?php
        // Aquí incluye el archivo controlador_register_login.php solo si es necesario
        if (isset($_POST["accion"]) && $_POST["accion"] == "register") {
          require_once './php/controlador_register_login.php';
        }
        ?>
        <input type="text" id="txtnombre" name="nombre" placeholder="Nombre Completo" required>
        <input type="email" id="txtcorreo" name="correo" placeholder="Correo Electrónico" required>
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
        <div class="mensaje_error" id="message"></div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const messageDiv = document.getElementById('message');

            // Mostrar mensaje cuando el campo de contraseña obtiene el foco
            passwordInput.addEventListener('focus', function() {
              const password = passwordInput.value;
              let message = '';

              if (password.length < 8) {
                message = 'La contraseña debe tener al menos 8 caracteres.';
              } else if (!/\d/.test(password)) {
                message = 'La contraseña debe contener al menos un número.';
              } else if (!/[A-Z]/.test(password)) {
                message = 'La contraseña debe contener al menos una letra mayúscula.';
              }

              messageDiv.textContent = message;
            });

            // Actualizar mensaje mientras el usuario escribe en el campo de contraseña
            passwordInput.addEventListener('input', function() {
              const password = passwordInput.value;
              let message = '';

              if (password.length < 8) {
                message = 'La contraseña debe tener al menos 8 caracteres.';
              } else if (!/\d/.test(password)) {
                message = 'La contraseña debe contener al menos un número.';
              } else if (!/[A-Z]/.test(password)) {
                message = 'La contraseña debe contener al menos una letra mayúscula.';
              }

              messageDiv.textContent = message;
            });
          });
        </script>


        <input type="date" id="dateFechaNacimiento" name="fechanacimiento" placeholder="Fecha de Nacimiento" required>
        <button type="submit">Inscribirse</button>
        <a href="Index.html" class="back-to-home">Volver al inicio</a>
      </form>
    </div>
    <div class="form-container sign-in-container <?php echo isset($_SESSION['registro']) ? '' : 'active'; ?>">
      <form action="" method="POST">
        <input type="hidden" name="accion" value="login"> <!-- Campo oculto para indicar inicio de sesión -->
        <h1>Iniciar sesión</h1>
        <div class="social-container">
          <!-- Aquí puedes agregar botones o enlaces para iniciar sesión con redes sociales -->
        </div>
        <?php
        // Aquí incluye el archivo controlador_register_login.php solo si es necesario
        if (isset($_POST["accion"]) && $_POST["accion"] == "login") {
          require_once './php/controlador_register_login.php';
        }
        ?>
        <input type="email" name="txtcorreo" placeholder="Correo electrónico" required>
        <input type="password" name="txtpassword" placeholder="Contraseña" required>
        <div class="auth-block">
          <span>¿Olvidaste la contraseña? </span>
          <a href="Index.html" class="auth-forgot">Haz clic aquí</a>
        </div>
        <button type="submit">Iniciar sesión</button>
        <a href="Index.html" class="back-to-home">Volver al inicio</a>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Bienvenido a Swappining</h1>
          <p>Si ya tienes una cuenta, inicia sesión aquí</p>
          <button class="ghost" id="signIn">Iniciar sesión</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hola, crea tu cuenta</h1>
          <p>Introduce tus datos personales y comienza tu viaje con nosotros.</p>
          <button class="ghost" id="signUp">Inscribirse</button>
        </div>
      </div>
    </div>
  </div>
  <script src="./js/login1.js"></script>
  <script>
    // Agregar event listeners para cambiar entre formularios
    document.getElementById('signIn').addEventListener('click', () => {
      <?php unset($_SESSION['registro']); ?>
      document.getElementById('container').classList.remove('active');
    });

    document.getElementById('signUp').addEventListener('click', () => {
      <?php $_SESSION['registro'] = true; ?>
      document.getElementById('container').classList.add('active');
    });
  </script>
</body>

</html>