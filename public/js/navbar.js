function handleMenu() {
    var menu = document.getElementsByClassName("mobile-nav-links")[0];
    var main = document.getElementsByClassName("man-layout")[0];

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
        if(alert.style.display =="none" || alert.style.display == ""){
            alert.style.display="block";
            alert.style.opacity = 1;
            window.setTimeout(function() {
                $(".frontalert").fadeTo(500, 0).slideUp(500,0);
            }, 2000);
        }
    }
}

function checkImages(e){
    let input = e.target;
    document.getElementById('loader').style.display = "block"
    document.getElementById('submitContainer').style.display = "none"
    if(input.files){
        if(input.files.length>10){
            document.getElementById('loader').style.display = "none"
            document.getElementById('submitContainer').style.display = "block"
            document.getElementById('frontalert').textContent = "More than 10 files are not allowed";
            showalert()
            e.target.value = "";
            return
        }else{
            for(let i=0; i<input.files.length; i++){
                if(input.files[i].size> 5242880){
                    document.getElementById('frontalert').textContent = "One of the file is greater than 5MB";
                    document.getElementById('loader').style.display = "none"
                    document.getElementById('submitContainer').style.display = "block"
                    showalert()
                    e.target.value = "";
                    return
                }
            }
            e.target.nextElementSibling.nextElementSibling.children[0].click()
        }
    }
}


function addOptions(e, arr, arr2){
    let list = e.target.nextElementSibling;
    let text = e.target.value;
    text = text.toLowerCase();
    list.innerHTML = "";
    arr = arr.split(",")
    arr2 = arr2.split(",")
    arr = arr.concat(arr2);
    for(let i in arr){
        if(arr[i].toLowerCase().indexOf(text)>-1){
            var newOption = document.createElement("li");
            newOption.innerHTML = arr[i];
            newOption.onclick = function (e){
                changesugg(e);
            }
            list.appendChild(newOption);
        }
    }
    list.style.display= "block";
    if(text == ""){
        list.style.display = "none";
    }
}

function changesugg(e){
    let target = e.target.parentElement.previousElementSibling;
    target.value = e.target.textContent;
    e.target.parentElement.style.display = "none";
}

function hideOptions(e){
    setTimeout(function(){
        e.target.nextElementSibling.style.display = "none" 
        },500);  
}