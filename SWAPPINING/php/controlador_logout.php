<?php
// Cerrar sesión
session_start();
session_destroy(); // Destruir la sesión
session_unset(); // Limpiar todas las variables de sesión
header("location: ../index.html");
exit; // Terminar el script después de la redireccón
?>