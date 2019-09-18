function dropdown(e){
    var options = e.target.nextElementSibling;
    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}
function changeoption(e){
    var text = e.target.textContent;
    e.target.parentElement.previousElementSibling.textContent = text
    var options = e.target.parentElement;
    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}