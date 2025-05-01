function toggleList (id,event) {
    if(event.target.tagName.toLowerCase() === "a") {
        return
    }

    list = document.getElementById(id);
    list.style.display = (list.style.display === "block") ? "none" : "block";
}