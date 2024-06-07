//showing and hiding menu
let menu = document.querySelector(".menu");
let menuContainer = document.querySelector(".menu-container");
let dashLink = document.querySelector(".dashboard-link");

function displayMenu() {
  menu.classList.toggle("w-[0%]");
  menuContainer.classList.toggle("w-[0%]");
  dashLink.classList.toggle("ml-10");
}

// displayMenu();

//alert
function hideAlert(element) {
  //hiding alert
  element.parentNode.classList.add("opacity-0");

  //removing alert
  setTimeout(() => {
    element.parentNode.remove();
  }, 200);
}
