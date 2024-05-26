<?php
$server = 'localhost';
$db_user = "root";
$db_pass = "";
$db_name = "rideconnect";
$conn = mysqli_connect($server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("<script>alert('Connection Failed')</script>");
}
