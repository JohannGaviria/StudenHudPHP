document.getElementById("btn-open").addEventListener("click", openCloseMenu);

var sideMenu = document.getElementById("menu-side");
var btnOpen = document.getElementById("btn-open");
var body = document.getElementById("body");

    function openCloseMenu(){
        body.classList.toggle("body-move");
        sideMenu.classList.toggle("menu-side-move");
    }

if (window.innerWidth < 760){

    body.classList.add("body-move");
    sideMenu.classList.add("menu-side-move");
}

window.addEventListener("resize", function(){

    if (window.innerWidth > 760){

        body.classList.remove("body-move");
        sideMenu.classList.remove("menu-side-move");
    }

    if (window.innerWidth < 760){

        body.classList.add("body-move");
        sideMenu.classList.add("menu-side-move");
    }

});