<?php

require("config.php");
try {
	$conx = new PDO("mysql:host=$host;dbname=$dbname", $Login, $PW);
} catch (PDOException $e) {
	echo $e->getMessage();
}


$name = $_POST["name"];
$email = $_POST["email"];
$pass = $_POST["pass"];


$test1 = "SELECT * FROM userinfo WHERE Name = '" . $name . "';";
$table1 = $conx->query($test1);

$test2 = "SELECT * FROM userinfo WHERE email = '" . $email . "';";
$table2 = $conx->query($test2);



if ($table1->rowCount() != 0) { // test the user name

	echo '<script type="text/javascript">';
	echo 'alert("The name : { ' . $name . ' } already taken");';
	echo 'alert("Can you please change your Username");';
	echo 'window.location.href = "FormSignUp.php";';
	echo '</script>';
} elseif ($table2->rowCount() != 0) { // test the email

	echo '<script type="text/javascript">';
	echo 'alert("The Email : { ' . $email . ' } already exist");';
	echo 'alert("Can you please change the email");';
	echo 'window.location.href = "FormSignUp.php";';
	echo '</script>';
} else {

	//add user to the database
	$sql = "INSERT INTO `userinfo` (`Name`, `Email`, `Pass`) VALUES('" . $name . "','" . $email . "','" . $pass . "')";
	$resultat = $conx->query($sql);

	if ($resultat == FALSE) {

		echo '<script type="text/javascript">';
		echo 'alert("There is error please resign again");';
		echo 'window.location.href = "FormSignUp.php";';
		echo '</script>';
	} else {

		echo '<script type="text/javascript">';
		echo 'alert("Thank you for your sign up ");';
		echo 'alert("You can go login now");';
		echo 'window.location.href = "../index.php";';
		echo '</script>';
	}
}
