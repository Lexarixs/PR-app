<?php
// config/db.php
$conn = new mysqli("localhost", "root", "", "fitness");

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}