// adding showing function for menu list
let menuSec = document.querySelector(".menu");
let menuList = document.querySelectorAll(".menu li");
function menu() {
    menuList.forEach((list, i) => {
        list.classList.toggle("h-9");
        list.style.transitionDelay = i * 0.1 + "s";
    });

    let menuImage = document.querySelector(".menu-img");
    let closeImage = document.querySelector(".close-img");

    //adding rotating function for menu
    /* menuImage.classList.toggle("opacity-0");
    menuImage.style.transform = "rotate(180deg)";
    closeImage.classList.toggle("opacity-0");
    closeImage.style.transform = "rotate(180deg)"; */
}

//automatically adjusts height of form frame
function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}