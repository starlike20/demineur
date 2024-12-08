const user=document.getElementById('pseudoUser');
const password=document.getElementById('password');
const conpassword=document.getElementById('conpassword');
const birthdate=document.getElementById('birthdate');
const sexe=document.getElementById('sexe');
const picture=document.getElementById('picture');
const login=document.getElementById('login');
const log=document.getElementById('log');

const erroruser=document.getElementById('erropseudo');
const erropassword=document.getElementById('erropassword');
const erroconpassword=document.getElementById('erroconpassword');
const errobirthdate=document.getElementById('errobirthdate');
const errosexe=document.getElementById('errosexe');
const erropicture=document.getElementById('erropicture');
const erroglobale=document.getElementById('erroglobale');

let submitAllowed = false;
let otherPassword;
let otherUser;

user.addEventListener('keyup',()=>{
    erroruser.style.visibility="hidden";
    user.style.border="none";
    otherUser = user.value.replace(/\s+/g, '');
    if(validateString(otherUser)==true){
        const formData = new FormData();
        formData.append('user', user.value);
        fetch('../inscription.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log(response);
            console.log(response.status);
            if (!response.ok) {
                //throw new Error('Réponse réseau non OK');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            if(data.status!="success"){
                erroruser.textContent=""+data.message+"";
                erroruser.style.visibility="visible";
                user.style.border="1.5px solid red";
            }
        })
        .catch(error => console.error('Il y a eu un problème avec votre requête fetch:', error.message))
        .finally(() => console.log('Ceci est exécuté quoi qu\'il arrive.'));

        console.log('Ceci est exécuté directement.');
    }
    else{
        erroruser.textContent="entrez un mot de speudo de minimun 4 charactres  imprimables ";
        erroruser.style.visibility="visible";
        user.style.border="1.5px solid red";
    }
});
password.addEventListener('keyup',()=>{
    erropassword.style.visibility="hidden";
    password.style.border="none";
    otherPassword = password.value.replace(/\s+/g, '');
    if(validateString(otherPassword)==false){
        erropassword.textContent="entrez un mot de passe de minimun 4 charactres  imprimables ";
        erropassword.style.visibility="visible";
        password.style.border="1.5px solid red";
    }
    var event = new KeyboardEvent('keyup', {
        key: 'a',               // Spécifiez la touche concernée
        code: 'KeyA',           // Code de la touche
        altKey: false,          // true si la touche Alt est pressée
        shiftKey: false,        // true si la touche Maj est pressée
        ctrlKey: false,         // true si la touche Ctrl est pressée
        metaKey: false          // true si la touche Meta (Cmd sur Mac, Windows sur PC) est pressée
    });
    conpassword.dispatchEvent(event);
})
conpassword.addEventListener('keyup',()=>{
    erroconpassword.style.visibility="hidden";
    conpassword.style.border="none";
    if(password.value!=conpassword.value){
        erroconpassword.textContent="mot de passe non correspondant";
        erroconpassword.style.visibility="visible";
        conpassword.style.border="1.5px solid red";
    }
});
birthdate.addEventListener('blur',()=>{
    errobirthdate.style.visibility="hidden";
    birthdate.style.border="none";
    if(birthdate.valueAsDate>(new Date())){
        errobirthdate.textContent="entrez une date de naissance valide";
        errobirthdate.style.visibility="visible";
        birthdate.style.border="1.5px solid red";
    }
    else{
        if(birthdate.valueAsDate>(new Date('2006-01-01'))){
            errobirthdate.textContent="vous etes mineur";
            errobirthdate.style.visibility="visible";
            birthdate.style.border="1.5px solid red";
        }
    }
});
/*sexe.addEventListener('change',()=>{
    errosexe.style.visibility="hidden";
    sexe.style.border="none";
    if(sexe.value=="R"){
        errosexe.textContent="vous etes mineur";
        errosexe.style.visibility="visible";
        sexe.style.border="1.5px solid red";
    }
})*/
picture.addEventListener('change', function(event) {
    erropicture.style.visibility="hidden";
    picture.style.border="none";

    var fichier = event.target.files[0];
    var nomFichier = fichier.name;

    var extensionFichier = nomFichier.split('.').pop().toLowerCase();
    var extensionsAcceptees = ['jpg', 'jpeg', 'png', 'gif'];
  
    if (extensionsAcceptees.includes(extensionFichier)) {
        console.log('Format de fichier accepté.');
    } else {
        event.target.value = '';
        erropicture.textContent="Format de fichier non accepté";
        erropicture.style.visibility="visible";
        picture.style.border="1.5px solid red";
    }
});
log.addEventListener('submit',(event)=>{
    if(!submitAllowed){
        event.preventDefault();
        if(getComputedStyle(erroruser).visibility =="hidden" &&
        getComputedStyle(erropassword).visibility =="hidden" &&
        getComputedStyle(erroconpassword).visibility =="hidden" &&
        getComputedStyle(errobirthdate).visibility =="hidden" &&
        getComputedStyle(errosexe).visibility =="hidden" &&
        getComputedStyle(erropicture).visibility =="hidden" &&
        user.value && password.value && conpassword.value && 
        birthdate.value  ){
            submitAllowed = true;
            log.submit();
            
        }
        else{
            erroglobale.textContent="Formulaire non valide, vérifiez tous les champs.";
        }
    }
})

function validateString(x) {
    // Utilise RegExp pour tester si la chaîne contient uniquement des caractères imprimables
    if (/^[\x20-\x7E]+$/.test(x)) {
        if (x.length >= 4 && x.length <= 15) {
            return true;
        }
        return false;
        
    } else {
        return false;
    }
}
  