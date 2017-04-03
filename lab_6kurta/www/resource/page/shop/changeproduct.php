<?php 
Ulogin(2);
$res = $CONNECT->query("SELECT * FROM `shop`");
echo "<div class='list-phone'>";
while ($row = $res->fetch_assoc()) {
	echo "<div class='my-phone'>";
	echo "<img weight='200' height='350' height='' src='". $row['img'] ."' >";
	echo "<p>Name: <b>". $row['name'] ." </b></p>";
	echo "<p>Diagonal: <b>". $row['diagonal'] ."</b> </p>";
	echo "<p>Price: <b>". $row['price'] ." $ </b></p>";
	echo "<form action='/product/changeproduct' method='POST'>
		<input type='hidden' name='changeproduct' value='". $row['id'] ."'>
		<input type='submit' value='Изменить' name='change_start'>";
	echo "</form></div>";
}
echo "</div><br>";
?>