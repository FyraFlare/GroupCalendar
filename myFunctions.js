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

var event;
var eventTot;
               
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
//Adds to Database
function addEventToDatabase(creator, event){
    var args = {want: 'addEvent', creator: creator, event: event};
    $http.post("wanted.php", args).then(function(data){
        console.log(data);
    });
}
//Removes from Database
function removeEvent(creator, event){
    var args = {want: 'removeEvent', creator: creator, event: event};
    $http.post("wanted.php", args).then(function(data){
        console.log(data);
    });
}
//Store number of events by creator on specified day in eventTot
function retrieveEventTot(creator){
    var args = {want: 'eventAmount', creator: creator};
    $http.post("wanted.php", args).then(function(data){
        console.log(data);
        eventTot = data;
    });
}
// Store a specified event in event
function retrieveEvent(creator, num){
    if(num <= eventTot){
        var args = {want: 'event', creator: creator, num: num};
        $http.post("wanted.php", args).then(function(data){
            var args = {want: 'eventInfo', info: 'event'};
            $http.post("wanted.php", args).then(function(data){
                event.dis = data;
            });
        });
        event.creator = creator;
        event.num = num;
    }
    else{
        console.log('Invalid: No more events that day.');
    }
}
// Get group members
function memberlist(group){
    var args = {want: 'memberAmount', group: group}
    $http.post("wanted.php", args).then(function(data){
        for(var i = 1; i <= data; i++){
            var args = {want: 'member', num: i};
            $http.post("wanted.php", args).then(function(data){
                // data is the user name of the group member
            });
        }
    });
}

function login(){
    var user = document.getElementById('username').value;
    var pass = document.getElementById('pass').value;
    var args = {submit: 'Login', username: user, pass: pass};
    $http.post("login.php", args).then(function(data){
        if(data == 'good'){
            window.location.assign("http://localhost/Group_Calendar/main.html");
        }
        else{
            document.getElementById('error').innerHTML = data;
        }
    });
}

function logout(){
    var args = {want: 'logout'};
    $http.post("wanted.php", args).then(function(data){
        console.log(data);
        window.location.assign("http://localhost/Group_Calendar/login.html");
    });
}

function register(){
    var pass1 = document.getElementById('pass1').value;
    var pass2 = document.getElementById('pass2').value;
    if(pass1 != pass2){
        document.getElementById('error').innerHTML = 'Passwords do not match';
        return;
    }
    var args = {submit: 'Register', username: document.getElementById('username').value, pass: pass1};
    $http.post("login.php", args).then(function(data){
        if(data == 'good'){
            window.location.assign("http://localhost/Group_Calendar/login.html");
        }
        else{
            document.getElementById('error').innerHTML = data;
        }
    });
}

//This came from elsewhere
var $http = (function (){
    'use strict';

    function ajax(method, uri, args){
        var promise = new Promise(function(resolve, reject){
            var req = new XMLHttpRequest();
            var url =  uri;
            var parameters = '';
            req.open(method, url);

            if(args && (method === 'POST' || method === 'PUT')){
                req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                if(args && typeof args === 'object'){
                    for(var k in args){
                        parameters+= k + '=' + args[k] + '&';
                    }
                }
            }
            req.send(parameters);
            req.onload = function (){
                if(req.status >= 200 && req.status < 300){
                    resolve(req.response);
                }
                else{
                    reject(req.statusText);
                }
            };
            req.onerror = function(){
                reject(req.statusText);
            };
        });
        return promise;
    }

    return {
        get : function(uri, args, callback){
            if (args && typeof args === 'function'){
                callback = args;
            }
            if(callback && typeof callback === 'function'){
                return ajax('GET', uri, args).then(callback)
            }
            return ajax('GET', uri, args);
        },
        post : function(uri, args, callback){
            if (args && typeof args === 'function'){
                callback = args;
            }
            if(callback && typeof callback === 'function'){
                return ajax('POST', uri, args).then(callback)
            }
            return ajax('POST', uri, args);
        },
    };
}());

