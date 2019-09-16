function validateforms(){

    let form1 = document.getElementById('form-1');
    let form2 = document.getElementById('form-2');
    // let form3 = document.getElementById('form-3');
    // let form4 = document.getElementById('form-4');
    // let form5 = document.getElementById('form-5');
    
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
    }
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
function showModal(message){
    alert(message);
}