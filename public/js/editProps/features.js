
function previous4Form(){

    let form4 = document.getElementById('form-5');
    let form3 = document.getElementById('form-4');
    form4.style.display = "none";
    form3.style.display = "block";

    let seconddotted = document.getElementById("fourth-dotted");
    let nextoption = document.getElementById('list-fifth-option');
    seconddotted.src = "/images/listprops/dotted.svg";
    nextoption.classList.remove("active-list-menu");

}