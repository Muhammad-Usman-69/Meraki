// adding showing function for menu list
let menuSec = document.querySelector(".menu");
let menuList = document.querySelectorAll(".menu li");
let x = 180;
function menu() {
    menuList.forEach((list, i) => {
        list.classList.toggle("h-9");
        list.style.transitionDelay = i * 0.1 + "s";
    });

    let menuImage = document.querySelector(".menu-img");
    let closeImage = document.querySelector(".close-img");

    //adding changing photo function for menu
    menuImage.classList.toggle("opacity-0");
    closeImage.classList.toggle("opacity-0");

    //adding rotating function for menu
    menuImage.style.transform = `rotate(${x}deg)`;
    closeImage.style.transform = `rotate(${x}deg)`;
    
    menuImage.style.transform = `rotate(${x}deg)`;
    closeImage.style.transform = `rotate(${x}deg)`;

    //increamenting value of x to rotate menu
    x+= 180;
}

//automatically adjusts height of form frame
function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}