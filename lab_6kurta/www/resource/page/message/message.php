<?php 
Ulogin(1);
$user_id = $_SESSION['USER_ID'];
$res = $CONNECT->query("SELECT * FROM `private_message` WHERE `id_inbox`= '$user_id' ORDER BY time DESC ");

echo " <a href='/sendmessage' > <button>Отправить письмо</button><br><br></a>
<div class='list-message'>";
while ($row = $res->fetch_assoc()) {
	$status = $row['status'];
	if ($status == 1){
		$id = $row['id_send'];
		echo "<b><div class='my-message'><form action='mymessage/mymessage' method='post'>";
		$row1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = '$id'"));
		if($row1['login']){
			$id_send = $row1['login'];
		}
		$subject = $row['subject'];
		echo "<p>Тема: <input id='status1' type='submit'  value='". $subject ."' ></p><br>";
		echo "<p>От кого: ". $id_send ."</p>";
		echo "<p class='time'>Время: ". $row['time'] ."</p>
		<input type='hidden' name='id_message' value='". $row['id_message'] ."'>
		<input type='hidden' name='login_send' value='". $id_send."'>
		</form></div></b><br>";
	}
	else if($status == 0){
		$id = $row['id_send'];
		echo "<div class='my-message'><form action='mymessage/mymessage' method='post'>";
		$row1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `id` = '$id'"));
		if($row1['login']){
			$id_send = $row1['login'];
		}
		$subject = $row['subject'];
		echo "<p>Тема: <input type='submit'  value='". $subject ."' ></p><br>";
		echo "<p>От кого: ". $id_send ."</p>";
		echo "<p class='time'>Время: ". $row['time'] ."</p>
		<input type='hidden' name='id_message' value='". $row['id_message'] ."'>
		<input type='hidden' name='login_send' value='". $id_send."'>
		</form></div><br>";
	}
}
echo "</div><br>";
?>