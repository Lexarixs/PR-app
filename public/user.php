<?php
require "../config/db.php";
require "../includes/auth.php";
requireLogin();
if (!isUser()) die("Нет доступа");

$user_id = $_SESSION['id'];

if (isset($_GET['book'])) {
    $wid = $_GET['book'];
    $conn->query("INSERT INTO bookings(user_id, workout_id) VALUES($user_id, $wid)");
    header("Location: user.php");
    exit;
}

$workouts = $conn->query("
SELECT workouts.*, trainers.name AS trainer 
FROM workouts 
LEFT JOIN trainers ON workouts.trainer_id = trainers.id
");
?>

<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Тренировки</h2>
<?php while($w = $workouts->fetch_assoc()): ?>
    <p>
        <?=$w['name']?> (<?=$w['time']?>) — <?=$w['trainer']?>
        <a href="?book=<?=$w['id']?>">[Записаться]</a>
    </p>
<?php endwhile; ?>
<a href="logout.php">Выйти</a>
</div>