<?php 
Ulogin(2);
$res = $CONNECT->query("SELECT `id`, `login`, `email`, `date_registr`, `acces` FROM `users`");
echo "<div class='list-user'><center>
<table border='1'>
<caption>Редактировать пользователей</caption>
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
	echo "</table><br>";
	echo "<form action='/account/changeprofile' method='POST'>
	<input type='text' placeholder='id' maxlength='3' name='id'>
	<input type='text' placeholder='login' title='Поддерживаются только латинские буквы и цифры' name='login'>
	<input type='text' placeholder='email' name='email'>
	<input type='text' placeholder='acces' maxlength='1' name='acces'><br><br>
	<input type='submit' value='Изменить' name='update_start' >
	<input type='reset' value='Сбросить' >
	</form></center><br>
	</div>
	";
 ?>