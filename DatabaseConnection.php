<?php
$host = "localhost:3306";
$serverusername = "root";
$password = "LUis21tecmont$%";
$database = "firstdatabase";

$connection = new mysqli($host, $serverusername, $password, $database);

if(!$connection){
    die("Connection failed: " . mysqli_connect_error());
}

echo "COnnected succesfully!";
?>