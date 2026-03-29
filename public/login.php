<?php
require "../config/db.php";
require "../includes/auth.php";

$msg = "";

if ($_POST) {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE username='$u'");

    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($p, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == "admin") header("Location: admin.php");
            elseif ($user['role'] == "trainer") header("Location: trainer.php");
            else header("Location: user.php");
            exit;
        }
    }
    $msg = "Неверный логин или пароль";
}
?>

<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Вход</h2>
<p><?=$msg?></p>
<form method="POST">
    <input name="username" placeholder="Логин"><br>
    <input type="password" name="password" placeholder="Пароль"><br>
    <button>Войти</button>
</form>
<a href="register.php">Регистрация</a>
</div>