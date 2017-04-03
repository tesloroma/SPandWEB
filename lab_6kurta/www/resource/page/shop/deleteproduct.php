<?php 
Ulogin(2);
echo "<div class='phone-delete'>
<table border='1' caption='Список пользователей'>
<caption>Удаление товаров</caption>
<tr>
<th>Id</th>
<th>Name</th>
<th>Price</th>
</tr>";
$res = $CONNECT->query("SELECT `id`,`name`,`price` FROM `shop`");
while ($row = $res->fetch_assoc()) {
	echo "<tr>
	<td>".$row['id']."</td>
	<td>".$row['name']."</td>
	<td>".$row['price']." $</td>
	</tr>";
}
echo "</table><br><br>";
echo "<form action='/product/deleteproduct' method='POST'>
	<input type='text' placeholder='id' maxlength='3' name='id'>
	<input type='submit' value='Удалить' name='delete_phone' >
	</form><br>
	</div>
	";
?>