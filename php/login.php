<?php

require("config.php");

try {
	$conx = new PDO("mysql:host=$host;dbname=$dbname", $Login, $PW);
} catch (PDOException $ex) {
	echo $ex->getMessage();
}


$name = $_POST["name"];
$pass = $_POST["pass"];

//to send these values to other page using session 
session_start();
$_SESSION['name'] = $name;


$test1 = "SELECT * FROM userinfo WHERE name = '" . $name . "';";
$table1 = $conx->query($test1);

$test2 = "SELECT * FROM userinfo WHERE name = '" . $name . "' and pass ='" . $pass . "';";
$table2 = $conx->query($test2);



if ($table1->rowCount() == 0) { // test if the user name exist

	echo '<script type="text/javascript">';
	echo 'alert("The name: [ ' . $name . ' ] is not exist");';
	echo 'window.location.href = "../index.php";';
	echo '</script>';

} elseif ($table2->rowCount() == 0) {// test the password is correct
	echo '<script type="text/javascript">';
	echo 'alert("The password is incorrect ");';
	echo 'window.location.href = "../index.php";';
	echo '</script>';
	
} else {

	if ($name == 'admin' & $pass == 'admin') {

		echo '<script type="text/javascript">';
		// echo 'alert("Welcome back to our website");';
		echo 'window.location.href = "adminHome.php";';
		echo '</script>';
	} else {

		echo '<script type="text/javascript">';
		// echo 'alert("Welcome back to our website");';
		echo 'window.location.href = "home.php";';
		echo '</script>';
	}
}
