<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda_urbana";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>