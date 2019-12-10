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
    let signup = document.getElementsByClassName('signup1')[0];
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
    var code = document.getElementById('otp-sent').value;
    confirmationResult.confirm(code).then(function (result) {
        document.getElementById('register-button').click()
    }).catch(function (error) {
        document.getElementById('frontalert').textContent = error
        showalert()
    });
    
}

function sendMail(){
    document.getElementById('mobile-button').click()
}

function emailPassword(){
    let signup = document.getElementsByClassName('signup1')[0];
    let login = document.getElementsByClassName('login-form')[0];
    let mobile = document.getElementsByClassName('mobile-form')[0];
    
    signup.style.display = "none";
    login.style.display = "none";
    mobile.style.display = "block";
}

function backToLogin(){
    let signup = document.getElementsByClassName('signup1')[0];
    let login = document.getElementsByClassName('login-form')[0];
    let mobile = document.getElementsByClassName('mobile-form')[0];
    
    signup.style.display = "none";
    login.style.display = "block";
    mobile.style.display = "none";
}

function checkLogin(){
    let button = document.getElementById('login-button');
    button.click();
}

function validate(data){
    if(data["password"] != data["confirm"]){
        document.getElementById('frontalert').textContent = "Password doesn't match"
        showalert()
        return false
    }else if(data["name"] == "" || data["contact"] == "" || data["email"] == ""){
        document.getElementById('frontalert').textContent = "Fill the details please"
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


function checkMobile(){
    document.getElementsByClassName('loader')[0].style.display = "block"
    document.getElementsByClassName('signup-options')[0].style.display = "none"
    document.getElementsByClassName('signup-submit')[0].style.display = "none"
    let data = {};
    let form = document.getElementsByClassName('signup1')[0].children;
    let fields = ["name","contact","email","password","confirm"];
    for(i=0;i<5;i++){
        if(i != 1){
            let child = form[i].children[1];
            data[fields[i]] = child.value;
        }else{
            let child = form[i].children[2];
            data[fields[i]] = child.value;
        }
    }
    let val = validate(data);
    if (val == true){ 
        window.recaptchaVerifier = null
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('number', {'size': 'invisible'});
        var phoneNumber = document.getElementById('code').value+document.getElementById('number').value
        var appVerifier = window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
            .then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                document.getElementsByClassName('loader')[0].style.display = "none"
                document.getElementsByClassName('signup1')[0].style.display = "none"
                document.getElementsByClassName('signup2')[0].style.display = "block"
            }).catch(function (error) {
                document.getElementById('frontalert').textContent = error
                showalert()
        });
    }else{
        document.getElementsByClassName('loader')[0].style.display = "none"
        document.getElementsByClassName('signup-options')[0].style.display = "block"
        document.getElementsByClassName('signup-submit')[0].style.display = "block"
    }
}
