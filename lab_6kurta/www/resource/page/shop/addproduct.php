<?php 
Ulogin(1);
echo "<center><div class='phone-add'>
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
echo "<form action='/product/addproduct' method='POST'>
	<input type='text' placeholder='name' name='name'>
	<input style='padding: 1px 5px;width:250px;' type='text' placeholder='img' name='img'>
	<input type='text' placeholder='diagonal' name='diagonal'>
	<input type='text' placeholder='price' maxlength='5' name='price'>
	<input type='text' placeholder='cuntry' name='cuntry'>
	<input type='text' placeholder='section' name='section'><br><br>
	<input type='submit' value='Добавить' name='add_prouct' >
	<input type='reset' value='Сбросить' >
	</form><br>
	</div></center>
	";
?>