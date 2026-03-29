<?php
session_start();
require "../config/db.php";

if(!isset($_SESSION['user']) || $_SESSION['role'] != 'trainer'){
    die("Нет доступа");
}

// Получаем список тренировок тренера
$trainer_id = $_SESSION['id'];
$res = $conn->query("
    SELECT workouts.id, workouts.title 
    FROM workouts 
    WHERE trainer_id = $trainer_id
");
?>

<link rel="stylesheet" href="css/style.css">

<div class="container">
<h2>Привет, тренер <?=$_SESSION['user']?>!</h2>

<h3>Ваши тренировки:</h3>
<?php while($row = $res->fetch_assoc()): ?>
    <p><?=$row['title']?></p>
<?php endwhile; ?>

<a href="logout.php">Выйти</a>
</div>
