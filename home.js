function Menu(){
    const menu = document.querySelector("#menu");
    menu.classList.toggle('wide');
}


function new_workout(event){
    const checked_boxes = document.querySelectorAll('input[name="exercises[]"]:checked');
    const checked_array = Array.from(checked_boxes);
    if(checked_array.length!=0){
    let stringa = '';
    for(let exercise of checked_array){
        const exercise_name = exercise.value;
        stringa += exercise_name;
        stringa += '<br>';
    }
    //console.log(stringa);
    fetch("new_workout.php?q="+stringa);
    window.location.href = "home.php";
    }
}


function onJson(json){
    //console.log(json);

    const container = document.querySelector("#results");;

    for(let exercise of json){
        //console.log(exercise.Name);
        //console.log(exercise["Youtube link"]);

        const ex = document.createElement('div');
        
        const checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.name = "exercises[]";
        checkbox.value = exercise.Name;
        //console.log(checkbox.name);
        //console.log(checkbox.value);

        const lab_name = document.createElement('label');
        lab_name.innerHTML = exercise.Name;
        lab_name.classList.add('exe_label');
        ex.appendChild(lab_name);
        lab_name.appendChild(checkbox);

        const link = document.createElement('a');
        link.href = exercise["Youtube link"];
        link.innerHTML = exercise["Youtube link"];
        link.classList.add('exlink');
        ex.appendChild(link);

        ex.classList.add('exe');

        container.appendChild(ex);
    }
    const cont = document.querySelector('#container');
    cont.classList.add('container');
    cont.classList.remove('hidden');
}


function onResponse(response){
    //console.log(response);
    return response.json();
}



function search(event){
    const checked_boxes = document.querySelectorAll('input[name="muscle[]"]:checked');
    const checked_array = Array.from(checked_boxes);

    const container = document.querySelector("#results");
    container.innerHTML='';

    var loadingBar = document.getElementById('loading-bar');
    loadingBar.classList.remove('hidden');
    var width = 0;
    var interval = setInterval(frame, 10);

    function frame() {
        if (width >= 100) {
            clearInterval(interval);
        } else {
            width++;
            loadingBar.style.width = width + '%';
        }
    }

    for(let muscle of checked_array){
        const checked_muscle = muscle.value;
        //console.log(checked_muscle);
        fetch("search.php?q="+encodeURIComponent(checked_muscle)).then(onResponse).then(onJson);
    }
    event.preventDefault();
}

const search_form= document.querySelector("#search form");
search_form.addEventListener("submit", search);



const workout_btn = document.querySelector('.workout');
workout_btn.addEventListener("click", new_workout);

const navbar = document.querySelector(".navbar");
navbar.addEventListener("click", Menu);



