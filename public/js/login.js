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
        console.log("hi")
        signup.style.display = "none";
        login.style.display = "block";
    }else{
        signup.style.display = "block";
        login.style.display = "none";
    }
}