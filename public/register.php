<?php
require "../config/db.php";
require "../includes/auth.php";

$msg = "";

if ($_POST) {
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    if ($u == "" || $p == "") {
        $msg = "Заполните все поля";
    } else {
        $res = $conn->query("SELECT * FROM users WHERE username='$u'");
        if ($res->num_rows > 0) {
            $msg = "Пользователь уже существует";
        } else {
            $hash = password_hash($p, PASSWORD_DEFAULT);
            $conn->query("INSERT INTO users(username,password,role) VALUES('$u','$hash','user')");
            $msg = "Регистрация успешна";
        }
    }
}
?>

<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Регистрация</h2>
<p><?=$msg?></p>
<form method="POST">
    <input name="username" placeholder="Логин"><br>
    <input type="password" name="password" placeholder="Пароль"><br>
    <button>Зарегистрироваться</button>
</form>
<a href="login.php">Вход</a>
</div>