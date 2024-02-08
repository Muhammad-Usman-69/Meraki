//taking alert container
let alert = document.querySelector(".alert");

function copy(word) {

    //copying word
    let result = navigator.clipboard.writeText(word);


    if (result) {
        alert.classList.add("opacity-100");

        //showing if copied
        alert.innerHTML +=
            `<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded w-56 flex items-center justify-between fixed bottom-5 right-5 transition-all duration-200" role="alert">
                <strong class="font-bold text-sm">Copied Successfully!</strong>
                <span onclick="hideAlert(this);">
                    <svg class="fill-current h-6 w-6 text-green-600 border-2 border-green-700 rounded-full" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                    </svg>
                </span>
            </div>`;
    }
}

function hideAlert(element) {

    //hiding alert
    element.parentNode.classList.add("opacity-0");

    //hiding alert container
    alert.classList.remove("opacity-100");

    //removing alert
    setTimeout(() => {
        element.parentNode.remove();
    }, 200);
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
let pagesContainer = document.querySelector(".pages-container");
let pageNavContainer = document.querySelector(".page-nav-container");
let descriptions = document.querySelectorAll(".description");
let noResult = document.querySelector(".no-result");

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

    //initializing increamenting value for number of elements with results
    let searchRows = 0;

    //initializing value for number of hidden elements
    let hiddenRows = 0;

    //initializing value for total rows
    let totalRows = 0;

    //looping through arr containing query words
    for (let i = 0; i < arr.length; i++) {

        tableRows.forEach(rows => {

            if (query != "") {
                rows.classList.add("hidden");
            }

            //checking by id
            let id = rows.id;


            //checker
            if (id == arr[i] && query != "") {

                if (searchRows < index) {
                    rows.classList.remove("hidden");
                } else {
                    rows.classList.add("hidden");
                }

                //incrementing value of number of search rows
                searchRows++;
            }

        });

    }

    //<!---.>

    //taking active status
    let active = document.querySelector(".active");

    //taking status of active from img alt
    let status = active.querySelector("img").alt;

    //initializing j for number of status rows elements
    let j = 0;

    //initializing k for number of rows to show
    let k = 0;

    //initializing statusShownRows for number of rows to show
    let statusShownRows = 0;

    tableRows.forEach(rows => {

        //check if status is all
        if (status != "all" && query == "") {

            
            //taking each element
            let statusEle = statuses[j].innerHTML;
            
            //checking if element contains required status
            if (statusEle.includes(status)) {
                
                //checking if it is less than num of rows of show
                if (k < index) {
                    rows.classList.remove("hidden");
                }

                //increamenting num of rows that has been shown
                k++;
                
                statusShownRows++;

            } else {
                
                //hiding rows
                rows.classList.add("hidden");
            }

            //increamenting j for number of status rows elements
            j++;

        }

        //check if query is clear
        if (status == "all" && query == "") {

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
    } else if (status != "all") {
        //getting the number of pages through status rows
        numPages = Math.ceil(statusShownRows / index);
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

//declaring variable for elements with status
let statuses = document.querySelectorAll(".status");

// showing list accoring to status
function active(id) {

    //taking all status pages
    let statusPages = document.querySelectorAll(".status-button");

    //initializing i for number of status button
    let i = 0;

    statusPages.forEach(statusPage => {

        //if clicking button number matches i
        if (id == i) {

            //giving color to active status
            statusPage.classList.remove("bg-gray-700");
            statusPage.classList.remove("hover:bg-gray-600");
            statusPage.classList.add("bg-gray-100");

            //making it active
            statusPage.classList.add("active");

            //inverting the image of status
            let img = statusPage.querySelector("img");
            img.classList.remove("invert");


        } else {

            //removing color from unactive status
            statusPage.classList.remove("bg-gray-100");
            statusPage.classList.add("bg-gray-700");
            statusPage.classList.add("hover:bg-gray-600");

            //making it unactive
            statusPage.classList.remove("active");

            //inverting the image of other status
            let img = statusPage.querySelector("img");
            img.classList.add("invert");

        }

        //increamenting value for number of page button
        i++;

    })

    /*  //initializing j for number of status rows
     let j = 0;
 
     //initializing k for number of rows to show
     let k = 0;
 
     tableRows.forEach(rows => {
 
         //taking each element
         let statusEle = statuses[j].innerHTML;
 
         //taking value of num
         let num = document.getElementById("num").value;
 
 
         //checking if element contains required status
         if (statusEle.includes(status)) {
             
             //checking if it is less than num
             if (k < num) {
                 rows.classList.remove("hidden");
             }
             
             //increamenting num of rows that has been shown
             k++;
 
         } else {
 
             //hiding rows
             rows.classList.add("hidden");
         }
 
         j++;
     }) */

    pagination();
}