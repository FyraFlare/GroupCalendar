<?php
// Will hold json data for events table
 $json = array();

 // Retrieve events from DB
 $query = "SELECT * FROM new_events ORDER BY id";

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
 // Perform the query
 $results = $dbConn->query($query) or die(print_r($dbConn->errorInfo()));

 // sending the encoded result to success page
 echo json_encode($results->fetchAll(PDO::FETCH_ASSOC));

?>