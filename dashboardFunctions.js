

function printEvents(events){
    console.log("Executing");
	var currTime = new Date().getTime();
	var tomorrow = new Date().getTime;
    var str = "";
    for(var i=0; i< events.length; i++){
        console.log(tomorrow - currTime);
        if(events[i].start > currTime){
			str = str + events[i].title + "<br>";
        }
    }
    console.log(str);
    document.getElementById("DashContent").innerHTML = str;
    console.log("Printed");
}

function loadDashboard(){
    console.log("Reloading Dashboard");
    var str = "<div id=\"Groups\" > Groups <hr/> </div>";
    str = str + "<div id=\"Message\"> Message <hr/> </div> ";
	str = str + "<div id=\"UpcomingEvents\" onclick=\"printEvents($(\'#Calendar\').fullCalendar(\'clientEvents\'));  return false;\"> Upcoming Events <hr/> </div> </div>";
    document.getElementById("DashContent").innerHTML = str;
}