<?php
$server = "sql12.freesqldatabase.com";
$username = "sql12615907";
$password = "TUyAGLn1vc";
$database = "sql12615907";

$conn = mysqli_connect($server, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection Failed: " . $conn->connect_error);
}

?>