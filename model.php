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
		$stmt = $conn -> prepare("SELECT * FROM users WHERE name='".$name."';");
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

	function addEvent($creator, $event){
		global $conn;
		$creator = htmlspecialchars($creator);
		$event = htmlspecialchars($event);
		$com = "INSERT INTO events VALUES ('".$creator."', '".$event."');";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		echo 'good';
	}

	function getEventAmount($creator){
		global $conn;
		$com = "SELECT * FROM events WHERE creator='".$creator."';";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
		}
		return $count;
	}

	function setEvent($creator, $num){
		session_start();
		global $conn;
		$com = "SELECT * FROM events WHERE creator='".$creator."';";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
			if($count == $num){
				$_SESSION['event'] = $row['event'];
			}
		}
	}

	function removeEvent($creator, $event){
		global $conn;
		$creator = htmlspecialchars($creator);
		$event = htmlspecialchars($event);
		$com = "DELETE FROM events WHERE creator='".$creator."' AND event='".$event."';";
		$stmt = $conn -> prepare($com);
		$stmt ->execute();
		echo 'good';
	}

	function createGroup($groupname, $username){
		global $conn;
		$username = htmlspecialchars($username);
		$groupname = htmlspecialchars($groupname);
		$stmt = $conn -> prepare("SELECT * FROM users WHERE name='".$groupname."';");
		$stmt ->execute();
		$result = $stmt->fetchAll();
		$count = 0;
		foreach($result as $row){
			$count++;
		}
		if($count < 1){
			$com = "INSERT INTO users VALUES ('".$groupname."');";
			$stmt = $conn -> prepare($com);
			$stmt ->execute();
			$com = "INSERT INTO groups VALUES ('".$username."', '".$groupname."');";
			$stmt = $conn -> prepare($com);
			$stmt ->execute();
			echo 'Created';
		}
		else{
			echo 'Name is taken';
		}
	}

	function addToGroup($username, $groupname){
		global $conn;
		$username = htmlspecialchars($username);
		$groupname = htmlspecialchars($groupname);
		$com = "INSERT INTO groups VALUES ('".$username."', '".$groupname."');";
		$stmt ->execute();
	}

	function removeFromGroup($username, $groupname){
		global $conn;
		$username = htmlspecialchars($username);
		$groupname = htmlspecialchars($groupname);
		$com = "DELETE FROM groups WHERE user='".$username."' AND groupname='".$groupname."';";
		$stmt ->execute();
	}

	function removeGroup($groupname){
		global $conn;
		$username = htmlspecialchars($username);
		$groupname = htmlspecialchars($groupname);
		$com = "DELETE FROM groups WHERE groupname='".$groupname."';";
		$stmt ->execute();
		$com = "DELETE FROM users WHERE name='".$groupname."';";
		$stmt ->execute();
	}

?>

