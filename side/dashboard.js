//showing and hiding menu
let menu = document.querySelector(".menu");
let dashLink = document.querySelector(".dashboard-link");

function displayMenu() {
  menu.classList.toggle("w-full");
  if (dashLink.classList.contains("ml-0")) {
    setTimeout(() => dashLink.classList.remove("ml-0"), 200);
  } else {
    dashLink.classList.add("ml-0");
  }
}

displayMenu();
