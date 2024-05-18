<?php

session_start();

$conn = mysqli_connect("localhost","root","","cargo");

if(!isset($_SESSION['uid'])){
    header("Location: ./Auth/login.php");
}

?>