function nextSlide(e){
    var slides = e.target.previousElementSibling.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.nextElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.nextElementSibling.classList.add('active');
    }

    var circles = e.target.nextElementSibling;
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
    var circles = e.target.nextElementSibling.nextElementSibling;
    var currentActiveCircle = circles.querySelector("div.active");
    if (currentActiveCircle.previousElementSibling != null){
        currentActiveCircle.classList.remove('active');
        currentActiveCircle.previousElementSibling.classList.add('active');
    }
}