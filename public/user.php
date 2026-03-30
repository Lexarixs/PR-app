<?php
session_start();
require "../config/db.php";

if(!isset($_SESSION['user'])) die("Вход нужен");

$user_id=$_SESSION['id'];

if(isset($_GET['join'])){
    $wid=$_GET['join'];
    $conn->query("INSERT INTO registrations(user_id,workout_id) VALUES($user_id,$wid)");
}

$res=$conn->query("
SELECT workouts.*, trainers.name 
FROM workouts 
LEFT JOIN trainers ON workouts.trainer_id=trainers.id
");
?>
<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Тренировки</h2>

<?php while($row=$res->fetch_assoc()): ?>
<p>
<?=$row['title']?> (<?=$row['name']?>)
<a href="?join=<?=$row['id']?>">Записаться</a>
</p>
<?php endwhile; ?>

<a href="logout.php">Выход</a>
</div>
