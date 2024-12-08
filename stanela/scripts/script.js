    import * as module1 from './settings.js';
    let imoji=document.getElementById("imoji");
    let carte=document.querySelectorAll('.carte');
    let cartess = document.querySelector('#listequiz');
    const score = document.getElementById('score');
    const nb=document.getElementById("mine");
    const felicitation=document.getElementById("nogagner");
    const perdu=document.getElementById("noperdu");
    const charge=document.getElementById("nochargement");
    let audio;
    audio=new Audio("./song/aplaudissement.m4a");
    let audi=new Audio("./song/debut.m4a");
    audio.loop=true;
    let table=[];
    let debutl;
    let debutcol;
    let m=0,x=0,y;
    let temps=3600;
    let debut=temps;
    let nbrcateouver=0;
    const menuBtn = document.getElementById("menuBtn");
    const restartBtn = document.getElementById("restartBtn");
    const pauseBtn = document.getElementById("pauseBtn");
    let pause = false;
    let intervalId;
    let n=parseInt(nb.textContent,10);
    //let n=2;
    class cartes{
        static fin=0;
        static table=[];
        constructor(a,mine,i,j){
            this.element=a;
            this.mine=mine;
            this.i=i;
            this.j=j;
            this.ouvert=0;
      
            this.element.addEventListener('click',()=>{
                if(cartes.fin===0){
                    this.element.style.backgroundColor="white";
                    if(this.mine==-1){
                        module1.param.bombe.play();
                        this.element.innerHTML="<div><img src='./img/bombe.jpg' alt=''></div>";
                        imoji.src="./img/twemoji_pleading-face.png";
                        cartes.fin=1;
                        this.ouvert=1;
                    }
                    else{
                        if(this.mine>0){
                            if(this.ouvert==0){
                                module1.param.songclick.play();
                                this.element.innerHTML="<div><p>"+this.mine+"</p></div>";
                                this.ouvert=1;
                                nbrcateouver++;
                            }
                            
                        }
                        else{
                            module1.param.songclick.play();
                            if(this.ouvert==0){
                                this.element.innerHTML="<div></div>";
                                this.ouvert=1;
                                nbrcateouver++;
                                this.autour();
                            }
                            
                        }
                    }
                    if(nbrcateouver==(6*14-n)){
                        cartes.fin=2;
                        felicitation.id="gagner";
                        audio.play();
                    }
                }
            });

            this.element.addEventListener('mousedown',()=>{
                if(cartes.fin===0){
                    imoji.src="./img/twemoji_face-with-open-mouth.png";
                }
            });
            this.element.addEventListener('mouseup',()=>{
                if(cartes.fin===0){
                    imoji.src="./img/twemoji_slightly-smiling-face.png";
                }
            });
        
        }
        getmine(){
            return this.mine;
        }
        setmine(a){
            this.mine=a;
        }
        close(){
            let r = Math.floor(Math.random() * (200 - 40) + 100); 
            let g = Math.floor(Math.random() * (200 - 100) + 100);
            let b = Math.floor(Math.random() * (255 - 200) + 200);

            let color = `rgb(${r},${g},${b})`;

            this.element.style.backgroundColor = color;
        }
        static init(){
            let a;
            
            let i=-1;
            let j=14;
            let t=0;
            let m=0,x=0,y;

            carte.forEach(element => {
                if(j>=14){
                    i++;
                    j=0;
                    cartes.table[i]=[];
                }
                a=new cartes(element,0,i,j);
                cartes.table[i][j]=a;
                j++;
            });
            
            while(x!=n){
                i= Math.floor(Math.random() *6);
                j= Math.floor(Math.random() *14);
                if(cartes.table[i][j].getmine()==0){
                    cartes.table[i][j].setmine(-1);
                    x++;
                }
            }

            for(i=0;i<6;i++){
                for(j=0;j<14;j++){
                    debutl=i-1;
                    debutcol=j-1;
                    if(cartes.table[i][j].getmine()==0){
                        m=0;
                        for(x=debutl;(x-debutl)<3;x++){
                            for(y=debutcol;(y-debutcol)<3;y++){
                                if(x>=0 && x<6){
                                    if(y>=0 && y<14){
                                        if(cartes.table[x][y].getmine()===-1){
                                            m++;
                                        }
                                    }
                                }
                            }
                        }
                        cartes.table[i][j].setmine(m);
                    }
                    cartes.table[i][j].close();
                }
            }
            cartess.addEventListener('click',()=>{
                if (cartes.fin==1) { 
                    for (let i = 0; i < 6; i++) {
                        for (let j = 0; j < 14; j++) {
                            if (cartes.table[i][j].getmine() === -1) {
                                cartes.table[i][j].element.style.backgroundColor="white";
                                cartes.table[i][j].element.innerHTML = "<div><img src='./img/bombe.jpg' alt='Mine'></div>";
                            }
                        }
                    }
                }
            });

        }
        getelement(){
            return this.element;
        }
        autour(){
            debutl=this.i-1;
			debutcol=this.j-1;
            for(x=debutl;(x)<=debutl+2;x++){
                for(y=debutcol;(y)<=debutcol+2;y++){
                    if(x>=0 && x<6){
                        if(y>=0 && y<14){
                            if (!(x === this.i && y === this.j)) { // Évitez la case centrale
                                if (cartes.table[x][y].getmine() === 0) {
                                    cartes.table[x][y].getelement().click();
                                }
                            }
                        }
                    }
                }
            }
        }

    };
    
cartes.init();

function miseAJourCompteARebours() {
  if(cartes.fin!=0){
    clearInterval(intervalId);
    const formData = new FormData();
    formData.append('score',parseInt(score.textContent,10));
    fetch('./controller.php', {
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
    })
    .catch(error => console.error('Il y a eu un problème avec votre requête fetch:', error.message))
    .finally(() => console.log('Ceci est exécuté quoi qu\'il arrive.'));
    if(cartes.fin==1){
        perdu.id="perdu";
    }
  }
  temps--;

  score.innerHTML=temps+nbrcateouver*n;
  
}

menuBtn.addEventListener('click', () => {
    charge.id="chargement";
    setTimeout(() => {
        charge.id="nochargement";
        window.location.href = "./demarrage.php";
    }, 4000);
    
});

restartBtn.addEventListener('click', () => {
    charge.id="chargement";
    setTimeout(() => {
        charge.id="nochargement";
        location.reload();
    }, 4000);
   
});

pauseBtn.addEventListener('click', () => {
    if(cartes.fin==0){
        pause = !pause;
        if (pause) {
            clearInterval(intervalId);
            pauseBtn.textContent = "Reprendre";
        } else {
            pauseBtn.textContent = "Pause";
            startTimer();
        }
    }
});
 
function startTimer() {
    intervalId = setInterval(miseAJourCompteARebours, 1000);
}
startTimer();
audi.play();