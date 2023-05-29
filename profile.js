function onClick(event){
    const div_cont = event.target.parentNode;
    const div_id = div_cont.id;
    //console.log(div_cont);
    //console.log(div_id);
    fetch("delete_workout.php?q="+div_id);
    window.location.reload();   
}

function Menu(){
    console.log('a');
    const menu = document.querySelector("#menu");
    menu.classList.toggle('wide');
}

const navbar = document.querySelector(".navbar");
navbar.addEventListener("click", Menu);

const btn = document.querySelectorAll(".workout");
for(let button of btn){button.addEventListener("click", onClick);}