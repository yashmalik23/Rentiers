function previous2Form(){

    let form3 = document.getElementById('form-3');
    let form2 = document.getElementById('form-2');
    form3.style.display = "none";
    form2.style.display = "block";

    let seconddotted = document.getElementById("second-dotted");
    let nextoption = document.getElementById('list-third-option');
    seconddotted.src = "images/listprops/dotted.svg";
    nextoption.classList.remove("active-list-menu");

}

function changecheck(e){
    let checkbox = e.target;
    
    if(checkbox.src.indexOf('images/listprops/unchecked.svg')>-1){
        checkbox.src = 'images/listprops/checked.svg'
        checkbox.style.width = "18px";
    }else{
        checkbox.src = 'images/listprops/unchecked.svg'
        checkbox.style.width = "15px";
    }
}