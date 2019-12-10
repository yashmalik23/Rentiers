function showIModal(e, id,name){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "block";
    document.getElementById('delete-prop').value = id;
    document.getElementById('image-name').value = name;
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
function closeModal(){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "none";
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function checkOrder(e, count){
    let button = document.getElementById('change-order-images')
    let order = e.target.previousElementSibling;
    let num = parseInt(order.value)
    if (num > 0 && num <count){
        button.click()
    }else{
        showModal('Image doesn\'t exist')
    }

}

function showModal(message){
    document.getElementById('frontalert').textContent = message;
    showalert()
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}