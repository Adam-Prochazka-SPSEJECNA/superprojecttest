<?php
$username = "lm";
$passwd = "lm";


$servername = "localhost";
				$username = "admin";
				$password = "admin12345678";
				$db = "vanoce_projekt_cmr";
$conn = new mysqli($servername, $usernameDb, $password, $db);
 $conn->query("set names utf8");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  exit();
}
?>
