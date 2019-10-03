function validateforms(){

    let form1 = document.getElementById('form-1');
    let form2 = document.getElementById('form-2');
    let form3 = document.getElementById('form-3');
    let form4 = document.getElementById('form-4');
    let form5 = document.getElementById('form-5');
    
    if(form1.style.display != "none"){

        let validation = validateFirstForm();
        let firstdotted = document.getElementById("first-dotted");
        let nextoption = document.getElementById('list-second-option');

        if(validation == true){

            form1.style.display = "none";
            form2.style.display = "block";
            firstdotted.src = "/images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");
        }
    }else if(form2.style.display == "block"){
        let validation = validateSecondForm();
        let seconddotted = document.getElementById("second-dotted");
        let nextoption = document.getElementById('list-third-option');

        if(validation == true){

            form2.style.display = "none";
            form3.style.display = "block";
            seconddotted.src = "/images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");

            let propertyType = document.getElementById("propertyType");
            let resOptions = document.getElementsByClassName('residential-options')[0];
            let commOptions = document.getElementsByClassName('commercial-options')[0];
            console.log(propertyType.value);
            if(propertyType.value == "Residential"){
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
            validation = validateThirdResidentForm();
        }else{
            validation = validateThirdCommercialForm();
        }
        let thirddotted = document.getElementById("third-dotted");
        let nextoption = document.getElementById('list-fourth-option');

        if(validation == true){

            form3.style.display = "none";
            form4.style.display = "block";
            thirddotted.src = "/images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");
        }
    }else if(form4.style.display == "block"){

        let validation = validateFourthForm();
        let firstdotted = document.getElementById("fourth-dotted");
        let nextoption = document.getElementById('list-fifth-option');

        if(validation == true){

            form4.style.display = "none";
            form5.style.display = "block";
            firstdotted.src = "/images/listprops/full.svg";
            nextoption.classList.add("active-list-menu");
        }
    }else if(form5.style.display == "block"){
        handleSubmit()
    }
}

