<?php
require "../config/db.php";
$msg="";

if($_POST){
    $u=trim($_POST['username']);
    $p=trim($_POST['password']);

    $stmt=$conn->prepare("SELECT id FROM users WHERE username=?");
    $stmt->bind_param("s",$u);
    $stmt->execute();

    if($stmt->get_result()->num_rows>0){
        $msg="Пользователь существует";
    }else{
        $hash=password_hash($p,PASSWORD_DEFAULT);
        $role="user";

        $stmt=$conn->prepare("INSERT INTO users(username,password,role) VALUES(?,?,?)");
        $stmt->bind_param("sss",$u,$hash,$role);
        $stmt->execute();

        $msg="Готово!";
    }
}
?>
<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Регистрация</h2>
<p><?=$msg?></p>
<form method="POST">
<input name="username"><br>
<input type="password" name="password"><br>
<button>Регистрация</button>
</form>
</div>