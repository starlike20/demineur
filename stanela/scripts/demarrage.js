const Menu=document.getElementById("Menu");
const jeu=document.getElementsByTagName("button[type='submit']");
const number=document.getElementsByTagName("input");
const mineForm=document.getElementById('mineForm');
const load=document.getElementById('nochargement');
let submitAllowed = false;
let audio =new Audio("../public/song/VID-20240518-WA0054.mp3");
let audi=new Audio("./song/stanela.m4a");
audi.loop=true;

Menu.addEventListener('click',()=>{
    load.id="chargement";
    setTimeout(() => {
        load.id="nochargement";
        window.location.href="../acceuille.php";
    }, 4000);
    
});
mineForm.addEventListener('submit',(event)=>{
    if(!submitAllowed){
        event.preventDefault();
        
        if(number[0].value<15){
            alert("entrez une valeur superrieur a 15");
        }
        else{
            load.id="chargement";
            setTimeout(() => {
                load.id="nochargement";
                submitAllowed=true;
                mineForm.submit();
            }, 4000);
        }
    }

    
});
console.log(number.values);
window.addEventListener('click',()=>{
    audio.play();
});
audi.play();