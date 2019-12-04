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
    let num = order.value.split(",")
    if (num.length == count-1 && count > 1){
        for(i=1;i<count;i++){
            if (num.indexOf(String(i))<0){
                showModal('Image numbers are incorrect')
                return
            }
        }
        button.click()
    }else{
        showModal('Incorrect count of number of images')
    }

}

function showModal(message){
    document.getElementById('frontalert').textContent = message;
    showalert()
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}