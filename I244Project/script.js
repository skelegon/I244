
// clock template from http://www.w3schools.com/js/tryit.asp?filename=tryjs_timing_clock, with added functionality

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    var date = today.getDate();
    var month = today.getMonth()+1;
    var year = today.getFullYear();
    var weekday = new Array(7);

    weekday[0] = "Sunday";
    weekday[1] = "Monday";
    weekday[2] = "Tuesday";
    weekday[3] = "Wednesday";
    weekday[4] = "Thursday";
    weekday[5] = "Friday";
    weekday[6] = "Saturday";

    var n = weekday[today.getDay()];

    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    n + ", " + date + "." + month + "." + year + ", " + h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};
    return i;
}
