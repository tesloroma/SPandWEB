<?php 
Ulogin(1);
if(empty($_POST['replace'])==false){
	$login_send = $_POST['login_send'];
	$subject = $_POST['subject'];
	echo "<div class='send-message'><form action='mymessage/sendmessage' method='POST'>
	Получатель:<br><input type='text' name='login_send' value='".$login_send."' placeholder='Логин получателя'><br>
	Заголовок темы<br><input type='text' name='subject_send' value='Re: ".$subject."' placeholder='Заголовок'><br>
	Текст сообщения<br><textarea cols=55 rows=8 name='text_send'>   </textarea><br>
	<input type='submit' value='Отправить' name='send_start'>
";
}
else{
echo "<div class='send-message'><form action='mymessage/sendmessage' method='POST'>
Получатель:<br><input type='text' name='login_send' placeholder='Логин получателя'><br>
Заголовок темы<br><input type='text' name='subject_send' placeholder='Заголовок'><br>
Текст сообщения<br><textarea cols=55 rows=8 name='text_send'></textarea><br>
<input type='submit' value='Отправить' name='send_start'>
";
echo "</form></div>";
}


 ?>