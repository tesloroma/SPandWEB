<?php 
Ulogin(1);
$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `login`, `email`, `date_registr`, `acces` FROM `users` WHERE `id` = '$_SESSION[USER_ID]'"));
echo "<div class='about-user'>";
echo "Id: ". $row['id']."<br>";
echo "Login: ". $row['login']."<br>";
echo "Email: ". $row['email']."<br>";
echo "Date Registr: ". $row['date_registr']."<br>";
if ($row['acces'] == 1){
	$row['acces'] = "Пользователи";
}
else if ($row['acces'] == 2){
	$row['acces'] = "Администраторы";
}
echo "Права: ". $row['acces']."<br>";
echo "</div>";
 ?>