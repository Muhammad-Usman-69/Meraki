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

//dividing the datetimes from database
let datetimes = document.querySelectorAll(".datetime");
let dates = document.querySelectorAll(".date");
let times = document.querySelectorAll(".time");
let arr = [];

//looping through input
datetimes.forEach(datetime => {
    let values = datetime.value;

    //spliting the value and pushing them into array
    arr.push(values.split("T"));
})

//declaring i as an index
let i = 0;

//putting value of date
dates.forEach(date => {
    date.value = arr[i][0];
    i++;
})

//reseting value of index
i = 0;

//putting value of time
times.forEach(time => {
    time.value = arr[i][1];
    i++;
})

//changing color of datetime input
function datetimeColor(element) {
    element.classList.add("text-white");
}

//taking form
let container = document.querySelector(".form-container div");

//takign height
let height = container.scrollHeight;

//hiding form
function formHide() {

    //hiding container
    container.classList.toggle("h-[" + height + "px]");
    container.classList.toggle("h-0");      

    //taking arrow image
    let arrow = document.querySelector(".form-container button img");

    //moving arrow
    arrow.classList.toggle("rotate-[270deg]");
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