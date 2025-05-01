function generaTabella() {
    const tabella = document.getElementById("tabella");
    let contatore = 0;
    for (let i = 0; i < NUM_RIG; i++) {
        const row = document.createElement("div");
        tabella.appendChild(row);
        for(let j=0; j< NUM_COL; j++) {
            const casella = document.createElement("input");
            casella.setAttribute("class", "casella");
            casella.setAttribute("readonly", "readonly");
            casella.style.backgroundColor = "white"
            casella.id = contatore++;
            row.appendChild(casella);
            casella.addEventListener("click", casellaCliccata);
        }
    }
}
function inizializza(cars) {
    for (var car = 0; car < cars.length; car += 4) {
        for (let i = 0; i < cars[car + 2]; i++) {
            if (cars[car + 1] === 0) {
                let casella = document.getElementById(cars[car] + i);
                casella.style.backgroundColor = cars[car + 3];
            }
            else {
                let casella = document.getElementById(cars[car] + i*6);
                casella.style.backgroundColor = cars[car + 3];
            }
        }
    }
}
function svuotatabella() {
    for (let i = 0; i < NUM_RIG; i++) {
       for (let j=0; j < NUM_COL; j++) {
          let casella = document.getElementById(i*NUM_COL+j);
          casella.style.backgroundColor = "white";
       }
    }
}
function initBox (starting,cars) {
    if (starting) {
       generaTabella();
       document.addEventListener("keydown", (event) => {
          if (event.keyCode === 40) {
              down();
          }
          if (event.keyCode === 38) {
              up();
          }
          if (event.keyCode === 37) {
              left();
          }
          if (event.keyCode === 39) {
              right();
          }
       });
       document.getElementById("messaggio").innerHTML = mosse;
    } else {
       svuotatabella();
    }
    for (let car = 0; car < cars.length; car += 4) {
        cars[car] = Number(cars[car]);
        cars[car+1] = (cars[car+1]=='V') ? 1 : 0;
        cars[car+2] = Number(cars[car+2]);
    }
    inizializza(cars);
}
function casellaCliccata(event) {
    let target = event.target || event.srcElement;
    let id = target.id;
    let color = document.getElementById(id).style.backgroundColor;
    if (color === "white") return
    if (target.classList.contains("selezionata")) return
    for (let i = 0; i < NUM_RIG*NUM_COL; i++) {
        let casella = document.getElementById(i);
        if (casella.style.backgroundColor === color) {
            casella.classList.add("selezionata");
        }
        else {
            casella.classList.remove("selezionata");
        }
    }
}