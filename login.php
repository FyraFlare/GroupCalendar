<?php
	//Name: Carly Cappagli
	//Discription: 
	require_once('model.php');# Now can call functions inside model.php
	$lorr = $_POST["submit"];
	if(empty($_POST['username'])){
		echo 'Please enter a username';
	}
	elseif(empty($_POST['pass'])){
		echo 'Please enter a password';
	}
	elseif($lorr == "Login"){
		login($_POST["username"], $_POST["pass"]);
	}
	elseif($lorr == "Register"){
		register($_POST["username"], $_POST["pass"]);
	}
	else{
		echo "not working";
	}
?>