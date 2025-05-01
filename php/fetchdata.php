<?php

$game = isset($_GET["game"]) ? $_GET["game"] : '0';
$user = isset($_GET["user"]) ? $_GET["user"] : '1';

require "dbaccess.php";
require "connect.php";
$dbaccess = db();

if ($game === '0') {
   $sql = "SELECT MIN(id) as game FROM Games WHERE Games.id NOT IN " . 
          "(SELECT game FROM  Users INNER JOIN Levels ON Users.id = Levels.user WHERE Users.id=?);";
   $stmt = mysqli_prepare($dbaccess,$sql);
   mysqli_stmt_bind_param($stmt, 'i', $user);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);
   if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $game = $row["game"];
   } 
}

if ($game != '0') {
    $sql = "SELECT length,orientation,position,color FROM Pieces WHERE game = ?";
    $stmt = mysqli_prepare($dbaccess,$sql);
    mysqli_stmt_bind_param($stmt, 'i', $game);
    mysqli_stmt_execute($stmt);
    $resultset = mysqli_stmt_get_result($stmt);
    $stringparam = $game;
    while($row = mysqli_fetch_assoc($resultset)) {
       $stringparam .= "," . $row["position"];
       $stringparam .= "," . $row["orientation"];
       $stringparam .= "," . $row["length"];
       $stringparam .= "," . $row["color"];
    }
    echo $stringparam;
} else {
    echo "None";  // Completati tutti i livelli
}
?>