<?php
   require_once "session.php";
   session_unset();
   session_destroy();

   // Preveniamo il caching di questa pagina
   header("Cache-Control: no-cache, no-store, must-revalidate");
   header("Pragma: no-cache");
   header("Expires: 0");

   // Re-indirizziamo il browser alla pagina di login
   header("Location: loginpage.php");
   exit();
?>