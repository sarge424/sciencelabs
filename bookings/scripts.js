let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);


function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");

        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
            else if (date > daysInMonth) {
                break;
            }

            else {
                let cell = document.createElement("td");
                cell.id = date;
                cell.onclick = function () {
                    let queryString = "?year=" + currentYear + "&month=" + currentMonth + "&date=" + cell.id;
                    document.location.href = "viewdaybookings.html" + queryString;
                };
                addColor(cell, date);
                let cellText = document.createTextNode(date);
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }

}

function addColor(cell, date) {
    if (currentMonth < 9)
        if (date < 10)
            total_date = currentYear + " 0" + (currentMonth + 1) + " 0" + date;
        else
            total_date = currentYear + " 0" + (currentMonth + 1) + " " + date;
    else
        if (date < 10)
            total_date = currentYear + " " + (currentMonth + 1) + " 0" + date;
        else
            total_date = currentYear + " " + (currentMonth + 1) + " " + date;
    

    let request;

    try {
        request = new XMLHttpRequest();
    } catch (e) {
        try {
            request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
                return false;
            }
        }
    }

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            switch (Number(request.responseText)){
                case 0: cell.classList.add("btn-outline-success"); break;
                case 1: cell.classList.add("btn-outline-warning"); break;
                case 2: cell.classList.add("btn-outline-warning"); break;
                case 3: cell.classList.add("btn-outline-warning"); break;
                case 4: cell.classList.add("btn-outline-danger");
            }
        }
    }

    let queryString = "?date=" + total_date;
    request.open("GET", "findslotstaken.php" + queryString, true);
    request.send(null);
}