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


    let thirdoption = document.getElementById('more-options');
    let multipleUnits = document.getElementById('multiple-units');


    let otherOptions = ["Residential land","Residential plot","Others"]

    if(target.textContent == "Residential"){

        thirdoption.style.display = "none";
        multipleUnits.style.display = "none";

        let pop = ["Apartment/Flat/Builder Floor","Residential land","Residential plot","House/Villa","Others"];
        populateOtheroption(pop,"populate-second-option");

    }else if(target.textContent == "Commercial"){

        thirdoption.style.display = "none";
        multipleUnits.style.display = "block";

        populateOtheroption(["Yes","No"],"multiple-unit");

        let pop = ["Offices","Retail","Land","Industry","Storage","Hospitality","Others"];
        populateOtheroption(pop,"populate-second-option");

    }else if(target.textContent == "Apartment/Flat/Builder Floor"){

        thirdoption.style.display = "block";

        let pop = ["Residential Apartment","Independent Floor","Studio Apartment"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "House/Villa"){

        thirdoption.style.display = "block";

        let pop = ["Independent House/Villa", "Farm House"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "Offices"){

        thirdoption.style.display = "block";

        let pop = ["Commercial Office/Space","Business Center","Time Share","Office in IT Park"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "Retail"){

        thirdoption.style.display = "block";

        let pop = ["Commercial Shops","Commercial Showrooms","Space in Mall"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "Land"){

        thirdoption.style.display = "block";

        let pop = ["Commercial land","Agricultural Land","Industrial Plots"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "Industry"){

        thirdoption.style.display = "block";

        let pop = ["Factory","Manufacturing"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "Storage"){

        thirdoption.style.display = "block";

        let pop = ["Ware house","Cold Storage"];
        populateOtheroption(pop,"populate-third-option");

    }else if(target.textContent == "Hospitality"){

        thirdoption.style.display = "block";

        let pop = ["Hotels/Resorts","Guest House/ Banquet Halls"];
        populateOtheroption(pop,"populate-third-option");

    }else if (otherOptions.indexOf(target.textContent)>-1){

        thirdoption.style.display = "none";

    }
    let hiddeninput = e.target.parentElement.parentElement.nextElementSibling;
    if(hiddeninput != null){
        hiddeninput.value = e.target.textContent;
        console.log(document.getElementById('doccc').value);
    }

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
            e.target.parentElement.nextElementSibling.value = options[i].children[1].textContent;
        }else{
            img.src = 'images/listprops/radio-empty.svg';
        }
    }
}

function populateOtheroption(popArray, id){

    let target = document.getElementById(id);
    target.innerHTML = "";
    target.previousElementSibling.previousElementSibling.textContent = "Select";


    for(let i in popArray){
        var newOption = document.createElement("li");
        newOption.innerHTML = popArray[i];
        newOption.onclick = function (e){
            changeoption(e);
        }
        target.appendChild(newOption);
    }
}