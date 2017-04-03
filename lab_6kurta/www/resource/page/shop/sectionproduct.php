<?php 
echo "<center><form class='section' action='' method='post'>
<input type='submit' value='Lenovo' value='Lenovo' name='section'>
<input type='submit' value='Iphone' value='Iphone' name='section'>
<input type='submit' value='Samsung' value='Samsung' name='section'>
<input type='submit' value='Lenovo' value='Lenovo' name='section'>
<input type='submit' value='Xiomi' value='Xiomi' name='section'>
<input type='submit' value='Meizu' value='Meizu' name='section'>
</form></center>";

if(isset($_POST['section'])){			        	
	$section =$_POST['section'];
}
else{
   	$section = "Meizu";
}
$res = $CONNECT->query("SELECT * FROM `shop` WHERE `section` = '$section'");
echo "<div class='list-phone'>";
while ($row = $res->fetch_assoc()) {
	echo "<div class='my-phone'><center>";
	echo "<img weight='200' height='350' height='' src='". $row['img'] ."' >";
	echo "<p>Name: <b>". $row['name'] ." </b></p>";
	echo "<p>Diagonal: <b>". $row['diagonal'] ."</b> </p>";
	echo "<p>Price: <b>". $row['price'] ." $ </b></p>";
	echo "<p>Country: <b>". $row['cuntry'] ." </b></p>";
	echo "</center></div>";
}
echo "</div><br>";
?>