function changecheck(e){
    let checkbox = e.target;
    
    if(checkbox.src.indexOf('images/listprops/unchecked.svg')>-1){
        checkbox.src = 'images/listprops/checked.svg'
        checkbox.style.width = "15px";
    }else{
        checkbox.src = 'images/listprops/unchecked.svg'
        checkbox.style.width = "12px";
    }
}
function changeForm(){
    let signup = document.getElementsByClassName('signup-form')[0];
    let login = document.getElementsByClassName('login-form')[0];

    if(signup.style.display != "none"){
        signup.style.display = "none";
        login.style.display = "block";
    }else{
        signup.style.display = "block";
        login.style.display = "none";
    }
}

function registerUser(){
    let data = {};
    let form = document.getElementsByClassName('signup-form')[0].children;
    let fields = ["name","contact","email","password","confirm","signupas"];
    for(i=1;i<7;i++){
        let child = form[i].children[1];
        data[fields[i-1]] = child.value;
    }
    let val = validate(data);
    if (val == true){ 
        let button = document.getElementById('register-button');
        button.click();
    }
}

function checkLogin(){
    let button = document.getElementById('login-button');
    button.click();
}

function validate(data){
    let mem = document.getElementById('membercheck').textContent;
    if(data["password"] != data["confirm"]){
        document.getElementById('frontalert').textContent = "Password doesn't match"
        showalert()
        return false
    }else if(data["name"] == "" || data["contact"] == "" || data["email"] == ""){
        document.getElementById('frontalert').textContent = "Fill the details please"
        showalert()
        return false
    }else if(mem != "Member" && mem != "Seller"){
        document.getElementById('frontalert').textContent = "Fill the form"
        showalert()
        return false
    }
    return true
}

function changeoption(e){
    let target = e.target.parentElement.previousElementSibling.previousElementSibling;
    target.textContent = e.target.textContent;
   
    let hiddeninput = e.target.parentElement.parentElement.nextElementSibling;
    if(hiddeninput != null){
        hiddeninput.value = e.target.textContent;
    }

    let options = e.target.parentElement;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}

function showdrop(e){
    let options = e.target.nextElementSibling.nextElementSibling;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}