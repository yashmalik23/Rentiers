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

function changeradio(e){

    let options = e.target.parentElement.children;

    for(let i=0; i<4; i++){

        let img = options[i].children[0];
        if(options[i] == e.target){
            img.src = 'images/listprops/radio-full.svg';
        }else{
            img.src = 'images/listprops/radio-empty.svg';
        }
    }
}

function changemain(e){
    let filters = document.getElementById('main-filters');
    if(filters.style.display != "none"){
        filters.style.display = "none";
        e.target.src = 'images/search/plus.svg';
    }else{
        filters.style.display = "block";
        e.target.src = 'images/search/minus.svg';
    }
}

function changesub(e){
    let filters = e.target.parentElement.nextElementSibling;
    let input = e.target.previousElementSibling.textContent;
    if(filters.style.display != "none"){
        filters.style.display = "none";
        e.target.src = 'images/search/plus.svg';
    }else{
        if(input == "Budget"){
            filters.style.display = "flex";
        }else{
            filters.style.display = "block";
        }
        e.target.src = 'images/search/minus.svg';
    }
}