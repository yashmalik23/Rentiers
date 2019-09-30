function handleMenu() {
    var menu = document.getElementById("side-nav");
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
        main.style.marginLeft = "250px";
        menu.style.display = "inline-block";
    } else {
        main.style.marginLeft = "0px";
        menu.style.display = "none";
    }
}

// Members
function searchMember(e){
    let search = e.target.previousElementSibling.value
    window.location.href = "/members/"+search.toLowerCase();
}
function showMemberModal(e, id){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "block";
    document.getElementById('member-user-delete').value = id;
}
function closeMemberModal(){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "none";
}

//Sellers
function searchSeller(e){
    let search = e.target.previousElementSibling.value
    window.location.href = "/sellers/"+search.toLowerCase();
}
function showSellerModal(e, id){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "block";
    document.getElementById('seller-user-delete').value = id;
}
function closeSellerModal(){
    let modal = document.getElementsByClassName('delete-modal')[0];
    modal.style.display = "none";
}

//Uassets
function searchUProps(e){
    let search = e.target.previousElementSibling.value
    window.location.href = "/uassets/"+search.toLowerCase();
}

//Vassets
function searchVProps(e){
    let search = e.target.previousElementSibling.value
    window.location.href = "/vassets/"+search.toLowerCase();
}

//Requests
function searchRequests(e){
    let search = e.target.previousElementSibling.value
    window.location.href = "/requests/"+search.toLowerCase();
}

function changeoption(e){
    let target = e.target.parentElement.previousElementSibling.previousElementSibling;
    target.textContent = e.target.textContent;
   
    let hiddeninput = e.target.parentElement.parentElement.nextElementSibling;
    if(hiddeninput != null){
        hiddeninput.value = e.target.textContent;
    }

    let options = e.target.parentElement;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}

function showdrop(e){
    let options = e.target.nextElementSibling.nextElementSibling;

    if (options.style.display == "none" || options.style.display == ""){
        options.style.display = "block";
    }else{
        options.style.display= "none";
    }
}

function showEditModal(e, id, status){
    let modal = document.getElementsByClassName('edit-modal')[0];
    modal.style.display = "block";
    document.getElementById('request-user-delete').value = id;
    document.getElementById('requestStatus').textContent = status;
}
function closeEditModal(){
    let modal = document.getElementsByClassName('edit-modal')[0];
    modal.style.display = "none";
}