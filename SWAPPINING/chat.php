<?php
session_start();

// Verificar si el usuario está autenticado
if (empty($_SESSION['idusuario'])) {
  header("Location: ./login_register.php");
  exit();
}

// Incluir los archivos necesarios
require_once './lib/navbar.php';
require_once './lib/funciones.php';

// Obtener la ID del otro usuario del parámetro de la URL
$idOtroUsuario = isset($_GET['id']) ? $_GET['id'] : null;

// Verificar si se proporcionó la ID del otro usuario
if ($idOtroUsuario === null) {
  // Redirigir si no se proporciona la ID del otro usuario
  header("Location: chatusuarios.php");
  exit();
}

// Obtener información del usuario actual
$informacionUsuarioActual = obtenerUsuarioPorId($conn, $_SESSION['idusuario']);

// Obtener información del otro usuario
$informacionUsuario = obtenerUsuarioPorId($conn, $idOtroUsuario);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="estilos/chatDavid.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz@6..12&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./css/chat.css">
  <link rel="stylesheet" href="./css/estiloindexusuario.css">

  <script src="https://kit.fontawesome.com/2cb25f2c39.js"></script>
  <title>Chat</title>
</head>

<body>
  <!-- Header -->
  <?php navbar() ?>


  <div class="container">
    <divi class="informacion_perfil">
      <div class="info_perfil">
        <img class="profile-picture" src="./images/SWAPPINNING.png" alt="Profile Picture">
        <span class="username"><?php echo $informacionUsuario['nombre']; ?></span>
      </div>
      <a href="chatusuarios.php"><i class="fas fa-arrow-left"></i> Volver a Chats</a>
    </divi>
    <!-- Contenedor de mensajes -->
    <div class="message-container">
      <!-- Mensajes -->
      <div class="messages">
        <!-- Los mensajes serán cargados dinámicamente con PHP -->
      </div>
      <!-- Estructura del teclado -->
      <div class="message-input">
        <form id="message-form">
          <input type="text" id="message" class="message-field" placeholder="Escribe un mensaje...">
          <label for="file-upload" class="file-label"><i class="fas fa-paperclip"></i></label>
          <input type="file" id="file-upload" class="file-upload" accept="image/*">
          <button type="submit" class="send-button"><i class="fas fa-paper-plane"></i></button>
        </form>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // Cargar mensajes al cargar la página
      loadMessages();

      // Enviar mensaje
      $('#message-form').submit(function(event) {
        event.preventDefault();
        var message = $('#message').val();
        if (message.trim() != '') {
          sendMessage(message);
          $('#message').val('');
        }
      });

      // Cargar mensajes (simulado con mensajes estáticos)
      function loadMessages() {
        // Simulamos carga de mensajes
        var messages = [{
            type: 'sent',
            content: 'Hola! ¿Cómo estás?'
          },
          {
            type: 'received',
            content: 'Hola! Bien, gracias ¿Y tú?'
          },
          {
            type: 'sent',
            content: 'Estoy bien, gracias'
          }
        ];

        // Mostrar mensajes
        messages.forEach(function(msg) {
          $('.messages').append(`<div class="message ${msg.type}">${msg.content}</div>`);
        });

        // Hacer scroll al fondo del contenedor de mensajes
        $('.message-container').scrollTop($('.message-container')[0].scrollHeight);
      }

      // Enviar mensaje (simulado)
      function sendMessage(message) {
        // Simulamos envío de mensaje
        $('.messages').append(`<div class="message sent">${message}</div>`);

        // Hacer scroll al fondo del contenedor de mensajes
        $('.message-container').scrollTop($('.message-container')[0].scrollHeight);
      }
    });
  </script>

  <script src="./js/chat.js"></script>
</body>

</html>