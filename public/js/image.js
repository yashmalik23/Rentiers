function showModal(e, id,name){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "block";
    document.getElementById('delete-prop').value = id;
    document.getElementById('image-name').value = name;
}
function closeModal(){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "none";
}