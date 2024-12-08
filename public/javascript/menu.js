const acc=document.getElementById("acc");
const clas=document.getElementById("clas");
const dec=document.getElementById("dec");
const liste=document.getElementById("liste");
const pointeur=document.getElementById("pointeur");
const clasm=document.querySelectorAll(".clasm");
const line=document.getElementById('line');
const classement=document.getElementById("classement");
const acceuille=document.getElementById("acceuille");
const line1=document.getElementById("line1");
const load=document.getElementById('noload');
const jeu=document.querySelectorAll(".jeu");
let songtout=new Audio('./public/song/728282__timbre__cramitd-remix-of-xkerils-freesound-671962.flac');
let songclick=new Audio("./public/song/VID-20240518-WA0054.mp3");

acc.addEventListener("click",()=>{
    acceuille.style.display="flex";
    classement.style.display="none";
});
clas.addEventListener("click",()=>{
    classement.style.display="flex";
    acceuille.style.display="none";
    line.click();
});
clasm.forEach(element => {
    element.addEventListener("click", () => {
        console.log(element.getBoundingClientRect().left);
        const leftValue=element.getBoundingClientRect().left
        pointeur.style.left=(leftValue -30)+ "px";
        liste.innerHTML="";
        console.log("Initial click log");
        const formData = new FormData();
        formData.append('jeu', element.textContent);

        fetch('./menu.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log("Response object:", response);
            if (!response.ok) {
                throw new Error('Réponse réseau non OK');
            }
            return response.json();  // Convertit la réponse en objet JavaScript
        })
        .then(data => {
           data.tab.forEach(elements => {
            img="";
            if(data.pseudoUser==elements.emetteur){
                img="./public/img/biro-exploding-party-popper-with-confetti.png";
            }
            liste.innerHTML += `
            <div class="meilleur">
                <span>`+elements.emetteur+`</span>
                <span>`+elements.score+`</span>
                <img class="feli" src="`+img+`">
            </div>`;
           });
        })
        .catch(error => {
            console.error('Il y a eu un problème avec votre requête fetch:', error.message);
        })
        .finally(() => {
            console.log('Ceci est exécuté quoi qu\'il arrive.');
        });
    });
});
jeu.forEach(element=>{
    element.addEventListener("click", () => {
        load.id="loading"
        setTimeout(() => {
            load.id="noload";
            if(element.id=="line1"){
                window.location.href="./line/game.html";
            }
            else{
                if(element.id=="stanela1"){
                    window.location.href="./stanela/demarrage.php"
                }
                else{
                    window.location.href="./casse-brique/index.html"
                }
            }
        }, 4000);
        
    });
})
document.addEventListener("click",()=>{
    songclick.play();
})
dec.addEventListener("click",()=>{
    window.location.href = "./acceuille.php?i=2";
});
songtout.loop=true;
songtout.volume=0.3;
songtout.play().catch(function(error) {
    console.log('Erreur lors de la lecture audio :', error);
});
