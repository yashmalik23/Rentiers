function handleMenu() {
    var menu = document.getElementsByClassName("mobile-nav-links")[0];
    var main = document.getElementsByClassName("main-layout")[0];

    if (menu.style.display == "" || menu.style.display == "none") {
        menu.animate([
            { transform: 'translatex(-100%)' },
            { transform: 'translatex(0%)' }
        ], {
                // timing options
                duration: 200,
                iterations: 1
            });
        main.style.marginLeft = "200px";
        menu.style.display = "inline-block";
    } else {
        main.style.marginLeft = "0px";
        menu.style.display = "none";
    }
}

function viewContacts(e){
    let numbers = e.target.nextElementSibling;
    if(numbers.style.display == "none" || numbers.style.display == ""){
        numbers.style.display = "block";
    }else{
        numbers.style.display = "none";
    }
}

function footerSubmit(){
    let button = document.getElementById('footer-button');
    button.click();
}

function togglechat(e){
    let form = e.target.nextElementSibling;
    if(form.style.display == "none" || form.style.display == ""){
        form.style.display = "block";
    }else{
        form.style.display = "none";
    }
}
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000);
function showalert(){
    let alert = document.getElementsByClassName('frontalert')[0];
    if(alert != null){
        console.log(alert.style.display);
        if(alert.style.display =="none" || alert.style.display == ""){
            alert.style.display="block";
            alert.style.opacity = 1;
            window.setTimeout(function() {
                $(".frontalert").fadeTo(500, 0).slideUp(500,0);
            }, 2000);
        }
    }
}

