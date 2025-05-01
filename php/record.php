<?php
require_once "session.php";
require "dbaccess.php";
require "connect.php";
require "getbest.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the POST request
    $game = $_POST['game'] ?? -1;
    $user = $_POST['user'] ?? -1;
    $nmoves = $_POST['nmoves'] ?? -1;

    if ($game == -1 || $user == -1 || $nmoves == -1) {
       $result = "E' stata inviata una richiesta errata al DB";
    } else {
      $best = getrecord($game);
      $dbaccess = db();
      $sql = "SELECT moves FROM Levels WHERE user = ? and game = ?";
      $stmt = mysqli_prepare($dbaccess,$sql); //Eventuali errori SQL gestiti in sede di sviluppo
      mysqli_stmt_bind_param($stmt, 'ss', $user, $game);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $n = mysqli_num_rows($result);
      if ($n>0) $row = mysqli_fetch_assoc($result);
      if ($n === 0 || $nmoves < $row["moves"]) {
         if ($n === 0) {
            // Prepariamo una query di inserimento
            $sql = "INSERT INTO Levels (user,game,moves) VALUES (?,?,?);";
            $stmt = mysqli_prepare($dbaccess,$sql);
            mysqli_stmt_bind_param($stmt, 'iii', $user, $game, $nmoves); 
         } else {
            $sql = "UPDATE Levels SET moves = ?  WHERE user = ? and game = ?;";
            $stmt = mysqli_prepare($dbaccess,$sql);
            mysqli_stmt_bind_param($stmt, 'iii', $nmoves, $user, $game); 
         }
         mysqli_stmt_execute($stmt);
         // Controlliamo che il nuovo score non migliori lo score ottimo per il gioco
         if ($best === 0 || $nmoves < $best) {
             $retmsg = "Complimenti! Hai stabilito il nuovo record per questo gioco";
         } else if ($nmoves == $best) {
             $retmsg = "Complimenti! Hai uguagliato il record per questo gioco";
         } else {
            $retmsg = "Complimenti! Hai stabilito il tuo record per questo gioco";
         }
      } else { // altrimenti non dobbiamo fare nulla
        if ($nmoves == $row["moves"]) {
            $retmsg = "Avevi già ottenuto lo stesso score";
        } else {
            $retmsg = "Avevi già ottenuto uno score migliore";
        }
      }
    }
    //Inviamo la risposta a JavaScript
    echo $retmsg;
} 
else {
    echo "Richiesta non valida";
}
?>