function onJsonUsername(json) {
    //console.log(json);
    //controllo il campo exists ritornato dal json
    const errorjs = document.querySelector('#emuser');
    if (!json.exists) {
        errorjs.textContent='';
    } else {
       errorjs.textContent="Username già utilizzato. Provane un altro!";
    }
}

function onJsonEmail(json){
    const errorjs = document.querySelector('#ememail');
    if (!json.exists) {
        errorjs.textContent='';
    } else {
       errorjs.textContent="E-mail già utilizzata!";
    }
}

function onResponse(response) {
    return response.json();
}

function user_validate(){
    const regex = /^[a-zA-Z0-9]+$/; // regex per caratteri alfanumerici
    const errorjs = document.querySelector('#emuser');
    if(!regex.test(username.value)){
        errorjs.textContent="L'username può contenere solo caratteri alfanumerici!";
   } 
   else{
    //tramite fetch possiamo aprire e leggere il contenuto di un URL da js
    //passiamo tramite parametro l'username scritto dall'utente
    fetch("http://localhost/check_username.php?q="+encodeURIComponent(username.value)).then(onResponse).then(onJsonUsername);
   }
}

function email_validate(){
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; //regex per e-mail
    const errorjs = document.querySelector('#ememail');
    if(!regex.test(email.value)){
        errorjs.textContent="E-mail non valida!";
   } 
   else{
    fetch("http://localhost/check_email.php?q="+encodeURIComponent(String(email.value).toLowerCase())).then(onResponse).then(onJsonEmail);
    errorjs.textContent='';
   }
}

function password_validate(){
    const errorjs = document.querySelector('#empass');
    if(password.value.length < 7 || password.value.indexOf(" ") != -1){
        errorjs.textContent="La password deve avere almeno 7 caratteri (senza spazi)!";
    }
    else{
        errorjs.textContent='';
    }
}

function confpass_validate(){
    const errorjs = document.querySelector('#emconf');
    if(password.value==confirmpassword.value){
        errorjs.textContent='';
    }
    else{
        errorjs.textContent='Le password non coincidono!'
    }
}

//main
const username = document.querySelector('input[name="username"]');
const email = document.querySelector('input[name="email"]');
const password = document.querySelector('input[name="password"]');
const confirmpassword = document.querySelector('input[name="confirmpassword"]');

username.addEventListener('blur', user_validate);
email.addEventListener('blur', email_validate);
password.addEventListener('blur', password_validate);
confirmpassword.addEventListener('blur', confpass_validate);
