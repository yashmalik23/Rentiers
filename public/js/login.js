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
    let mem = data["signupas"].toLowerCase()
    if(data["password"] != data["confirm"]){
        alert("Password doesn't match")
        return false
    }else if(data["name"] == "" || data["contact"] == "" || data["email"] == ""){
        alert("Fill the details please")
        return false
    }else if(mem != "member" && mem != "seller"){
        alert("Choose between member and seller")
        return false
    }
    return true
}