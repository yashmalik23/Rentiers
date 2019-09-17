function validateforms(){

    let form1 = document.getElementById('form-1');
    let form2 = document.getElementById('form-2');
    let form3 = document.getElementById('form-3');
    let form4 = document.getElementById('form-4');
    let form5 = document.getElementById('form-5');
    
    if(form1.style.display != "none"){

        let validation = true;
        let firstdotted = document.getElementById("first-dotted");
        let nextoption = document.getElementById('list-second-option');

        if(validation == true){

            form1.style.display = "none";
            form2.style.display = "block";
            firstdotted.src = "images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");
        }
    }else if(form2.style.display == "block"){
        let validation = true;
        let seconddotted = document.getElementById("second-dotted");
        let nextoption = document.getElementById('list-third-option');

        if(validation == true){

            form2.style.display = "none";
            form3.style.display = "block";
            seconddotted.src = "images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");

            let propertyType = document.getElementById("propertyType");
            let resOptions = document.getElementsByClassName('residential-options')[0];
            let commOptions = document.getElementsByClassName('commercial-options')[0];
            if(propertyType.textContent == "Residential"){
                resOptions.style.display = "block";
                commOptions.style.display = "none";
            }else{
                resOptions.style.display = "none";
                commOptions.style.display = "block";
            }
        }
    }else if(form3.style.display == "block"){

        let propertyType = document.getElementById("propertyType");
        let validation = false;
        if(propertyType.textContent == "Residential"){
            validation = true;
        }else{
            validation = true;
        }
        let thirddotted = document.getElementById("third-dotted");
        let nextoption = document.getElementById('list-fourth-option');

        if(validation == true){

            form3.style.display = "none";
            form4.style.display = "block";
            thirddotted.src = "images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");
        }
    }else if(form4.style.display == "block"){

        let validation = true;
        let firstdotted = document.getElementById("fourth-dotted");
        let nextoption = document.getElementById('list-fifth-option');

        if(validation == true){

            form4.style.display = "none";
            form5.style.display = "block";
            firstdotted.src = "images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");
        }
    }else if(form5.style.display == "block"){

        handleSubmit()
    }
}

function handleSubmit(){
    
}

function validateFirstForm(){
    let listedFor = document.getElementById("listedFor");
    let propertyType = document.getElementById("propertyType");
    let propertySecondType = document.getElementById("propertySecondType");
    let propertyThirdType = document.getElementById("propertyThirdType");
    let multipleUnits = document.getElementById("multipleUnits");

    let propertySecondOptions = ["Residential land","Residential plot","Others"];

    if(listedFor.textContent == "Select"){
        showModal("Select reason for listing");
        return false;
    }else if(propertyType.textContent == "Select"){
        showModal("Select property Type");
        return false;
    }else{
        if(propertySecondType.textContent == "Select"){
            showModal("Select property");
            return false;
        }else if(propertySecondOptions.indexOf(propertySecondType.textContent)<0){
            if(propertyThirdType.textContent == "Select"){
                showModal("Please add more details");
                return false;
            }else if(propertyType.textContent == "Commercial"){
                if(multipleUnits.textContent == "Select"){
                    showModal("Tell us about multiple Units");
                    return false;
                }
            }
        }
    }
    return true;
}

function validateSecondForm(){
    let city = document.getElementById('city');
    let houseNo = document.getElementById('houseNo');
    let locality = document.getElementById('locality');

    if(city.textContent == "Select"){
        showModal("Select city");
        return false;
    }else if(houseNo.value == ""){
        showModal("Enter house number");
        return false;
    }else if(locality.value == ""){
        showModal("Enter locality of your property");
        return false;
    }
    return true;
}


function validateThirdResidentForm(){
    let configuration = document.getElementById('configuration');
    let areaUnit = document.getElementById('areaUnit');
    let superArea = document.getElementById('superArea');
    let carpetArea = document.getElementById('carpetArea');
    let bathRooms = document.getElementById('bathRooms');
    let balconies = document.getElementById('balconies');
    let coveredParking = document.getElementById('coveredParking');
    let openParking = document.getElementById('openParking');
    let furnishing = document.getElementById('furnishing');
    let ageOfProperty = document.getElementById('ageOfProperty');
    let floor = document.getElementById('floor');
    let totalFloors = document.getElementById('totalFloors');

    if(configuration.textContent == "Select"){
        showModal("Select configuration");
        return false;
    }else if(areaUnit.textContent == "Select"){
        showModal("Select area unit");
        return false;
    }else if(superArea.value == ""){
        showModal("Enter super area");
        return false;
    }else if(carpetArea.value == ""){
        showModal("Enter carpet area");
        return false;
    }else if(bathRooms.value == ""){
        showModal("Enter number of bathrooms");
        return false;
    }else if(balconies.value == ""){
        showModal("Enter number of balconies");
        return false;
    }else if(coveredParking.value == ""){
        showModal("Enter covered parking");
        return false;
    }else if(openParking.value == ""){
        showModal("Enter open parking");
        return false;
    }else if(furnishing.textContent == "Select"){
        showModal("Select furnishing");
        return false;
    }else if(ageOfProperty.textContent == "Select"){
        showModal("Select age of property");
        return false;
    }else if(floor.value == ""){
        showModal("Enter floor of property");
        return false;
    }else if(totalFloors.value == ""){
        showModal("Enter total number of floors");
        return false;
    }
    return true;
}
function validateThirdCommercialForm(){
    let commavailabilty = document.getElementById('commavailabilty');
    let areaUnit = document.getElementById('commareaUnit');
    let superArea = document.getElementById('commsuperArea');
    let carpetArea = document.getElementById('commcarpetArea');
    let bathRooms = document.getElementById('commbathRooms');
    let balconies = document.getElementById('commbalconies');
    let ageOfProperty = document.getElementById('commageOfProperty');
    let floor = document.getElementById('commfloor');
    let totalFloors = document.getElementById('commtotalFloors');

    if(commavailabilty.textContent == "Select"){
        showModal("Select configuration");
        return false;
    }else if(areaUnit.textContent == "Select"){
        showModal("Select area unit");
        return false;
    }else if(superArea.value == ""){
        showModal("Enter super area");
        return false;
    }else if(carpetArea.value == ""){
        showModal("Enter carpet area");
        return false;
    }else if(bathRooms.value == ""){
        showModal("Enter number of bathrooms");
        return false;
    }else if(balconies.value == ""){
        showModal("Enter number of balconies");
        return false;
    }else if(ageOfProperty.textContent == "Select"){
        showModal("Select age of property");
        return false;
    }else if(floor.value == ""){
        showModal("Enter floor of property");
        return false;
    }else if(totalFloors.value == ""){
        showModal("Enter total number of floors");
        return false;
    }
    return true;
}

function validateFourthForm(){
    let contract = document.getElementById('contract');
    let includeCharges = document.getElementById('includeCharges');
    let expectedPrice = document.getElementById('expectedPrice');
    let otherCharges = document.getElementById('otherCharges');

    if(includeCharges.textContent == "Select"){
        showModal("Select inclusion of charges");
        return false;
    }else if(contract.textContent == "Select"){
        showModal("Select contract type");
        return false;
    }else if(expectedPrice.value == ""){
        showModal("Enter expected price");
        return false;
    }else if(otherCharges.value == ""){
        showModal("Enter none if no other charges");
        return false;
    }
    return true;
}


function showModal(message){
    alert(message);
}