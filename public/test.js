//
let form = document.getElementById('myForm'); // prend la valeur du formulaire

//
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

function validationNom(verification) {
    let nom = new RegExp(/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/u);
    return nom.test(verification);
}
//
function validationEmail(email) {
    let mail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return mail.test(email);
}

//
form.addEventListener('keyup', async (e) => {

    let cat = form[0].value,
        price = form[1].value,
        monkey = form[2].value;

    if (validationNom(cat)) { // si la valeur dans le 2eme input ne passe pas le regex, msg d'erreur
        let surname = document.getElementById("dog_cat");
        surname.setAttribute('style', 'border: 2px solid #34C924');
        surname.style.color = '#34c924';
    } else {
        let inputCat = form[0];
        inputCat.setAttribute('style', 'border : 2px solid  red');
        inputCat.style.color = 'red';
    }
    if (!validationEmail(monkey)) {
        let inputMonkey = form[2];
        inputMonkey.style.color = 'red';
    } else {
        let inputMonkey = form[2];
        inputMonkey.style.color = 'green';
    }
});

form.addEventListener('submit', async (e) => {
    e.preventDefault(); // empêche l'envoi sur formulaire


    let formData = new FormData(form);
    let valueAjax = await ajax(formData);// catExists attend que la fonction ajax soit fini avant de commencer
    let valueExists = JSON.parse(valueAjax); // convertis ce qu'on reçois de l'ajaxController en tableau
    let cat = form[0].value,
        price = form[1].value,
        monkey = form[2].value,
        errorCounter = 0,
        errorMsg = "";

    //console.log(cat, price, monkey); // affiche dans la console le champ cat price monkey
    //console.log(valueExists); // typeof = montrer si c'est un string ou un int
    //console.log(JSON.parse(valueExists)); // typeof = montrer si c'est un string ou un int

    if (cat === "" && monkey === "") {
        errorMsg += "Veuillez saisir quelque chose <br/>";
        errorCounter++;
    }
    if (valueExists.error === true) {
        errorMsg += valueExists.msg; // envoie le msg qui se trouve dans l'ajax controller dans errorMsg
        errorCounter++;
    }
    if (!validationNom(cat)) { // si la valeur dans le 2eme input ne passe pas le regex, msg d'erreur
        errorMsg += "Le nom de cat n'est pas correcte <br/>";
        errorCounter++;
    }
    if (!validationEmail(monkey)) { // si la valeur dans le 3eme input ne passe pas le regex, un msg d'erreur est formé
        // + une incrémentation
        errorMsg += "Le nom de monkey n'est pas correcte ";
        errorCounter++;
    }
    //console.log(errorCounter);  //affiche les nombres d'erreurs qu'il y a
    //console.log(errorMsg); // affiche errorMsg dans la console

    if (errorCounter > 0) {
        document.getElementById("testEcrit").innerHTML = errorMsg; // si il y a plus de une erreur envoie la
        // fonction errorMsg
    } else {
        form.submit(); // envoie le formulaire
        //  console.log(form);  // affiche dans la console
    }
});


