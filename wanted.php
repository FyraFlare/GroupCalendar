<?php
	//Name: Carly Cappagli
	//Discription: 
	require_once('model.php');# Now can call functions inside model.php
	$want = $_POST["want"];
	if($want == "session"){
		session_start();
		if($_SESSION['user'] != null){
			echo 'good';
		}
		else{
			echo 'bad';
		}
	}
	elseif($want == "eventAmount"){
		$num = getEventAmount($_POST["creator"], $_POST["year"], $_POST["month"], $_POST["day"]);
		echo $num;
	}
	elseif($want == "event"){
		session_start();
		$_SESSION['creator'] = $_POST["creator"];
		$_SESSION['year'] = $_POST["year"];
		$_SESSION['month'] = $_POST["month"];
		$_SESSION['day'] = $_POST["day"];
		setEvent($_POST["creator"], $_POST["year"], $_POST["month"], $_POST["day"], $_POST["num"]);
		echo 'event selected';
	}
	elseif($want == "eventInfo"){
		session_start();
		echo $_SESSION[$_POST['info']];
	}
	elseif($want == "addEvent"){
		addEvent($_POST["creator"], $_POST["event"], $_POST["year"], $_POST["month"], $_POST["day"], $_POST["time"], $_POST["lasts"]);
		echo 'added';
	}
	elseif($want == "removeEvent"){
		removeEvent($_POST["creator"], $_POST["event"], $_POST["year"], $_POST["month"], $_POST["day"], $_POST["time"], $_POST["lasts"]);
		echo 'removed';
	}
	elseif($want == "createGroup"){
		$result = createGroup($_POST["group"], $_POST["user"]);
		echo $result;
	}
	elseif($want == "addToGroup"){
		$result = addToGroup($_POST["user"], $_POST["group"]);
	}
	elseif($want == "removeFromGroup"){
		$result = addEvent($_POST["user"], $_POST["group"]);
	}elseif($want == "removeGroup"){
		$result = addEvent($_POST["group"]);
	}
	elseif($want == "logout"){
		logout();
		echo 'loged out';
	}
	else{
		echo "not working";
	}
?>