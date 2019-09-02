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
