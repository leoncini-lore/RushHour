<?php
require "dbaccess.php";
require "connect.php";
// Pattern per stabilire la correttezza "formale" di username e password
$regexp_x_usr = "/^[\w_]{4,12}$/";
$regexp_x_pwd = "/^[\w$@#!\?%]{8,16}$/";// Lettere (minuscole e maiuscole), cifre
                                        // e simboli speciali $, @, #, ! ,? ,%


$errorcode = 0;
if (isset($_POST['login']) && 
    isset($_POST['username']) &&
    isset($_POST['password'])) {

    $user = $_POST['username'];
    $entered_password = $_POST['password'];
      
    // Controllo formale su username e password
    if (!preg_match($regexp_x_usr,$user)) {
         echo "<script>window.alert('Il formato del nome utente non è corretto')</script>";
      } else if (!preg_match($regexp_x_pwd,$entered_password)) {
         echo "<script>window.alert('Il formato della password non è corretto')</script>";
      } else {
      $dbaccess = db();

      // Accesso effettuato, recuperiamo l'hash della password dal DB
      $sql = "SELECT id, password, privileges FROM Users WHERE username = ?";
      $stmt = mysqli_prepare($dbaccess,$sql); //Eventuali errori SQL gestiti in sede di sviluppo
      mysqli_stmt_bind_param($stmt, 's', $user);
      mysqli_stmt_execute($stmt);
      $resultset = mysqli_stmt_get_result($stmt);
      if(mysqli_num_rows($resultset)>0){
         $row =mysqli_fetch_assoc($resultset);
         if (password_verify($entered_password, $row['password'])) {
            require_once "session.php";
            //Variabili di sessione
            $_SESSION["USER_ID"] = $row['id'];
            // Prima di caricare la pagina del gioco registriamo
            // l'accesso da parte dell'utente
            $date = new DateTime();
            $formattedDate = date("d/m/Y H:i:s", $date->getTimestamp());
            $sql = "INSERT INTO Logs (user_id, time) VALUES (?,?)";
            if ($stmt = mysqli_prepare($dbaccess,$sql)) {
               mysqli_stmt_bind_param($stmt, 'is', $row['id'], $formattedDate);
               mysqli_stmt_execute($stmt);
            }
            header("location: playRH.php");
         } else {
            $errorcode = 2;
         }
      } else {
         $errorcode = 1;
      }
    }
}
?>

<!DOCTYPE html>
<html lang="it">
   <head>
      <title>RH Login</title>
      <link rel="shortcut icon" href="favicon.ico">
      <link rel="stylesheet" href="../css/style.css">
   </head>

   <body>
      <div class="header">
         <h1>Benvenuto in Rush Hour</h1>
      </div>
      <div class="topnav">
         <a href="register.php">Non hai un account? REGISTRATI</a>
      </div>
      <br>
      <div class="row">
         <form id="loginform" name="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset name="loginfs" form="loginform">
               <legend>Autenticazione</legend>
               <label for="username">Username: </label>
               <input type="text" id="username" name="username" pattern="^[\w_]{4,12}$">
               <br>
               <br>
               <label for="password">Password:</label>
               <input type="password" id="password" name="password" pattern="^[\w$@#!\?%]{8,16}$">
               <br>
               <br>
               <?php
                  if ($errorcode==1) {
                     echo '<p style="color:red">Utente sconosciuto.</p>';
                  } else if ($errorcode==2) {
                     echo '<p style="color:red">Password errata.</p>';
                  }
               ?>
               <input type="submit" name="login" value="login">
               <br>
               <br>
               </fieldset>
         </form>
      </div>
   </body>
</html>