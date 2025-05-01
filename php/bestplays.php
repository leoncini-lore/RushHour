<?php
require "dbaccess.php";
require "connect.php";
require "getbest.php";

if (isset($_GET['game']) && 
    isset($_GET['user'])) {
   $game = $_GET['game'];
   $user = $_GET['user']; 
   $best = getrecord($game);
   $dbaccess = db();
   $sql = "SELECT moves FROM Levels WHERE user = ? and game = ?";
   $stmt = mysqli_prepare($dbaccess,$sql); //Eventuali errori SQL gestiti in sede di sviluppo
   mysqli_stmt_bind_param($stmt, 'ss', $user, $game);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   $n = mysqli_num_rows($result);
   if ($n === 0) {
      echo $best . ",0";
   } else {
      $row = mysqli_fetch_assoc($result);
      echo $best . "," . $row["moves"];
   }
}
?>