let form = document.getElementById('myForm'); // prend la valeur du formulaire
console.log(form);

function ajax(data) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", '/ajax', true); // URL permet d'appele le ajaxControlle.php
    xmlhttp.send(data);
    xmlhttp.onload = response; //
}

function response() { // suite de la fonction ONLOAD
    console.log(this.responseText); // pour voir le texte dans la console
}


/** function validation() {
    if (form.document.getElementById('cat').value == "") {
        verification.preventDefault();
        alert("pas correct");


    } else {

        alert(" pas correct");
    }
    if () {


        let formData = new FormData(form);
        ajax(formData); // on exécute la fonction ajax avec les données du formulaire

        console.log(form); // affiche dans la console
    }
}
 */

 function validation_Nom(verification) {

    let nom = new RegExp(/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u);
    return nom.test(verification);
}
function validerEmail(email) {
    var mail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return mail.test(email);
}

form.addEventListener('submit', (e) => {
    e.preventDefault(); // empêche l'envoi sur formulaire

    let cat = form[0].value,
        price = form[1].value,
        monkey = form[2].value,
        error = 0,
        errorMsg = '';

     // console.log(cat, price, monkey); // affiche dans la console le champ cat price monkey

    if (!validation_Nom(cat)) {
        errorMsg += "le nom de cat n'est pas correcte\r";
        error++;
    }
    if (!validation_Nom(monkey)) {
        errorMsg += "le nom de monkey n'est pas correcte\r";
        error++;
    }
    // console.log(error);  affiche les nombres d'erreurs qu'il y a

    if (error > 0) {
        document.getElementById("testEcrit").innerHTML = errorMsg;
    }
    else {
        let formData = new FormData(form);
        ajax(formData); // on exécute la fonction ajax avec les données du formulaire
       // console.log(form);  affiche dans la console
    }
});


