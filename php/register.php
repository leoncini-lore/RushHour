<?php
// Pattern per stabilire la correttezza "formale" di username, password e email
$regexp_x_usr = "/[\w_]{4,12}/";
$regexp_x_pwd = "/[\w$@#!\?%]{8,16}/"; // Lettere (minuscole e maiuscole), cifre
                                       // e simboli speciali $, @, #, ! ,? ,%,_
$regexp_x_email = "/^[\w_\.\-]+@[\w_\-]+\.[A-Za-z]{1,}$/"; 
                                       // Semplice (e non completo) controllo su indirizzo email   

$errorcode = 0;
if (isset($_POST['register']) && 
  isset($_POST['username']) &&
  isset($_POST['password']) &&
  isset($_POST['email'])) {
    
  $user = $_POST['username'];
  $plain_password = $_POST['password'];
  $email = $_POST['email'];
   
  // Controllo formale su username, password e email
  if (!preg_match($regexp_x_usr,$user)) {
     echo "<script>window.alert('Il formato del nome utente non è corretto')</script>";
  } else if (!preg_match($regexp_x_pwd,$plain_password)) {
     echo "<script>window.alert('Il formato della password non è corretto')</script>";
  } else if (!preg_match($regexp_x_email,$email)) {
     echo "<script>window.alert('Il formato dell'indirizzo email non è corretto')</script>";
  } else {
     // Procediamo all'accesso al DB
     require "dbaccess.php";
     require "connect.php";
     $dbaccess = db();
     // Come prima cosa bisogna controllare che non esista già un utente
     // con il nome specificato.
     $sql = "SELECT id FROM Users WHERE username = ?";
     if ($stmt = mysqli_prepare($dbaccess,$sql)) {
        mysqli_stmt_bind_param($stmt, 's', $user);
        mysqli_stmt_execute($stmt);
        $resultset = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($resultset)>0){   # Se il resultset non è vuoto l'utente esiste gia'
           $errorcode = 3;
        } else {  # ... altrimenti inseriamo i dati del nuovo utente
           $sql = "INSERT INTO Users (username, password, email, privileges) VALUES (?,?,?,'player')";
           if ($stmt = mysqli_prepare($dbaccess,$sql)) {
              $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);
              mysqli_stmt_bind_param($stmt, 'sss', $user, $hashed_password, $email);
              mysqli_stmt_execute($stmt);
              header("location: loginpage.php");  // Utente re-indirizzato alla pagina di login
           }
        }
     } else {
        // Non dovrebbe accadere se la connessione è stata stabilita con successo
        die("Errore: $stmt->error \n");
     }
  }
}
?>


<!DOCTYPE html>
<html lang="it">
   <head>
      <title>RH Register</title>
      <link rel="shortcut icon" href="favicon.ico">
      <link rel="stylesheet" href="../css/style.css">
   </head>

   <body>
      <div class="header">
         <h1>Iscrizione a Rush Hour</h1>
      </div>

      <div class="topnav">
         <a href="loginpage.php"> Hai già un account? ACCEDI</a>
      </div>
      <br>

      <div class="row">
         <form id="loginform" name="loginform" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <fieldset name="loginfs" form="loginform">
            <legend>Inserisci i tuoi dati</legend>
            <label for="username">Nome utente: </label>
            <br>
            <input type="text" id="username" name="username" pattern="^[\w_]{4,12}$">
            <br>
            <small>Lettere (minuscole e maiuscole), cifre e _. Lungheza compresa tra 4 e 12 caratteri </small>
            <br>
            <br>
            <label for="password">Password: </label>
            <br>
            <input type="password" id="password" name="password" pattern="^[\w$@#!\?%]{8,16}$">
            <br>
            <small>Lettere (minuscole e maiuscole), cifre e simboli speciali $, @, #, ! ,? ,%, _. Lungheza compresa tra 8 e 12 caratteri </small>
            <br>
            <br>
            <label for="email">Email: </label>
            <br>
            <input type="email" id="email" name="email" pattern="^[\w_\.\-]+@[\w_\-]+\.[A-Za-z]{1,}$">
            <br>
            <br>
            <?php
               if ($errorcode==3) {
                  echo '<p style="color:red">Nome di login già in uso.</p>';
               }
            ?>
            <input type="submit" name="register" value="registrami">
            <br>
            <br>
            </fieldset>
         </form>
      </div>
   </body>
</html>