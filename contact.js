function Menu(){
    const menu = document.querySelector("#menu");
    menu.classList.toggle('wide');
}

const navbar = document.querySelector(".navbar");
navbar.addEventListener("click", Menu);


