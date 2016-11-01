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
	if($want == "user"){
		session_start();
		echo $_SESSION['user'];
	}
	elseif($want == "eventAmount"){
		$num = getEventAmount($_POST["creator"]);
		echo $num;
	}
	elseif($want == "event"){
		session_start();
		$_SESSION['creator'] = $_POST["creator"];
		setEvent($_POST["creator"], $_POST["num"]);
		echo 'event selected';
	}
	elseif($want == "eventInfo"){
		session_start();
		echo $_SESSION[$_POST['info']];
	}
	elseif($want == "addEvent"){
		addEvent($_POST["creator"], $_POST["event"]);
		echo 'added';
	}
	elseif($want == "removeEvent"){
		removeEvent($_POST["creator"], $_POST["event"]);
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
	elseif($want == "memberAmount"){
		$num = getEventAmount($_POST["group"]);
		echo $num;
	}
	elseif($want == "member"){
		session_start();
		$name = getMember($_POST["creator"], $_POST["num"]);
		echo $name;
	}
	elseif($want == "logout"){
		logout();
		echo 'loged out';
	}
	else{
		echo "not working";
	}
?>