function handleSubmit(){
    let submitObject = {}

    let propertyType = document.getElementById("propertyType").value;

    //Commercial and residential options

    if(propertyType == "Residential"){
        document.getElementById('configuration-hidden').value= document.getElementById("configuration").textContent;
        
        //Area
        let areaUnit = document.getElementById("areaUnit").textContent;
        console.log(areaUnit)
        let units = {
            "sq.ft.":1,
            "sq.yards":9,
            "sq.m.":10.764,
            "acres":43560,
            "hectares":107639
        }
        let superArea = parseInt(document.getElementById('superArea').value)*units[areaUnit];
        let carpetArea = parseInt(document.getElementById('carpetArea').value)*units[areaUnit];
        document.getElementById('area-hidden').value = superArea.toString()+"_"+carpetArea.toString();

        document.getElementById('bathRooms-hidden').value = parseInt(document.getElementById('bathRooms').value);
        document.getElementById('balconies-hidden').value = parseInt(document.getElementById('balconies').value);

        //Rooms (Checkbox)
        let rooms = document.getElementById('rooms').children;
        let roomString = ""
        for(let i=1; i<4;i++){
            let img = rooms[i].children[0];
            if(img.src.indexOf('/images/listprops/checked.svg')>-1){
                roomString=roomString.concat("1");
            }else{
                roomString=roomString.concat("0");
            }
        }
        document.getElementById('rooms-hidden').value = roomString;

        //Furnishing
        let furnishing = document.getElementById("furnishing").textContent;
        if(furnishing == "Semi furnished"){
            document.getElementById('furnishing-hidden').value = 10;
        }else if(furnishing == "Fully furnished"){
            document.getElementById('furnishing-hidden').value = 1;
        }else if(furnishing == "Unfurnished"){
            document.getElementById('furnishing-hidden').value = 100;
        }

        //covered and Open parking
        let coveredParking = parseInt(document.getElementById('coveredParking').value);
        let openParking = parseInt(document.getElementById('openParking').value);
        document.getElementById('parking-hidden').value = coveredParking.toString()+"_"+openParking.toString();

        document.getElementById('ageOfProperty-hidden').value = document.getElementById('ageOfProperty').textContent;
        document.getElementById('floor-hidden').value= parseInt(document.getElementById('floor').value);
        document.getElementById('totalFloors-hidden').value= parseInt(document.getElementById('totalFloors').value);
        document.getElementById('availability-hidden').value= document.getElementById('availability').textContent;

    }else if(propertyType == "Commercial"){
        document.getElementById('configuration-hidden').value= "Select";
        
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
        document.getElementById('area-hidden').value= superArea.toString()+"_"+carpetArea.toString();

        document.getElementById('bathRooms-hidden').value = parseInt(document.getElementById('commbathRooms').value);
        document.getElementById('balconies-hidden').value = parseInt(document.getElementById('commbalconies').value);

        //Rooms (Checkbox)
        document.getElementById('rooms-hidden').value = "000";

        //Furnishing
        let furnishing = document.getElementById("commfurnishing").textContent;
        if(furnishing == "Semi furnished"){
            document.getElementById('furnishing-hidden').value = 10;
        }else if(furnishing == "Fully furnished"){
            document.getElementById('furnishing-hidden').value = 1;
        }else if(furnishing == "Unfurnished"){
            document.getElementById('furnishing-hidden').value = 100;
        }

        //covered and Open parking
        document.getElementById('parking-hidden').value = "0_0";

        document.getElementById('ageOfProperty-hidden').value = document.getElementById('commageOfProperty').textContent;
        document.getElementById('floor-hidden').value= parseInt(document.getElementById('commfloor').value);
        document.getElementById('totalFloors-hidden').value= parseInt(document.getElementById('commtotalFloors').value);
        document.getElementById('availability-hidden').value= document.getElementById('commavailabilty').textContent;
    }
    
    document.getElementById('availableFrom-hidden').value= document.getElementById('aFrom').value;
    
    //Inventories
    let invchecks = document.getElementById('inventory-checks').children;
    let invchecksString = ""
    for(let i=0; i<9;i++){
        let img = invchecks[i].children[0];
        if(img.src.indexOf('images/listprops/checked.svg')>-1){
            invchecksString=invchecksString.concat("1");
        }else{
            invchecksString=invchecksString.concat("0");
        }
    }
    document.getElementById('invchecks-hidden').value= invchecksString;
    
    let countoptions = document.getElementsByClassName('count-options')
    let countString =""
    for(i=0;i<9;i++){
        countString = countString+countoptions[i].children[1].value+","
    }
    document.getElementById('invcounts-hidden').value = countString;

    //features
    let closeTo = document.getElementById('closeTo').children;
    let closeToString = ""
    for(let i=1; i<8;i++){
        let img = closeTo[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            closeToString=closeToString.concat("1");
        }else{
            closeToString=closeToString.concat("0");
        }
    }
    document.getElementById('closeTo-hidden').value= closeToString;

    let ameneties = document.getElementById('ameneties').children;
    let amenetiesString = ""
    for(let i=1; i<16;i++){
        let img = ameneties[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            amenetiesString=amenetiesString.concat("1");
        }else{
            amenetiesString=amenetiesString.concat("0");
        }
    }

    document.getElementById('ameneties-hidden').value = amenetiesString;

    let tenant = document.getElementById('tenant').children;
    let tenantString = ""
    for(let i=1; i<9;i++){
        let img = tenant[i].children[0];
        if(img.src.indexOf('/images/listprops/checked.svg')>-1){
            tenantString=tenantString.concat("1");
        }else{
            tenantString=tenantString.concat("0");
        }
    }
    document.getElementById('tenant-hidden').value = tenantString;
    document.getElementById('ownerss-hidden').value = document.getElementById('ownerDetails1').value+","+document.getElementById('ownerDetails2').value+","+document.getElementById('ownerDetails3').value;

    let button = document.getElementById('edit-props-submit');
    button.click();
}

function validateFirstForm(){
    return true;
}

function validateSecondForm(){
    let city = document.getElementById('city');
    let houseNo = document.getElementById('houseNo');
    let locality = document.getElementById('locality');
    let society = document.getElementById('streetName');

    if(city.textContent == "Select"){
        showModal("Select city");
        return false;
    }else if(houseNo.value == ""){
        showModal("Enter house number");
        return false;
    }else if(locality.value == ""){
        showModal("Enter locality of your property");
        return false;
    }else if(society.value == ""){
        showModal("Enter street/society of your property");
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
    let availability = document.getElementById('availability');

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
    }else if(availability.textContent == "Select"){
        showModal("Select availability");
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
    let includeCharges = document.getElementById('includeTaxes');
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
    document.getElementById('frontalert').textContent = message;
    showalert()
}