function nextSlide(e){
    var slides = e.target.previousElementSibling.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.nextElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.nextElementSibling.classList.add('active');
    }
    
}
function previousSlide(e){
    var slides = e.target.previousElementSibling;
    var currentActiveSlide = slides.querySelector('div.active');
    if (currentActiveSlide.previousElementSibling != null){
        currentActiveSlide.classList.remove('active');
        currentActiveSlide.previousElementSibling.classList.add('active');
    }
}

function changeTab(e, index, price){
    let slides = e.target.parentElement.nextElementSibling;
    var currentActiveSlide = slides.querySelector('img.active');
    if (currentActiveSlide != null){
        currentActiveSlide.classList.remove('active');
        slides.children[index].classList.add('active');
    }
    var tabs = e.target.parentElement;
    currentActiveSlide = tabs.querySelector('div.active');
    if (currentActiveSlide != null){
        currentActiveSlide.classList.remove('active');
        e.target.classList.add('active');
    }

    document.getElementById('tab-price-tag').textContent = price;
}



