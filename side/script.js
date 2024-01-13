let menuSec = document.querySelector(".menu");
let menuList = document.querySelectorAll(".menu li");
let x = 180;
function menu() {
    // adding showing function for menu list and adding border
    menuList.forEach((list, i) => {
        list.classList.toggle("h-9");
        list.classList.toggle("border-b");
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

    //increamenting value of x to rotate menu
    x += 180;
}

//automatically adjusts height of form frame from message
function resizeIframe(event) {
    const height = event.data.height;
    const iframeId = event.data.iframeId;

    const iframe = document.getElementById(iframeId);

    if (iframe) {
        iframe.style.height = height + 'px';
    }
}

window.addEventListener('message', resizeIframe, false);