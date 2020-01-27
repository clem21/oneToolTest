<?php
$host="127.0.0.1";
$user="root";
$password="clemence";
$db="azerty";

$conn = mysqli_connect($host,$user,$password, $db);

if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
