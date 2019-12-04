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

function changeMobileForm(){
    let form1 = document.getElementsByClassName('login-form')[0]
    let form2 = document.getElementsByClassName('signup-form')[0]
    let form3 = document.getElementsByClassName('mobile-form')[0]
        
    form1.style.display = "none"
    form2.style.display = "none"
    form3.style.display = "block"
}

function changeNormal(){
    let form1 = document.getElementsByClassName('login-form')[0]
    let form2 = document.getElementsByClassName('signup-form')[0]
    let form3 = document.getElementsByClassName('mobile-form')[0]
        
    form1.style.display = "block"
    form2.style.display = "none"
    form3.style.display = "none"
}

function checkMobile(){
    
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('mobile-submit', {'size': 'invisible'});
    var phoneNumber = "+91"+document.getElementById('mobile-number').value
    var appVerifier = window.recaptchaVerifier;
    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        .then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            document.getElementById('mobile-1').style.display = "none"
            document.getElementById('mobile-2').style.display = "block"
            document.getElementById('mobile-submit').style.display = "none"
            document.getElementById('mobile-submit-2').style.display = "block"
        }).catch(function (error) {
            document.getElementById('frontalert').textContent = error
            showalert()
            document.getElementById('mobile-submit').style.display = "block"
            document.getElementById('mobile-submit').textContent = "Send OTP"
    });
}

function verifyMobile(){
    var code = document.getElementById('otp-sent').value;
    confirmationResult.confirm(code).then(function (result) {
        document.getElementById('mobile-button').click()
    }).catch(function (error) {
        document.getElementById('frontalert').textContent = "Incorrect OTP"
        showalert()
    });
}
