<?php


$hostname = "localhost";
$userDatabase = "root";
$passwordUser = "";
$databaseName = "cafe_db";

$conn = mysqli_connect($hostname, $userDatabase, $passwordUser, $databaseName) or die(mysqli_error($conn));
