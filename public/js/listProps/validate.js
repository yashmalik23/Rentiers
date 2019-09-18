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
    let submitObject = {}

    //Radio
    let postedBy = document.getElementById('postedBy').children;
    for(let i=0; i<3; i++){

        let img = postedBy[i].children[0];
        if(img.src.indexOf('images/listprops/radio-full.svg')>-1){
            submitObject["postedBy"] = img.nextElementSibling.textContent;
        }
    }
    
    //Select and normal inputs
    submitObject["listedFor"] = document.getElementById("listedFor").textContent;
    submitObject["propertyType"] = document.getElementById("propertyType").textContent;
    submitObject["propertySecondType"] = document.getElementById("propertySecondType").textContent;
    submitObject["propertyThirdType"] = document.getElementById("propertyThirdType").textContent;
    submitObject["multipleUnits"] = document.getElementById("multipleUnits").textContent;
    submitObject["houseNo"] = document.getElementById('houseNo').value;
    submitObject["streetName"] = document.getElementById('streetName').value;
    submitObject["nearByArea"] = document.getElementById('nearByArea').value;
    submitObject["locality"] = document.getElementById('locality').value;
    submitObject["city"] = document.getElementById('city').textContent;

    //Commercial and residential options
    let propertyType = submitObject["propertyType"];

    if(propertyType == "Residential"){

        submitObject["configuration"]= document.getElementById("configuration").textContent;
        
        //Area
        let areaUnit = document.getElementById("areaUnit").textContent;
        let units = {
            "sq.ft.":1,
            "sq.yards":9,
            "sq.m.":10.764,
            "acres":43560,
            "hectares":107639
        }
        let superArea = parseInt(document.getElementById('superArea').value)*units[areaUnit];
        let carpetArea = parseInt(document.getElementById('carpetArea').value)*units[areaUnit];
        submitObject["area"]= superArea.toString()+"_"+carpetArea.toString();

        submitObject["bathRooms"] = parseInt(document.getElementById('bathRooms').value);
        submitObject["balconies"] = parseInt(document.getElementById('balconies').value);

        //Rooms (Checkbox)
        let rooms = document.getElementById('rooms').children;
        let roomString = ""
        for(let i=1; i<4;i++){
            let img = rooms[i].children[0];
            if(img.src.indexOf('images/listprops/checked.svg')>-1){
                roomString=roomString.concat("1");
            }else{
                roomString=roomString.concat("0");
            }
        }
        submitObject["rooms"] = parseInt(roomString);

        //Furnishing
        let furnishing = document.getElementById("furnishing").textContent;
        if(furnishing == "Semi furnished"){
            submitObject["furnishing"] = 10;
            console.log(furnishing);
        }else if(furnishing == "Fully furnished"){
            submitObject["furnishing"] = 1;
        }else if(furnishing == "Unfurnished"){
            submitObject["furnishing"] = 100;
        }

        //covered and Open parking
        let coveredParking = parseInt(document.getElementById('coveredParking').value);
        let openParking = parseInt(document.getElementById('openParking').value);
        submitObject["parking"] = coveredParking.toString()+"_"+openParking.toString();

        submitObject["ageOfProperty"] = document.getElementById('ageOfProperty').textContent;
        submitObject["floor"]= parseInt(document.getElementById('floor').value);
        submitObject["totalFloors"]= parseInt(document.getElementById('totalFloors').value);
        submitObject["availableFrom"]= "None"
        submitObject["availabity"]= "None";

    }else if(propertyType == "Commercial"){
        submitObject["configuration"]= "Select";
        
        //Area
        let areaUnit = document.getElementById("commareaUnit").textContent;
        let units = {
            "sq.ft.":1,
            "sq.yards":9,
            "sq.m.":10.764,
            "acres":43560,
            "hectares":107639
        }
        let superArea = parseInt(document.getElementById('commsuperArea').value)*units[areaUnit];
        let carpetArea = parseInt(document.getElementById('commcarpetArea').value)*units[areaUnit];
        submitObject["area"]= superArea.toString()+"_"+carpetArea.toString();

        submitObject["bathRooms"] = parseInt(document.getElementById('commbathRooms').value);
        submitObject["balconies"] = parseInt(document.getElementById('commbalconies').value);

        //Rooms (Checkbox)
        submitObject["rooms"] = 000;

        //Furnishing
        let furnishing = document.getElementById("commfurnishing").textContent;
        if(furnishing == "Semi furnished"){
            submitObject["furnishing"] = 010;
        }else if(furnishing == "Fully furnished"){
            submitObject["furnishing"] = 001;
        }else if(furnishing == "Unfurnished"){
            submitObject["furnishing"] = 100;
        }

        //covered and Open parking
        submitObject["parking"] = "0_0";

        submitObject["ageOfProperty"] = document.getElementById('commageOfProperty').textContent;
        submitObject["floor"]= parseInt(document.getElementById('commfloor').value);
        submitObject["totalFloors"]= parseInt(document.getElementById('commtotalFloors').value);
        submitObject["availableFrom"]= "None"
        submitObject["availabity"]= document.getElementById('commavailabilty').textContent;
    }

    //pricing
    submitObject["contract"] = document.getElementById('contract').textContent;
    submitObject["expectedPrice"] = document.getElementById('expectedPrice').value;
    submitObject["includeTaxes"] = document.getElementById('includeTaxes').textContent;
    submitObject["otherCharges"] = document.getElementById('otherCharges').value;

    //features
    let closeTo = document.getElementById('closeTo').children;
    let closeToString = ""
    for(let i=1; i<8;i++){
        let img = closeTo[i].children[0];
        if(img.src.indexOf('images/listprops/checked.svg')>-1){
            closeToString=closeToString.concat("1");
        }else{
            closeToString=closeToString.concat("0");
        }
    }
    submitObject["closeTo"] = closeToString;

    let ameneties = document.getElementById('ameneties').children;
    let amenetiesString = ""
    for(let i=1; i<16;i++){
        let img = ameneties[i].children[0];
        if(img.src.indexOf('images/listprops/checked.svg')>-1){
            amenetiesString=amenetiesString.concat("1");
        }else{
            amenetiesString=amenetiesString.concat("0");
        }
    }
    submitObject["ameneties"] = amenetiesString;

    console.log(submitObject);
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