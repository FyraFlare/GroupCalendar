var months = new Array( "January", 
                        "February", 
                        "March", 
                        "April",
                        "May",
                        "June",
                        "July",
                        "August",
                        "September",
                        "October",
                        "November",
                        "December")
var monLengths = new Array( 31,
                            28,
                            31,
                            30,
                            31,
                            30,
                            31,
                            31,
                            30,
                            31,
                            30,
                            31 )
               
function setMonth(myDate, month, year){
    myDate.setDate(1);
    myDate.setMonth(month);     //manually change month
    myDate.setYear(year);   // manually change year
    
    // below if/else will change monLengths[1] (for february) 
    // to 29 for leap years, and if it is not a leap year it 
    // will change it back to 28 in case it was previously changed
    if(myDate.getMonth()==1){
        if(myDate.getFullYear() % 4 == 0 || (myDate.getFullYear() % 100 == 0 
            && myDate.getFullYear() % 400 == 0)){
                monLengths[1] = 29;
            }
    }
    else{
        monLengths[1] = 28;
    }
    getMonthAndYear(myDate);
    insertDates(myDate);
}              
function getMonthAndYear(date){
  //  myDate.setDate(1);  // currently set the date to 1 to print entire month
    document.getElementById("MonthTitle").innerHTML =   months[date.getMonth()] + 
                                                        " " + date.getFullYear();
    
}

function insertDates(date){
    var offset = date.getDate() - 1;  // offset is used to get correct date on calendar (starts at 0)
    var startIndex = date.getDay();   // startIndex is used to print starting on correct day of week
    for(var i = startIndex;i<monLengths[date.getMonth()]+startIndex;i=i+1, offset=offset+1){
        document.getElementById("Day"+i).innerHTML = date.getDate() + offset;
    }
    for(var i = 0; i < startIndex; i = i + 1){
        document.getElementById("Day" + i).innerHTML = "";
    }
    for(var i = monLengths[date.getMonth()]+startIndex; i < 42; i = i + 1){
        document.getElementById("Day" + i).innerHTML = "";
    }
}

function addEvent(str){
    
}
