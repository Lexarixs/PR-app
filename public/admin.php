<?php
require "../config/db.php";
require "../includes/auth.php";

if (!isAdmin()) die("Нет доступа");

// Удаление пользователя
if(isset($_GET['delete'])){
    $del = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$del");
    header("Location: admin.php");
    exit;
}

// Добавление тренировки
if ($_POST) {
    $name = $_POST['name'];
    $time = $_POST['time'];
    $trainer_id = $_POST['trainer_id'];
    $conn->query("INSERT INTO workouts(name,time,trainer_id) VALUES('$name','$time',$trainer_id)");
}

$users = $conn->query("SELECT * FROM users");
$trainers = $conn->query("SELECT * FROM trainers");
?>

<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Админка</h2>

<h3>Пользователи</h3>
<?php while($u = $users->fetch_assoc()): ?>
    <p>
        <?=$u['username']?> (<?=$u['role']?>)
        <a href="?delete=<?=$u['id']?>">[Удалить]</a>
    </p>
<?php endwhile; ?>

<h3>Добавить тренировку</h3>
<form method="POST">
    <input name="name" placeholder="Название"><br>
    <input name="time" placeholder="Время"><br>
    <select name="trainer_id">
        <?php while($t = $trainers->fetch_assoc()): ?>
            <option value="<?=$t['id']?>"><?=$t['name']?></option>
        <?php endwhile; ?>
    </select>
    <button>Добавить</button>
</form>

<a href="logout.php">Выйти</a>
</div>