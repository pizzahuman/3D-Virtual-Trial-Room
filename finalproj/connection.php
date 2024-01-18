<?php


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "trial_room";
$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$conn)
{
die("failed to connect!");
}
?>