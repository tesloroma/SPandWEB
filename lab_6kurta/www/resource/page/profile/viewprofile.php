<?php 
Ulogin(1);
$res = $CONNECT->query("SELECT `id`, `login`, `email`, `date_registr`, `acces` FROM `users`");
echo "<div class='list-user'>
<table border='1' caption='Список пользователей'>
<caption>Просмотр пользователей</caption>
<tr>
<th>Id</th>
<th>Login</th>
<th>Email</th>
<th>Date Registr</th>
<th>Права</th>
</tr>";
while ($row = $res->fetch_assoc()) {
	if ($row['acces'] == 1){
		$row['acces'] = "Пользователи";
	}
	else if ($row['acces'] == 2){
		$row['acces'] = "Администраторы";
	}
	echo "<tr>
	<td>".$row['id']."</td>
	<td>".$row['login']."</td>
	<td>".$row['email']."</td>
	<td>".$row['date_registr']."</td>
	<td>".$row['acces']."</td>
	</tr>";
}
	echo "</table></div>";
 ?>