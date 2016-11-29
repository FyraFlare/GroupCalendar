<?php

/* Values received via ajax */
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];


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

 // update the records
$query = "UPDATE new_events SET title=?, start=?, end=? WHERE id=?";
$stmt = $dbConn->prepare($query);
$stmt->execute(array($title,$start,$end,$id));
?>