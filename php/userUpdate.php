<?php

require("config.php");
try {
    $conx = new PDO("mysql:host=$host;dbname=$dbname", $Login, $PW);
} catch (PDOException $e) {
    echo $e->getMessage();
}
session_start();
$name = $_SESSION['name'];

$FirstNa = $_POST["FirstNa"];
$LastNa = $_POST["LastNa"];
$Phone = $_POST["Phone"];
$Adress = $_POST["Adress"];
$photo =  file_get_contents($_FILES['photo']['tmp_name']);


$test1 = "SELECT * FROM userinfo WHERE Name = '" . $name . "';";
$table1 = $conx->query($test1);



//add user to the database
$sql = "UPDATE `userinfo` SET
`FirstNa`='". $FirstNa."',
`LastNa`='". $LastNa ."',
`Phone`='". $Phone ."',
`Adress`='".$Adress ."',
WHERE `Name`='". $name ."';";

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
