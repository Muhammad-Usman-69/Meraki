// adding showing function for menu list
let menuList = document.querySelector(".menu-list");
function menu() {
    menuList.classList.toggle("h-0");
}

//automatically adjusts height of form frame
function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
}