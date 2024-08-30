<?php
use PHPMailer\PHPMailer\{PHPMailer, SMTP, Exception};

class Mailer
{
  public function enviarEmail($email, $asunto, $cuerpo)
  {
    require_once './phpmailer/src/Exception.php';
    require_once './phpmailer/src/PHPMailer.php';
    require_once './phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);


    try {
      // Server settings
      $mail->SMTPDebug = 0; // Cambia a 2 para habilitar la depuración
      $mail->isSMTP();
      $mail->Host = 'smtp.office365.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'swappining@hotmail.com';
      $mail->Password = 'holamegustaelpastel123';
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
      $mail->Port = 587;

      // Correo Emisor
      $mail->setFrom('swappining@hotmail.com', 'swappining');
      $mail->setLanguage('es', './phpmailer/language/');

      // Correo Receptor
      $mail->addAddress($email);
      $mail->CharSet = 'UTF-8';

      // Contenido
      $mail->isHTML(true);
      $mail->Subject = $asunto;

      // Cuerpo del correo
      $mail->Body = $cuerpo;

      // Enviar el correo
      if ($mail->send()) {
        return true; // Éxito al enviar el correo electrónico
      } else {
        return false; // Error al enviar el correo electrónico
      }
    } catch (Exception $e) {
      return false; // Captura y maneja errores de excepción
    }
  }
}
?>