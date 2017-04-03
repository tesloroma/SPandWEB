<?php 
Ulogin(1);
if($module == 'changeproduct' and empty($_POST['change_start'])==false)
{
	$id = $_POST['changeproduct'];
	$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `shop` WHERE `id`='$id' "));
	echo "<div class='change-product'>";
	echo "<center><table border='1'>
			<tr>
			<th>Картинка</th>
			<th>Имя</th>
			<th>Диагональ</th>
			<th>Цена</th>
			<th>Страна</th>
			</tr>
			<tr>
			<td>". $row['img'] ."</td>
			<td>". $row['name'] ."</td>
			<td>". $row['diagonal'] ."</td>
			<td>". $row['price'] ."</td>
			<td>". $row['cuntry'] ."</td>
			</tr></table><br><br>
			<form action='/edit/changeproducte' method='POST'>
			<input type='hidden' name='id' value='". $id ."'>
			<input type='text' name='img' value='". $row['img'] ."'>
			<input type='text' name='name' value='". $row['name'] ."'
>			<input type='text' name='diagonal' value='". $row['diagonal'] ."'>
			<input type='text' name='price' value='". $row['price'] ."'>
			<input type='text' name='cuntry' value='". $row['cuntry'] ."'><br><br>
			<input type='submit' name='start_change' value='Изменить'>
			</form></center><br>";
	echo "</div>";

}
if($module == 'deleteproduct' and empty($_POST['delete_phone']) == false)
{
	$id = FormChars($_POST['id']);
	if(!$id){
		echo "<div class='error-code'><p>Необходимо ввести данные!</p></div>";;
	}
	$row1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `shop` WHERE `id`='$id' "));
		if($row1['id'] == $id){
			echo "<div class='error-code'><p> Товар успешно удален!</p></div>";
			$row = mysqli_query($CONNECT, "DELETE FROM `shop` WHERE `id`='$id' ");
		}
		else if ($row1['id'] != $id){
			echo "<div class='error-code'><p> Товар с данным id не найден!</p></div>";
		}
}
if($module == 'comentsview' and empty($_POST['comments_start']) == false){
	$idc = $_POST['idc'];
	$res = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `shop` WHERE `id`='$idc' "));
	echo "<div class='my-phone'>";
	echo "<img weight='200' height='350' height='' src='". $res['img'] ."' >";
	echo "<p>Name: <b>". $res['name'] ." </b></p>";
	echo "<p>Diagonal: <b>". $res['diagonal'] ."</b> </p>";
	echo "<p>Price: <b>". $res['price'] ." $ </b></p>";
	echo "<p>Country: <b>". $res['cuntry'] ." </b></p>";
	echo "</div>";
	$res = $CONNECT->query("SELECT * FROM `comments` WHERE `id_product` = '$idc' ");
	echo "<div class='comments' style='display:inline-block;vertical-align:top;margin-left:250px;margin-top:70px;width:400px;'>";
		while ($row = $res->fetch_assoc()) {
			echo $row['Name'].": ";
			echo $row['Text']."<br><hr>";
			if($_SESSION['USER_LOGIN_IN'] == 2){
			
			 echo "<form action='' method='POST'>
			<input type='hidden' name='id_comments' value='". $row['id_comments'] ."'>
			<input style='text-align:right;padding:3px;' type='submit' name='delete_comments' value='Удалить комментарий'>
			</form>
			<hr>";
		}
		}
		echo "<form action='' method='POST'>
		<input type='text' placeholder='Введите свое имя' name='name'>
		<textarea cols='40' rows='4' placeholder='Введите комментарий' name='textarea'></textarea>
		<input type='hidden' name='id' value='". $idc ."'>
		<input type='submit' value='Отправить' name='start_comments'>
		</form>";
		echo "</div>";
}

if(empty($_POST['delete_comments']) == false){
	$id_comments = $_POST['id_comments'];
	if($row = mysqli_query($CONNECT, "DELETE FROM `comments` WHERE `id_comments` = '$id_comments'  "))
	{
			echo "<div class='error-code'><p>Комментарий удален!</p>
		<script type='text/jscript'>
			window.location.href='http://test1.ru/viewproduct';
			</script></div>";
	}
	else {
			echo "<div class='error-code'><p>Не удалось удалить комментарий!!</p></div>";
	}

}

if(empty($_POST['start_comments']) == false){
	$idc = $_POST['id'];
	$name = FormChars($_POST['name']);
	$textarea = FormChars($_POST['textarea']);
	$row = mysqli_query($CONNECT, "INSERT INTO `comments`(`id_comments`,`name`,`text`,`id_product`) VALUES ('','$name','$textarea','$idc')");
	echo "<div class='error-code'><p> Спасибо за коментарий!!</p>
		<script type='text/jscript'>
			window.location.href='http://test1.ru/viewproduct';
			</script></div>";
}
if( $module == 'addproduct' and empty($_POST['add_prouct']) == false){

	$name  = FormChars($_POST['name']);
	$img = FormChars($_POST['img']);
	$diagonal = FormChars($_POST['diagonal']);
	$price = FormChars($_POST['price']);
	$cuntry = FormChars($_POST['cuntry']);

	if(!$name or !$img or !$diagonal or !$price or !$cuntry){
		echo "<div class='error-code'><p>Ошибка при заполнении!</p></div>";
	}
	else{
		$row = mysqli_query($CONNECT, "INSERT INTO `shop`(`id`,`img`,`name`,`diagonal`,`price`,`cuntry`) VALUES ('','$img','$name','$diagonal','$price','$cuntry')");

		echo "<div class='error-code'><p>Телефон успешно добавлен!!!</p>
		<script type='text/jscript'>
			window.location.href='http://test1.ru/changeproduct';
			</script></div>";
	}
}

 ?>
