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