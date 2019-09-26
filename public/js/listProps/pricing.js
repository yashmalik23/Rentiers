
function previous3Form(){

    let form4 = document.getElementById('form-4');
    let form3 = document.getElementById('form-3');
    form4.style.display = "none";
    form3.style.display = "block";

    let seconddotted = document.getElementById("third-dotted");
    let nextoption = document.getElementById('list-fourth-option');
    seconddotted.src = "/images/listprops/dotted.svg";
    nextoption.classList.remove("active-list-menu");

}