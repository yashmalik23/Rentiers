function showdrop(e){
    let options = e.target.nextElementSibling.nextElementSibling;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}

function changeoption(e){

    let target = e.target.parentElement.previousElementSibling.previousElementSibling;
    target.textContent = e.target.textContent;

    let options = e.target.parentElement;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}

function changeradio(e){

    let options = e.target.parentElement.children;

    for(let i=0; i<3; i++){

        let img = options[i].children[0];
        if(options[i] == e.target){
            img.src = 'images/listprops/radio-full.svg';
        }else{
            img.src = 'images/listprops/radio-empty.svg';
        }
    }
}
