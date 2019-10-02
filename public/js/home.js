function dropdown(e){
    var options = e.target.nextElementSibling;
    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}
function changeoption(e){
    var text = e.target.textContent;
    e.target.parentElement.previousElementSibling.textContent = text

    let hiddeninput = e.target.parentElement.nextElementSibling;
    if(hiddeninput != null){
        hiddeninput.value = e.target.textContent;
    }

    var options = e.target.parentElement;
    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}
function nextSlideMain(e){
    var slides = e.target.previousElementSibling.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.nextElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.nextElementSibling.classList.add('active');
    }
    
}
function previousSlideMain(e){
    var slides = e.target.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.previousElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.previousElementSibling.classList.add('active');
    }
}
function nextSlide(e){
    var slides = e.target.previousElementSibling.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.nextElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.nextElementSibling.classList.add('active');
    }

    var circles = e.target.nextElementSibling.nextElementSibling;
    var currentActiveCircle = circles.querySelector("div.active");
    if (currentActiveCircle.nextElementSibling != null){
        currentActiveCircle.classList.remove('active');
        currentActiveCircle.nextElementSibling.classList.add('active');
    }
    
}
function previousSlide(e){
    var slides = e.target.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.previousElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.previousElementSibling.classList.add('active');
    }
    var circles = e.target.nextElementSibling.nextElementSibling.nextElementSibling;
    var currentActiveCircle = circles.querySelector("div.active");
    if (currentActiveCircle.previousElementSibling != null){
        currentActiveCircle.classList.remove('active');
        currentActiveCircle.previousElementSibling.classList.add('active');
    }
}

function scrollRecent(e){
    var slider = e.target.previousElementSibling;
    if (e.target.textContent == ">"){
        slider.scrollLeft = 1600;
        e.target.textContent = "<"
    }else{
        slider.scrollLeft = 0;
        e.target.textContent = ">"
    }
}

function scrollDown(e){
    let slider = e.target.previousElementSibling;
    console.log(slider);
    slider.scrollTop = 600;
}

function scrollUp(e){
    let slider = e.target.nextElementSibling;
    slider.scrollTop = 0;
}

function searchProps(){
    let button = document.getElementById('gosearch');
    button.click();
}