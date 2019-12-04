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

    let hiddeninput = e.target.parentElement.nextElementSibling;
    if(hiddeninput != null){
        hiddeninput.value = e.target.textContent;
    }

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
    checkAllFilters()
}

function changemain(e){
    let filters = document.getElementById('main-filters');
    if(filters.style.display != "none"){
        filters.style.display = "none";
        filters.parentElement.style.height = "50px";
        e.target.src = 'images/search/plus.svg';
    }else{
        filters.style.display = "block";
        filters.parentElement.style.height = "auto";
        e.target.src = 'images/search/minus.svg';
    }
}

function changesub(e){
    let filters = e.target.parentElement.nextElementSibling;
    let input = e.target.previousElementSibling.textContent;
    console.log(filters.style.display)
    if(filters.style.display == "flex" || filters.style.display == "block"){
        filters.style.display = "none";
        e.target.src = 'images/search/plus.svg';
    }else{
        if(input == "Budget(₹)"){
            filters.style.display = "flex";
        }else{
            filters.style.display = "block";
        }
        e.target.src = 'images/search/minus.svg';
    }
}

function checkAllFilters(){
    let budgets= document.getElementById('budget-start-from').value+"_"+document.getElementById('budget-end-at').value;
    let furnishing = document.getElementById('furnishing-filter').children;
    let furnishingString = ""
    for(let i=0; i<3;i++){
        let img = furnishing[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            furnishingString=furnishingString.concat("1");
        }else{
            furnishingString=furnishingString.concat("0");
        }
    }
    let closeTo = document.getElementById('closeto-filter').children;
    let closeToString = ""
    for(let i=0; i<7;i++){
        let img = closeTo[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            closeToString=closeToString.concat("1");
        }else{
            closeToString=closeToString.concat("0");
        }
    }
    let ameneties = document.getElementById('ameneties-filter').children;
    let amenetiesString = ""
    for(let i=0; i<13;i++){
        let img = ameneties[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            amenetiesString=amenetiesString.concat("1");
        }else{
            amenetiesString=amenetiesString.concat("0");
        }
    }
    let configuration = document.getElementById('configuration-filter').children;
    let configurationString = ""
    for(let i=0; i<6;i++){
        let img = configuration[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            configurationString=configurationString.concat("1");
        }else{
            configurationString=configurationString.concat("0");
        }
    }

    document.getElementById('budget-hidden').value = budgets;
    document.getElementById('furnishing-hidden').value = furnishingString;
    document.getElementById('configuration-hidden').value = configurationString;
    document.getElementById('ameneties-hidden').value = amenetiesString;
    document.getElementById('closeto-hidden').value = closeToString;

    let sortBy = document.getElementById('sortBy').children;
    let sortByString = ""
    for(let i=0; i<4;i++){
        let img = sortBy[i].children[0];
        if(img.src.indexOf('/images/listprops/radio-full.svg')>-1){
            sortByString=sortByString.concat("1");
        }else{
            sortByString=sortByString.concat("0");
        }
    }
    
    document.getElementById('sortBy-hidden').value = sortByString;

    let button = document.getElementById('gosearch');
    button.click();
}
function nextSlide(e){
    var slides = e.target.previousElementSibling.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.nextElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.nextElementSibling.classList.add('active');
    }
    
}
function previousSlide(e){
    var slides = e.target.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.previousElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.previousElementSibling.classList.add('active');
    }
}