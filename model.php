<?php
	//Name: Carly Cappagli
	//Discription: interacts with database
	$db = 'mysql:dbname=groupCalendar;host=127.0.0.1';
	$user = 'root';
	$password = '';

	try {
		$conn = new PDO ( $db, $user, $password );
	}catch ( PDOException $e ) {
		echo $e->getMessage ();
	}

	function register($name, $pass){
		global $conn;
		$name = htmlspecialchars($name);
		$pass = htmlspecialchars($pass);
		$hash = password_hash($pass, PASSWORD_DEFAULT);
		$stmt = $conn -> prepare("SELECT * FROM users WHERE username='".$name."';");
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
		}
		if($count < 1){
			$com = "INSERT INTO users VALUES ('".$name."', '".$hash."');";
			$stmt = $conn -> prepare($com);
			$stmt ->execute();
			echo 'good';
		}
		else{
			echo 'Username taken';
		}
	}

	function login($name, $pass){
		global $conn;
		$name = htmlspecialchars($name);
		$pass = htmlspecialchars($pass);
		$stmt = $conn -> prepare("SELECT password FROM users WHERE username='".$name."';");
		$stmt ->execute();
		$result = $stmt->fetchAll();
		if(count($result) == 1){
			foreach($result as $row){
				$psw = $row['password'];
			}
			if(password_verify($pass, $psw)){
				session_start();
				$_SESSION['user'] = $name;
				echo 'good';
			}
			else{
				echo 'Invalid username or password';
			}
		}
		else{
			echo 'Invalid username or password';
		}
	}

	function logout(){
		session_start();
		session_unset();
		session_destroy();
	}

	function addEvent($creator, $event, $year, $month, $day, $time, $lasts){
		global $conn;
		$creator = htmlspecialchars($creator);
		$event = htmlspecialchars($event);
		$com = "INSERT INTO events VALUES ('".$creator."', '".$event."', '".$year."', '".$month."', '".$day."', '".$time."', '".$lasts."');";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		echo 'good';
	}
?>