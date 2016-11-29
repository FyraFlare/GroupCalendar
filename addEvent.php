
<?php
// Values received via ajax
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$allDay = $_POST['allDay'];

 // connect to database
 $db = 'mysql:dbname=groupCalendar;host=127.0.0.1';
 $user = 'root';
 $password = '';
                
try{
	$dbConn = new PDO ($db, $user, $password);
	$dbConn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
catch (PDOException $e) {
	echo ('Error establishing Connection');
	exit();
}

// insert new event
$event = "INSERT INTO new_events (title, start, end, allDay) VALUES (:title, :start, :end, :allDay)";
$stmt = $dbConn->prepare($event);
$stmt->execute(array(':title'=>$title, ':start'=>$start, ':end'=>$end,  ':allDay'=>$allDay));
?>