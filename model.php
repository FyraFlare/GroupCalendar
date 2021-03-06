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
		$stmt = $conn -> prepare("SELECT * FROM users WHERE name=(:name)");
        $stmt->bindParam("name", $name);
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
		}
		if($count < 1){
            $id = 0;
			$stmt = $conn -> prepare("INSERT INTO users (id, name, password) values(:id, :name, :password)");
            $stmt->bindParam("id", $id);
            $stmt->bindParam("name", $name);
            $stmt->bindParam("password", $hash);
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
		$stmt = $conn -> prepare("SELECT password FROM users WHERE name='".$name."';");
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

	function getEventAmount($creator, $year, $month, $day){
		global $conn;
		$com = "SELECT * FROM events WHERE creator='".$creator."' AND year='".$year>"' AND month='".$month."' AND day='".$day."';";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
		}
		return $count;
	}

	function setEvent($creator, $year, $month, $day, $num){
		session_start();
		global $conn;
		$com = "SELECT * FROM events WHERE creator='".$creator."' AND year='".$year>"' AND month='".$month."' AND day='".$day."';";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
			if($count == $num){
				$_SESSION['event'] = $row['event'];
				$_SESSION['time'] = $row['time'];
				$_SESSION['lasts'] = $row['lasts'];
			}
		}
	}

	function removeEvent($id){
		global $conn;
		$com = "DELETE FROM new_events WHERE id='".$id."';";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		echo 'good';
	}
	
    function fetchCurrentEvents(){
        global $conn;
        $time = new Date();
		$com = "SELECT FROM new_events where start > '".$time."';";
        $stmt = $conn->prepare($com);
        $results = $stmt->execute();
        echo json_encode($results);
    }
    
?>