let tableRows = document.querySelectorAll(".tr");
let pagesContainer = document.querySelector(".pages-container");
let pageNavContainer = document.querySelector(".page-nav-container");
let titles = document.querySelectorAll(".title");
let descriptions = document.querySelectorAll(".description");
let noResult = document.querySelector(".no-result");

function pagination() {

    //taking value of serach
    let query = document.querySelector(".search").value;

    //taking value of index
    let index = document.querySelector("#num").value;

    //initializing increamenting value for number of elements with results
    let searchRows = 0;

    //initializing value for number of hidden elements
    let hiddenRows = 0;

    //initializing value for total rows
    let totalRows = 0;

    //initializing element for title
    let element = 0;

    tableRows.forEach(rows => {

        if (query != "") {
            rows.classList.add("hidden");
        }

        //checking for title
        let title = titles[element].innerHTML.toLowerCase();

        //checking by id
        let id = rows.id;


        //checker
        if (id.includes(query) || title.includes(query) && query != "") {

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

    tableRows.forEach(rows => {

        //check if query is clear
        if (query == "") {

            //making rows visible if number of rows is is less than index
            if (totalRows < index) {
                rows.classList.remove("hidden");
            } else {
                rows.classList.add("hidden");
            }

        }

        //increment the value to number of hidden rows
        if (rows.classList.contains("hidden")) {
            hiddenRows++;
        }

        //increamenting rows value
        totalRows++;

    })

    //showing message if there is no result
    if (hiddenRows == totalRows) {
        noResult.classList.remove("hidden");
    } else {
        noResult.classList.add("hidden");
    }

    //declaring for the number of Pages
    let numPages;

    if (query != "") {
        //getting the number of pages through search rows
        numPages = Math.ceil(searchRows / index);
    } else {
        //getting the number of pages through total rows
        numPages = Math.ceil(totalRows / index);
    }

    //reseting the pages 
    pagesContainer.innerHTML = "";

    //show pagination container
    pageNavContainer.classList.remove("hidden");

    //hiding if there is only one page
    if (numPages != 1) {

        //looping to get pages
        for (let i = 1; i <= numPages; i++) {
            pagesContainer.innerHTML +=
                `<button type="button" onclick="changePage(this.innerHTML);" class="bg-gray-700 px-4 py-3 hover:text-white first:rounded-l-md last:rounded-r-md page">` + i + `</button>`;
        }
    } else {
        pageNavContainer.classList.add("hidden");
    }

    queries();
}

function changePage(pgNum) {

    //taking all pages
    let pages = document.querySelectorAll(".page");

    //initializing i for number of page button
    let i = 1;

    pages.forEach(page => {

        //if clicking button number matches i
        if (pgNum == i) {

            //giving color to active page
            page.classList.remove("bg-gray-700");
            page.classList.add("bg-gray-900");
            page.classList.add("text-white");

        } else {

            //removing color from unactive page
            page.classList.add("bg-gray-700");
            page.classList.remove("bg-gray-900");
            page.classList.remove("text-white");
        }

        //increamenting value for number of page button
        i++;
    })

    //initializing for number to show
    let num = document.querySelector("#num").value;

    //reseting i for condition to show
    i = 0;

    //initializing for rows to hide (it is the number of current page minus one and then multiplying by number of rows to show by pagination)
    let pageRowsHide = (pgNum - 1) * num;

    //pageRowsShow ha total rows or pageRowsHide ha (total rows - previous one)

    //initializing for number of rows
    let x = 0;

    tableRows.forEach(rows => {

        //page musn't be one
        if (pgNum == 1) {

            //taking table to normal
            if (i < num) {
                rows.classList.remove("hidden");
            } else {
                rows.classList.add("hidden");
            }

            i++;

            //stopping the script
            return;
        }

        //if number of rows is less than the pages to hide
        if (x < pageRowsHide) {

            //then hide them
            rows.classList.add("hidden");

        } else {

            //if i is less than the number of paginated rows
            if (i < num) {

                rows.classList.remove("hidden");
            } else {

                rows.classList.add("hidden");
            }

            i++;

        }

        //increamenting for number of rows
        x++;

    })

    queries();
}

//initiating events to start function of pagination
window.addEventListener("load", pagination);

function queries() {

    //initializing value for number of hidden elements
    let hiddenRows = 0;

    //initializing value for total rows
    let totalRows = 0;

    tableRows.forEach(rows => {

        //increment the value to number of hidden rows
        if (rows.classList.contains("hidden")) {
            hiddenRows++;
        }

        //increamenting rows value
        totalRows++;

    })

    //showing rows that are getting shown
    document.querySelector(".show").innerHTML =
        totalRows - hiddenRows;

    //showing total rows
    document.querySelector(".total").innerHTML =
        totalRows;
}