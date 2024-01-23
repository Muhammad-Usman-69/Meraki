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

let tableRows = document.querySelectorAll(".tr");
let pages = document.querySelector(".pages");
let pageContainer = document.querySelector(".page-container");

let titles = document.querySelectorAll(".title");
let descriptions = document.querySelectorAll(".description");

function pagination() {

    //taking value of serach
    let query = document.querySelector(".search").value;

    //initializing array to contain query letters
    let arr = [];
    //splitting words

    let words = query.split(" ");

    //pushing words into arr
    words.forEach(word => {
        word = word.toLowerCase();
        arr.push(word);
    })

    //taking value of index
    let index = document.querySelector("#num").value;

    //initializing increamenting value for number of rows for showing first five
    let numRows = 0;

    //initializing increamenting value for number of elements with results
    let searchRows = 0;

    //initializing value for number of hidden elements
    let hiddenRows = 0;

    //initializing value for total rows
    let totalRows = 0;

    //looping through arr containing query words
    for (let i = 0; i < arr.length; i++) {

        //initializing element for title
        let element = 0;

        tableRows.forEach(rows => {

            if (query != "") {
                rows.classList.add("hidden");
            }

            //checking for title
            let title = titles[element].value.toLowerCase();

            //checking by id
            let id = rows.id;

            //checker
            if ((id == arr[i] || title.includes(arr[i])) && query != "") {

                if (searchRows < index) {
                    rows.classList.remove("hidden");

                } else {
                    rows.classList.add("hidden");
                }
                
                //incrementing value of number of search rows
                searchRows++;
            }
            //increamenting element
            element++;


        });
        element = 0;
    }

    //clearing value of number of rows
    numRows = 0;

    tableRows.forEach(rows => {

        //check if query is clear
        if (query == "") {

            //making rows visible if number of rows is is less than index
            if (numRows < index) {
                rows.classList.remove("hidden");
            } else {
                rows.classList.add("hidden");
            }

        }

        numRows++;

        //increment the value to number of hidden rows
        if (rows.classList.contains("hidden")) {
            hiddenRows++;
        }
        //increamenting rows value
        totalRows++;

    })

    //if rows are hidden show pages
    /* if (hiddenRows > 0) {

        //reseting the pages 
        pages.innerHTML = "";

        //show pagination container
        pageContainer.classList.remove("hidden");

        //getting the number of pages
        let numPages = Math.ceil(totalRows / index);

        //looping to get pages
        for (let i = 1; i <= numPages; i++) {
            pages.innerHTML +=
                `<button type="button" class="bg-gray-700 px-4 py-3 hover:bg-gray-600 hover:text-white first:rounded-l-md last:rounded-r-md pg">` + i + `</button>`;
        }
    } else {

        //hide container
        pageContainer.classList.add("hidden");

        //reseting the pages 
        pages.innerHTML = "";
    } */
}


//initiating events to start function of pagination
window.addEventListener("load", pagination);


/* let pages = document.querySelectorAll(".pg");

pages.forEach(page => {
    console.log(Number(page.innerHTML));
}) */