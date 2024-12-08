const user=document.getElementById('login1');
const  password=document.getElementById('login2');
const dialerror=document.getElementById("erropseudo");
const login=document.getElementById('login');
const log=document.getElementById('log');
const erromdp=document.getElementById('erromdp');
const load=document.getElementById('noload');
let submitAllowed = false;

user.addEventListener('keyup',()=>{
    dialerror.style.visibility="hidden";
    user.style.border="none";
    const formData = new FormData();
    formData.append('user', user.value);
    fetch('../connexion.php', {
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
        if(data.status!="success"){
            dialerror.textContent=""+data.message+"";
            dialerror.style.visibility="visible";
            user.style.border="1.5px solid red"
        }
    })
    .catch(error => console.error('Il y a eu un problème avec votre requête fetch:', error.message))
    .finally(() => console.log('Ceci est exécuté quoi qu\'il arrive.'));

    console.log('Ceci est exécuté directement.');
});

log.addEventListener('submit',(event)=>{
    erromdp.style.visibility="hidden";
    password.style.border="none";
    if(!submitAllowed){
        event.preventDefault();
        const formData = new FormData();
        formData.append('user', user.value);
        formData.append('password', password.value);
        fetch('../connexion.php', {
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
            console.log(data.status);
            if(data.status=="error"){
                erromdp.textContent=""+data.message+"";
                erromdp.style.visibility="visible";
                password.style.border="1.5px solid red";
            }
            else{
                submitAllowed = true;
                load.id="loading";
                setTimeout(() => {
                    load.id="noload";
                    login.click();
                    
                }, 5000);
                
                
            }
        })
        .catch(error => console.error('Il y a eu un problème avec votre requête fetch:', error.message))
        .finally(() => console.log('Ceci est exécuté quoi qu\'il arrive.'));

        console.log('Ceci est exécuté directement.');
    }
});

password.addEventListener('keyup',()=>{
    erromdp.style.visibility="hidden";
    password.style.border="none";
})