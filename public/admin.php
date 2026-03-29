<?php
session_start();
require "../config/db.php";

if($_SESSION['role']!='admin') die("Нет доступа");

$users=$conn->query("SELECT * FROM users");
?>
<link rel="stylesheet" href="css/style.css">
<div class="container">
<h2>Админ</h2>

<?php while($u=$users->fetch_assoc()): ?>
<p><?=$u['username']?> (<?=$u['role']?>)</p>
<?php endwhile; ?>

</div>
