<?php
require "../config/db.php";

$users=[
'admin'=>'admin123',
'user1'=>'user123',
'user2'=>'user234',
'ivan'=>'trainer123',
'maria'=>'trainer234'
];

foreach($users as $u=>$p){
    $h=password_hash($p,PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$h' WHERE username='$u'");
    echo "$u готов<br>";
}