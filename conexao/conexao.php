<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "tmtab";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>