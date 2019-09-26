function showModal(e, id){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "block";
    document.getElementById('delete-prop').value = id;
}
function closeModal(){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "none";
}
function showImageModal(e, id){
    let modal = document.getElementsByClassName('upload-image-modal')[0];
    modal.style.display = "block";
    document.getElementById('image-prop').value = id;
}
function closeImageModal(){
    let modal = document.getElementsByClassName('upload-image-modal')[0];
    modal.style.display = "none";
}