let form = document.getElementById('myForm'); // prend la valeur du formulaire
 console.log(form);

async function ajax(data) {
    return new Promise(resolve => {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", '/ajax', true); // URL permet d'appele le ajaxControlle.php
        xmlhttp.send(data);
        xmlhttp.onload = function () {
            resolve(this.responseText)
        };
    })
}

function response() {
    // console.log(this.responseText); // pour voir le texte dans la console
    // document.getElementById("testEcrit").innerHTML = this.responseText;
    return this.responseText;
}


function validation_Nom(verification) {

    let nom = new RegExp(/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u);
    return nom.test(verification);
}

function validerEmail(email) {
    var mail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return mail.test(email);
}

form.addEventListener('submit', async (e) => {
    e.preventDefault(); // empêche l'envoi sur formulaire

    let formData = new FormData(form);
    let catExists = await ajax(formData); // catExists attend que la fonction ajax soit fini avant de commencer
    let cat = form[0].value,
        price = form[1].value,
        monkey = form[2].value,
        error = 0,
        errorMsg = '';

    // console.log(cat, price, monkey); // affiche dans la console le champ cat price monkey
    // console.log(catExists); // typeof = montrer si c'est un string ou un int
    // console.log(JSON.parse(catExists)); // typeof = montrer si c'est un string ou un int

    if (catExists === true) {
        errorMsg += "Le nom est déjà pris"
        error++;
    }
    if (!validation_Nom(cat)) { // si la valeur dans le 2eme input ne passe pas le regex, msg d'erreur
        errorMsg += "le nom de cat n'est pas correcte \r";
        error++;
    }
    if (!validation_Nom(monkey)) { // si la valeur dans le 3eme input ne passe pas le regex, un msg d'erreur est formé
        // + une incrémentation
        errorMsg += "le nom de monkey n'est pas correcte \r";
        error++;
    }
    //console.log(error);  //affiche les nombres d'erreurs qu'il y a
    //console.log(errorMsg); // affiche errorMsg dans la console

    if (error > 0) {
        document.getElementById("testEcrit").innerHTML = errorMsg; // si il y a plus de une erreur envoie la
        // fonction errorMsg

    } else {
         form.submit(); // envoie le formulaire
       //  console.log(form);  // affiche dans la console
    }
});


