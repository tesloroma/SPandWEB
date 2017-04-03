<?php 
if($module =='register' and empty($_POST['enter'])==true){
		echo "<div class='error-code'><p>Необходимо заполнить данные!</p></div>";
}
if ($module == 'register' and empty($_POST['enter'])==false )
{
	$login = FormChars($_POST['login']);
	$password = GenPass(FormChars($_POST['password']), $login);
	$password2 = GenPass(FormChars($_POST['password2']), $login);
	$email = FormChars($_POST['email']);
	if(!$login or !$password and $password1!=$password2 or !$email){
		echo "<div class='error-code'><p>Ошибка, заполните поля правильно!</p></div>";
	}
	else{
		$err = 0;
		$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$login'"));
		if ($row['login']) {
			echo "<div class='error-code'><p>Ошибка, такой пользователь уже существует!</p></div>";
			$err=1;
		}
		
		$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$email'"));
		if ($row['email']) {
			echo "<div class='error-code'><p>Ошибка, пользователь с таким e-mail существует!</p></div>";
			$err=1;
		}
		if($err<1){
			echo "<div class='error-code'><p>Уважаемый, ". $login . ", спасибо за регистрацию!</p></div>";
			$date = date("Y-m-d H:i");
			mysqli_query($CONNECT, "INSERT INTO `users` VALUES('','$login','$password','$email','$date','1')");
		}
	}
}

if($module == 'login' and $_POST['start_login']){
	$login = FormChars($_POST['login']);
	$password = GenPass(FormChars($_POST['password']),$login);

	if(!$login or !$password){
		echo "<div class='error-code'><p>Необходимо ввести данные!</p></div>";
	}
		$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password` FROM `users` WHERE `login` = '$login'"));
	if($row['password'] != $password){
		echo "<div class='error-code'><p>Не верный логин или пароль!</p></div>";
		exit();
	}
	else{
		$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `login`, `email`, `date_registr`, `acces` FROM `users` WHERE `login` = '$login'"));
		$_SESSION['USER_ID'] = $row['id'];
		$_SESSION['USER_LOGIN'] = $row['login'];
		$_SESSION['USER_DATE_REGISTR'] = $row['date_registr'];
		$_SESSION['USER_EMAIL'] = $row['email'];
		$_SESSION['USER_ID'] = $row['id'];
		$_SESSION['USER_LOGIN_IN'] = $row['acces'];
		echo "<div class='error-code'><p>Вы успешно авторизовались</p></div>";
	}
}

if($module == 'changeprofile' and empty($_POST['update_start']) == false)
{
	$login = FormChars($_POST['login']);
	$email = FormChars($_POST['email']);
	$id = FormChars($_POST['id']);
	$acces = FormChars($_POST['acces']);
	$err2=0;
	if(!$login or !$email or !$acces){
		echo "<div class='error-code'><p>Необходимо ввести данные!</p></div>";
		$err2=1;
	}
	if($acces != 1 and $acces !=2){
		echo "<div class='error-code'><p>Такие права не существует! Выберите 1 или 2 ( пользователь, администратор )!</p></div>";
		$err2=1;
	}
	$res = $CONNECT->query("SELECT `id`, `login`, `email` FROM `users` WHERE `id` != '$id'");
	while ($row1 = $res->fetch_assoc()){
		if($row1['login'] == $login){
			echo "<div class='error-code'><p>Логин ".$login." уже занят! Выберите другой логин.!</p></div>";
			$err2=1;
		}
		if($row1['email'] == $email){
			echo "<div class='error-code'><p> Почта ".$email." уже занята! Выберите другую почту.!</p></div>";
			$err2=1;
		}
	}
	$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `id` = '$id'"));
	if($row['id'] != $id){
		echo "<div class='error-code'><p> Номер ".$id." не существует в базе данных, выберите другого пользователя для изменения!</p></div>";
		$err2=1;
	}
	if($err2==0){
		$row = mysqli_query($CONNECT, "UPDATE `users` SET `login` = '$login' , `email` = '$email' , `acces` = '$acces' WHERE `id` = '$id'");
		echo "<div class='error-code'><p> Данные успешно изменены!</p></div>";
	}
}

if($module == 'addprofile' and empty($_POST['add_start']) == false)
{
	$login = FormChars($_POST['login']);
	$email  = FormChars($_POST['email']);
	$acces = FormChars($_POST['acces']);
	$password = GenPass(FormChars($_POST['password']), $login);
	$err3=0;
		if(!$login or !$email or !$acces or !$password){
		echo "<div class='error-code'><p>Необходимо ввести данные!</p></div>";
		$err3=1;
	}
	if($acces != 1 and $acces !=2){
		echo "<div class='error-code'><p>Такие права не существует! Выберите 1 или 2 ( пользователь, администратор )!</p></div>";
		$err3=1;
	}
	$res = $CONNECT->query("SELECT `id`, `login`, `email` FROM `users`");
	while ($row1 = $res->fetch_assoc()){
		if($row1['login'] == $login){
			echo "<div class='error-code'><p>Логин ".$login." уже занят! Выберите другой логин.!</p></div>";
			$err2=1;
		}
		if($row1['email'] == $email){
			echo "<div class='error-code'><p> Почта ".$email." уже занята! Выберите другую почту.!</p></div>";
			$err2=1;
		}
	}
	if($err3==0){
		$date = date("Y-m-d H:i");
		$row = mysqli_query($CONNECT, "INSERT INTO `users`(`id`,`login`,`password`,`email`,`date_registr`,`acces`) VALUES ('','$login','$password','$email','$date','$acces')");
		echo "<div class='error-code'><p> Пользователь успешно добавлен!</p></div>";
			

	}

}
if($module == 'deleteprofile' and empty($_POST['delete_start']) == false)
{
	$id = FormChars($_POST['id']);
	$err3=0;
	if(!$id){
		echo "<div class='error-code'><p>Необходимо ввести данные!</p></div>";
		$err3=1;
	}
	$row1 = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id` FROM `users` WHERE `id`='$id' "));
		if($row1['id'] == $id){
			echo "<div class='error-code'><p> Пользователь успешно удален!</p></div>";
				$row = mysqli_query($CONNECT, "DELETE FROM `users` WHERE `id`='$id' ");
		}
		else if ($row1['id'] != $id){
			echo "<div class='error-code'><p> Пользователь с данным id не найден!</p></div>";
		}
}


 ?>