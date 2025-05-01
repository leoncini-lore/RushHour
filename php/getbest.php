<?php
require_once "dbaccess.php";
function getrecord($game) {
    $dbaccess = db();
    $sql = "SELECT MIN(moves) as best FROM Levels WHERE game=?;";
    $stmt = mysqli_prepare($dbaccess,$sql);
    if (!$stmt) {
       die("prepare statement failed: " . mysqli_error($dbaccess));
    }
    mysqli_stmt_bind_param($stmt, 'i', $game); 
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    if (is_null($row["best"])) return 0;
    else return $row["best"];
}
?>