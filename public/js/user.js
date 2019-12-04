function showModal(e, id){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "block";
    document.getElementById('delete-prop').value = id;
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
function closeModal(){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "none";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

let isSubmitting = false;


function showImageModal(e, id){
    let modal = document.getElementsByClassName('upload-image-modal')[0];
    modal.style.display = "block";
    document.getElementById('image-prop').value = id;
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    let form = document.getElementsByClassName('image-props')[0];
    
    let submit = document.getElementById('submitContainer');
    let loader = document.getElementById('loader');
    loader.style.display = 'none'
    submit.style.display = 'block'
    form.addEventListener('submit', ()=>{
        if (isSubmitting) {
            loader.style.display = 'flex'
            submit.style.display = 'none'
        } else {
            loader.style.display = 'none'
            submit.style.display = 'block'
        }
    });
}

function closeImageModal(){
    let modal = document.getElementsByClassName('upload-image-modal')[0];
    modal.style.display = "none";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function showSold(e, id, inUse){
    let modal = document.getElementsByClassName('sold-modal')[0];
    modal.style.display = "block";
    document.getElementById('sold-prop').value = id;
    document.getElementById('sold-prop-1').value = (inUse == 0)? 1: 0;
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    if (inUse == 0){
        document.getElementById('sold-title').textContent = "Do you want to mark this property as sold/rented out?"
    }else{
        document.getElementById('sold-title').textContent = "Do you want to mark this property as available?"
    }
}

function closeSold(){
    let modal = document.getElementsByClassName('sold-modal')[0];
    modal.style.display = "none";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}


