function ajax(data) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", '/ajax', true); // on va chercher le fichier php
    xmlhttp.send(data);
    xmlhttp.onload = response; //
}

function response() { // suite de la fonction ONLOAD
    console.log(this.responseText); // pour voir le texte dans la console
}
ajax();
