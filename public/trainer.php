<?php
require "../config/db.php";
require "../includes/auth.php";
requireLogin();
if (!isTrainer()) die("Нет доступа");

$username = $_SESSION['user'];

$res = $conn->query("
SELECT workouts.* 
FROM workouts
JOIN trainers ON workouts.trainer_id = trainers.id
WHERE trainers.name = '$username'
");
?>

<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Мои тренировки</h2>
<?php while($w = $res->fetch_assoc()): ?>
    <p><?=$w['name']?> (<?=$w['time']?>)</p>
<?php endwhile; ?>
<a href="logout.php">Выйти</a>
</div>