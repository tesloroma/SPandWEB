<?php 
Ulogin(1);
if($module == 'mymessage' and empty($_POST['id_message'])==false)
{
	$id_message = $_POST['id_message'];
	$login_send = $_POST['login_send'];
	$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `private_message` WHERE `id_message`='$id_message' "));
	$row1 = mysqli_query($CONNECT, "UPDATE `private_message` SET `status`= '0' WHERE `id_message` = '$id_message'");
	$subject = $row['subject'];
	echo "Отправитель: ".$login_send;
	echo "<br>Заголовок:".$row['subject'];
	echo "<br>Сообщение: ".$row['text'];
	echo "<br>Время: ".$row['time'];
	echo "<br><br><form action='/sendmessage' method='post'>
	<input type='hidden' value='".$login_send."' name='login_send'>
	<input type='hidden' value='".$subject."' name='subject'>
	<input type='submit' value='Ответить на сообщение' name='replace'>
	</form>";
}
if($module == 'sendmessage' and empty($_POST['send_start'])==false){
	
}
if($module == 'sendmessage' and empty($_POST['send_start'])==false)
{
	$login_send = $_SESSION['USER_ID'];

	$login = FormChars($_POST['login_send']);
	$subject_send = FormChars($_POST['subject_send']);
	$text_send = FormChars($_POST['text_send']);

	$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `login`='$login' "));
	if($row['id']){
		$user_id = $row['id'];
	}
	else{
		echo "Пользователь не найден!";
		exit();
	}
	if($user_id==$login_send){
		echo "Вы не можете отправить самому себе сообщение!";
		exit();
	}
	$date = date("Y-m-d H:i:s");


	$row1 = mysqli_query($CONNECT, "INSERT INTO `private_message` VALUES ('','$login_send','$user_id','$text_send','$subject_send','$date','1')");
	if($row1){
		echo "Отправлено!";
	}

}
?>