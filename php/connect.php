<?php
function db() {
    static $conn;
    if ($conn === NULL) { 
        try {     
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWD, DB_NAME);
            if (!$conn) {
                die("Connessione al database fallita: " . mysqli_connect_error());
            }
        } catch (mysqli_sql_exception $e) {
            die("Errore di connessione: " . $e->getMessage());
        }
    }
    return $conn;
}
?>