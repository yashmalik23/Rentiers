function showdrop(e){
    let options = e.target.nextElementSibling.nextElementSibling;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}


function previousForm(){

    let form2 = document.getElementById('form-2');
    let form1 = document.getElementById('form-1');
    form2.style.display = "none";
    form1.style.display = "block";

    let firstdotted = document.getElementById("first-dotted");
    let nextoption = document.getElementById('list-second-option');
    firstdotted.src = "/images/listprops/dotted.svg";
    nextoption.classList.remove("active-list-menu");

}
function addlistOptions(e, arr){
    let list = e.target.nextElementSibling;
    let text = e.target.value;
    text = text.toLowerCase();
    list.innerHTML = "";
    arr = arr.split(",")
    for(let i in arr){
        if(arr[i].toLowerCase().indexOf(text)>-1){
            var newOption = document.createElement("li");
            newOption.innerHTML = arr[i];
            newOption.onclick = function (e){
                changesugg(e);
            }
            list.appendChild(newOption);
        }
    }
    list.style.display= "block";
    if(text == ""){
        list.style.display = "none";
    }
}
