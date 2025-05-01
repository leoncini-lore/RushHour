function isLegal(color, move) {
    if (finita) return false
    let orizzontale = false;
    let counter = 0;
    let casella = document.getElementById(counter);
    while (color != casella.style.backgroundColor) {
        casella = document.getElementById(++counter);
    }
    if (document.getElementById(counter + 1).style.backgroundColor === color) {
        orizzontale = true;
    }
    if ((orizzontale && move === "up") || (orizzontale && move === "down") || (!orizzontale && move === "right") || (!orizzontale && move === "left")) {
        return false
    }
    let retValue = false;
    switch (move){
        case "up":
            if (counter - NUM_COL >= 0 && document.getElementById(counter - NUM_COL).style.backgroundColor === "white") {
                retValue = true;
            }
            break;
        case "down":
            while (counter + NUM_COL < NUM_RIG*NUM_COL && document.getElementById(counter + NUM_COL).style.backgroundColor === color) {
                counter += NUM_COL;
            }
            if (document.getElementById(counter + NUM_COL).style.backgroundColor === "white") {
                retValue = true;
            }
            break;
        case "left":
            if (counter%NUM_COL != 0 && document.getElementById(counter - 1).style.backgroundColor === "white") {
                retValue = true;
            }
            break;
        case "right":
            while ((counter + 1)%NUM_COL != NUM_COL-1 && document.getElementById(counter + 1).style.backgroundColor === color) {
                counter += 1;
            }
            if (document.getElementById(counter + 1).style.backgroundColor === "white") {
                retValue = true;
            }
            break;
        default:
    }
    return retValue
}
function down () {
    let counter = 0;
    let casella = document.getElementById(counter);
    while (!casella.classList.contains("selezionata")) {
        casella = document.getElementById(++counter); 
    }
    let color = casella.style.backgroundColor;
    if (!isLegal(color, "down"))return
    mosse++;
    document.getElementById("messaggio").innerHTML = mosse;
    while (document.getElementById(counter + NUM_COL).style.backgroundColor === color) {
        counter += NUM_COL;
    }
    document.getElementById(counter + NUM_COL).style.backgroundColor = color;
    document.getElementById(counter + NUM_COL).classList.add("selezionata");
    casella.style.backgroundColor = "white";
    casella.classList.remove("selezionata");
}
function up() {
    let counter = 0;
    let casella = document.getElementById(counter);
    while (!casella.classList.contains("selezionata")) {
        casella = document.getElementById(++counter); 
    }
    let color = casella.style.backgroundColor;
    if (!isLegal(color, "up")) return
    mosse++;
    document.getElementById("messaggio").innerHTML = mosse;
    document.getElementById(counter - NUM_COL).style.backgroundColor = color;
    document.getElementById(counter - NUM_COL).classList.add("selezionata");
    while (counter + NUM_COL < NUM_COL*NUM_RIG && document.getElementById(counter + 6).style.backgroundColor === color) {
        counter += NUM_COL;
    }
    document.getElementById(counter).style.backgroundColor = "white";
    document.getElementById(counter).classList.remove("selezionata");
}
function left() {
    let counter = 0;
    let casella = document.getElementById(counter);
    while (!casella.classList.contains("selezionata")) {
        casella = document.getElementById(++counter); 
    }
    let color = casella.style.backgroundColor;
    if (!isLegal(color, "left")) return
    mosse++;
    document.getElementById("messaggio").innerHTML = mosse;
    document.getElementById(counter - 1).style.backgroundColor = color;
    document.getElementById(counter - 1).classList.add("selezionata");
    while ((counter + 1)%NUM_COL != 0 && document.getElementById(counter + 1).style.backgroundColor === color) {
        counter += 1;
    }
    document.getElementById(counter).style.backgroundColor = "white";
    document.getElementById(counter).classList.remove("selezionata");
}
function right() {
    let counter = 0;
    let casella = document.getElementById(counter);
    while (!casella.classList.contains("selezionata")) {
        casella = document.getElementById(++counter); 
    }
    let color = casella.style.backgroundColor;
    if (color === "red" && counter === (NUM_COL*3-2) && !finita) {
        finita = true;                 
        completato();
    }
    if (!isLegal(color, "right")) return
    mosse++;
    document.getElementById("messaggio").innerHTML = mosse;
    while (document.getElementById(counter + 1).style.backgroundColor === color) {
        counter += 1;
    }
    document.getElementById(counter + 1).style.backgroundColor = color;
    document.getElementById(counter + 1).classList.add("selezionata");
    casella.style.backgroundColor = "white";
    casella.classList.remove("selezionata");
}