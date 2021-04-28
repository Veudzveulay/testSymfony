function ajax(data) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", '/ajax', true); // URL permet d'appele le ajaxControlle.php
    xmlhttp.send(data);
    xmlhttp.onload = response; //
}

function response() { // suite de la fonction ONLOAD
    console.log(this.responseText); // pour voir le texte dans la console
}

let button = document.getElementById('btn'); // prend la valeur du bouton

button.addEventListener("click", function () {

    if (validation_Nom_Prenom(document.getElementById("cat"))) {
         var name = document.getElementById("cat");
        alert ("$name");
        const p = 1;

    } else {
        var name = document.getElementById("cat");
        alert ("$name pas correct");
    }
    if (p = 1) {

        let form = document.getElementById('table'); // on récupere tout les inputs du formulaire
        let formData = new FormData(form);
        ajax(formData); // on exécute la fonction ajax avec les données du formulaire

        console.log(form); // affiche dans la console
    }
});


function validation_Nom_Prenom(verif) {

    let nom_Prenom = new RegExp(/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u);
    return nom_Prenom.test(verif);
}

ajax();
