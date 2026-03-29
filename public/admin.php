<?php
session_start();
require "../config/db.php";

if(!isset($_SESSION['user']) || $_SESSION['role'] != 'admin'){
    die("Нет доступа");
}


if(isset($_POST['add'])){
    $u = trim($_POST['new_user']);
    $p = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
    $r = $_POST['role'];

    if($u != "" && $_POST['new_pass'] != ""){
        $conn->query("INSERT INTO users(username,password,role) VALUES('$u','$p','$r')");
    }
}


if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    if($id != $_SESSION['id']){
        $conn->query("DELETE FROM users WHERE id=$id");
    }
    header("Location: admin.php");
    exit;
}


if(isset($_POST['register'])){
    $user_id = (int)$_POST['user_id'];
    $workout_id = (int)$_POST['workout_id'];


    $check = $conn->query("SELECT * FROM registrations WHERE user_id=$user_id AND workout_id=$workout_id");
    if($check->num_rows == 0){
        $conn->query("INSERT INTO registrations(user_id,workout_id) VALUES($user_id,$workout_id)");
    }
}


$users = $conn->query("SELECT * FROM users");
$workouts = $conn->query("SELECT workouts.id, workouts.title, trainers.name 
                          FROM workouts 
                          LEFT JOIN trainers ON workouts.trainer_id = trainers.id");
?>

<link rel="stylesheet" href="css/style.css">

<div class="container">
    <h2>Админ панель</h2>
    <p>Привет, <?=$_SESSION['user']?>!</p>


    <h3>Добавить пользователя</h3>
    <form method="POST">
        <input name="new_user" placeholder="Логин"><br>
        <input name="new_pass" placeholder="Пароль"><br>
        <select name="role">
            <option value="user">user</option>
            <option value="trainer">trainer</option>
            <option value="admin">admin</option>
        </select><br>
        <button name="add">Добавить</button>
    </form>


    <h3>Записать пользователя на тренировку</h3>
    <form method="POST">
        <select name="user_id">
            <?php while($u=$users->fetch_assoc()): ?>
                <option value="<?=$u['id']?>"><?=$u['username']?> (<?=$u['role']?>)</option>
            <?php endwhile; ?>
        </select><br>

        <select name="workout_id">
            <?php while($w=$workouts->fetch_assoc()): ?>
                <option value="<?=$w['id']?>"><?=$w['title']?> (<?=$w['name']?>)</option>
            <?php endwhile; ?>
        </select><br>

        <button name="register">Записать</button>
    </form>


    <h3>Список пользователей</h3>
    <?php
    $users = $conn->query("SELECT * FROM users");
    while($u = $users->fetch_assoc()):
    ?>
        <p>
            <?=$u['username']?> (<?=$u['role']?>)
            <?php if($u['id'] != $_SESSION['id']): ?>
                <a href="?delete=<?=$u['id']?>" style="color:red;">[Удалить]</a>
            <?php endif; ?>
        </p>
    <?php endwhile; ?>

    <br>
    <a href="logout.php">Выйти</a>
</div>
