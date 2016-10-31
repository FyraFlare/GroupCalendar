

function printEvents(events){
    console.log("Executing");
    var str = "";
    for(var i=0; i< events.length; i++){
        console.log(events[i].title);
        str = str + events[i].title + "<br>";
        
    }
    console.log(str);
    document.getElementById("DashContent").innerHTML = str;
    console.log("Printed");
}

function loadDashboard(){
    console.log("Reloading Dashboard");
    var str = "<div id=\"Groups\" onclick=\"printEvents($(\'#Calendar\').fullCalendar(\'clientEvents\'));  return false;\"> Groups <hr/> </div>";
    str = str + "<div id=\"Message\"> Message <hr/> </div> </div>";
    document.getElementById("DashContent").innerHTML = str;
}