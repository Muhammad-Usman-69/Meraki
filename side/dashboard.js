//showing and hiding menu
let menu = document.querySelector(".menu");
let menuContainer = document.querySelector(".menu-container");
let dashLink = document.querySelector(".dashboard-link");

function displayMenu() {
  menu.classList.toggle("w-[0%]");
  menuContainer.classList.toggle("w-[0%]");
  dashLink.classList.toggle("ml-10");
}

//alert
function hideAlert(element) {
  //hiding alert
  element.parentNode.classList.add("opacity-0");

  //removing alert
  setTimeout(() => {
    element.parentNode.remove();
  }, 200);
}

//if width is small then close side menu
if (document.body.scrollWidth <= 768) {
  displayMenu();
}

//dividing the datetimes from database
let datetimes = document.querySelectorAll(".datetime");
let dates = document.querySelectorAll(".date");
let times = document.querySelectorAll(".time");
let arr = [];

//looping through input
datetimes.forEach((datetime) => {
  let values = datetime.value;

  //spliting the value and pushing them into array
  arr.push(values.split("T"));
});

//declaring i as an index
let i = 0;

//putting value of date
dates.forEach((date) => {
  date.value = arr[i][0];
  i++;
});

//reseting value of index
i = 0;

//putting value of time
times.forEach((time) => {
  time.value = arr[i][1];
  i++;
});
