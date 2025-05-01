<?php
   require_once "session.php";
   header("Cache-Control: no-cache, no-store, must-revalidate");
   header("Pragma: no-cache");
   header("Expires: 0");
   if (isset($_SESSION['USER_ID'])) {
      $userId = $_SESSION['USER_ID'];
   } else {
      header("location: loginpage.php");
   }
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <title>Rush Hour</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
        <script src = "../js/global.js"></script>
        <script src = "../js/togglelist.js"></script>
        <script src = "../js/start.js"></script>
        <script src = "../js/moves.js"></script>
        <script src = "../js/dbrequest.js"></script>
        <script>
            let userId = <?php echo $userId; ?>;
        </script>
    </head>
    <body onload="fetchData()">
        <div class="header">
            <h1>Rush Hour</h1>
        </div>

        <div class="topnav">
            <a href="../html/istruzioni.html">Istruzioni</a>
            <a href="logout.php">Logout</a>
        </div>

        <div class="row">
            <div class="column side-left">
                <h2>Livelli</h2>
                <div class="level-section beginner" onclick="toggleList('beginner-list', event)">
                    <div class="level-header">Principiante ▼</div>
                    <ul id="beginner-list">
                        <li><a href="#" onclick="fetchData(1)">Livello 1</a></li>
                        <li><a href="#" onclick="fetchData(2)">Livello 2</a></li>
                        <li><a href="#" onclick="fetchData(3)">Livello 3</a></li>
                        <li><a href="#" onclick="fetchData(4)">Livello 4</a></li>
                        <li><a href="#" onclick="fetchData(5)">Livello 5</a></li>
                    </ul>
                </div>

                <div class="level-section intermediate" onclick="toggleList('intermediate-list', event)">
                    <div class="level-header">Intermedio ▼</div>
                    <ul id="intermediate-list">
                        <li><a href="#" onclick="fetchData(6)">Livello 6</a></li>
                        <li><a href="#" onclick="fetchData(7)">Livello 7</a></li>
                        <li><a href="#" onclick="fetchData(8)">Livello 8</a></li>
                        <li><a href="#" onclick="fetchData(9)">Livello 9</a></li>
                        <li><a href="#" onclick="fetchData(10)">Livello 10</a></li>
                    </ul>
                </div>

                <div class="level-section advanced" onclick="toggleList('advanced-list', event)">
                    <div class="level-header">Avanzato ▼</div>
                    <ul id="advanced-list">
                        <li><a href="#" onclick="fetchData(11)">Livello 11</a></li>
                        <li><a href="#" onclick="fetchData(12)">Livello 12</a></li>
                        <li><a href="#" onclick="fetchData(13)">Livello 13</a></li>
                        <li><a href="#" onclick="fetchData(14)">Livello 14</a></li>
                        <li><a href="#" onclick="fetchData(15)">Livello 15</a></li>
                    </ul>
                </div>

                <div class="level-section expert" onclick="toggleList('expert-list', event)">
                    <div class="level-header">Esperto ▼</div>
                    <ul id="expert-list">
                        <li><a href="#" onclick="fetchData(16)">Livello 16</a></li>
                        <li><a href="#" onclick="fetchData(17)">Livello 17</a></li>
                        <li><a href="#" onclick="fetchData(18)">Livello 18</a></li>
                        <li><a href="#" onclick="fetchData(19)">Livello 19</a></li>
                        <li><a href="#" onclick="fetchData(20)">Livello 20</a></li>
                    </ul>
                </div>
            </div>
        
            <div class="column middle">
                <h2 id="numero-livello">Livello corrente:</h2>
                <div id="tabella" class="table-container"></div>
                <div class="number-container">
                    <div id="messaggio" class="number yellow"></div>
                </div> 
            </div>
        
            <div class="column side-right">
                <h2>Record Personale</h2>
                <div class="number-container">
                    <div id="precord" class="number blue"></div>
                </div>
                <h2>Record Globale</h2>
                <div class="number-container">
                    <div id="grecord" class="number red"></div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Progetto finale di Progettazione Web | Professore: Alessio Vecchio - Studente: Lorenzo Leoncini | Febbraio 2025</p>
        </div>
    
    </body>
</html>