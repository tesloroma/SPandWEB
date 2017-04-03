<?php 
$res = $CONNECT->query("SELECT * FROM `shop`");
echo "<div class='list-phone'>";
while ($row = $res->fetch_assoc()) {
	echo "<div class='my-phone'>";
	echo "<img weight='200' height='350' src='". $row['img'] ."' >";
	echo "<p>Name: <b>". $row['name'] ." </b></p>";
	echo "<p>Diagonal: <b>". $row['diagonal'] ."</b> </p>";
	echo "<p>Price: <b>". $row['price'] ." $ </b></p>";
	echo "<p>Country: <b>". $row['cuntry'] ." </b></p>";
	echo "<form action='/product/comentsview' method='POST'>
		<input type='hidden' name='idc' value='". $row['id'] ."'>
		<input type='submit' value='Добавить отзыв' name='comments_start'>";
	echo "</form></div>";
}
echo "</div><br>";
?>