<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "task";

$connect = mysqli_connect($servername, $username, $password, $dbname);

if (!$connect) {
    die("Ошибка подключение " . mysqli_connect_error());
}