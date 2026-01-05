<?php
define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "root");
define("DB", "customers_db");
$conn = new mysqli(SERVER, USER, PASSWORD, DB);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>