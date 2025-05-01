function fetchRecords() {
    let req = `bestPlays.php?game=${gameNumber}&user=${userId}`;
    fetch(req)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Errore di rete: ${response.statusText}`);
            }
            return response.text(); // Recuperiamo i tati (in formato testo)
        })
        .then(answer => {
            let scores = answer.split(",");
            document.getElementById("grecord").innerHTML = (scores[0] === "0") ? "-" : scores[0];
            document.getElementById("precord").innerHTML = (scores[1] === "0") ? "-" : scores[1];
        })
        .catch(error => {
            console.error("Errore nel recupero dei dati:", error);
        });
 }
 function fetchData(numgioco = 0) {
    mosse = 0;
    document.getElementById("messaggio").innerHTML = mosse;
    finita = false;
    let req = `fetch_data.php?game=${numgioco}&user=${userId}`;
    fetch(req)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Errore di rete: ${response.statusText}`);
            }
            return response.text(); // Recupero i dati (in formato testo)
        })
        .then(carsdata => {
            let cars = carsdata.split(",");
            if (numgioco > 0) {
                gameNumber = numgioco;
                cars.shift();
                initBox(false, cars);
            } else {
                gameNumber = cars.shift();
                initBox(true, cars);
            }
            fetchRecords();
            document.getElementById("numero-livello").innerHTML = `Livello corrente:&nbsp;${gameNumber}`;
        })
        .catch(error => {
            console.error("Errore nel recupero dei dati:", error);
        });
 }
 function completato() {
    let data = new URLSearchParams({
        game: gameNumber,
        user: userId,
        nmoves: mosse
    });
    fetch("record.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: data.toString() // Trasformo URLSearchParams nel formato stringa
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Errore di rete: ${response.statusText}`);
        }
        return response.text(); // Convert response to text
    })
    .then(responseText => {
        alert("Risposta del sistema: " + responseText);
        fetchRecords();
    })
    .catch(error => {
        console.error("Errore nell'inserimento dei dati:", error);
    });
 }
 /*function fetchRecords() {
    var req = "bestPlays.php?game=" + gameNumber + "&user=" + userId;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
       let answer = this.responseText;
       scores = answer.split(",");
       document.getElementById("grecord").innerHTML = (scores[0] === "0") ? "-" : scores[0];
       document.getElementById("precord").innerHTML = (scores[1] === "0") ? "-" : scores[1];
    }
    xhttp.open("GET", req);
    xhttp.send();
 }*/
 /* function fetchData(numgioco=0) {
    mosse = 0;
    document.getElementById("messaggio").innerHTML = mosse;
    finita = false;
    var req = "fetch_data.php?game=" + numgioco + "&user=" + userId;
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {                       
       let carsdata = this.responseText;
       let cars = carsdata.split(",");
       if (numgioco>0) {
           gameNumber = numgioco;
           cars.shift();
           initBox(false,cars);
       } else {
           gameNumber = cars.shift();
           initBox(true,cars);
       }
       fetchRecords();
       document.getElementById("numero-livello").innerHTML = "Livello corrente:&nbsp;" + gameNumber;
    }
    xhttp.open("GET", req);
    xhttp.send();
 } */
 /* function completato() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "record.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
       if (xhttp.readyState === 4 && xhttp.status === 200) {
          alert("Response from PHP: " + xhttp.responseText);
          fetchRecords();
       }
    }
    let data = "game=" + gameNumber + "&user=" + userId + "&nmoves=" + mosse;
    xhttp.send(data);
 } */