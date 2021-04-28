function ajax(data) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", '/ajax', true); // URL permet d'appele le ajaxControlle.php
    xmlhttp.send(data);
    xmlhttp.onload = response; //
}

function response() { // suite de la fonction ONLOAD
    console.log(this.responseText); // pour voir le texte dans la console
}
ajax();
