<?php
$conn=new mysqli("localhost","root","");

$conn->query("CREATE DATABASE IF NOT EXISTS fitness");
$conn->select_db("fitness");

$conn->query("CREATE TABLE users(
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(50),
password VARCHAR(255),
role VARCHAR(20)
)");

$conn->query("CREATE TABLE trainers(
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100),
specialization VARCHAR(100)
)");

$conn->query("CREATE TABLE workouts(
id INT AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(100),
trainer_id INT
)");

$conn->query("CREATE TABLE registrations(
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
workout_id INT
)");

$conn->query("INSERT IGNORE INTO users(username,password,role) VALUES
('admin','temp','admin'),
('user1','temp','user'),
('user2','temp','user'),
('ivan','temp','trainer'),
('maria','temp','trainer')
");

$conn->query("INSERT IGNORE INTO trainers(name,specialization) VALUES
('Иван','Фитнес'),('Мария','Йога')
");

$conn->query("INSERT IGNORE INTO workouts(title,trainer_id) VALUES
('Тренировка 1',1),('Йога',2)
");

echo "OK → теперь fix_passwords.php";
?>
