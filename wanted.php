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
	elseif($want == "addEvent"){
		addEvent($_POST["creator"], $_POST["event"], $_POST["year"],$_POST["month"],$_POST["day"],$_POST["time"],$_POST["lasts"]);
		echo 'added';
	}
	elseif($want == "logout"){
		logout();
		echo 'loged out';
	}
	else{
		echo "not working";
	}
?>