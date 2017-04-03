<?php 
	Ulogin(0);
?>
	<div class="form-registration">
		<form action="account/register" method="POST">
			<input type="text" placeholder="Введите логин" title='Поддерживаются только латинские буквы и цифры' name="login"><br><br>
			<input type="password" placeholder="Введите пароль" title='Введенный пароль не должен содержать пробелов, и должен состоять минимум из 6 символов'  name="password"><br><br>
			<input type="password" placeholder="Повторите пароль" title='Введенный пароль не должен содержать пробелов, и должен состоять минимум из 6 символов' name="password2"><br><br>
			<input type="email" placeholder="Введите почту" name="email"><br><br>
			<input type="submit" name="enter">
			<input type="reset">
		</form>
	</div>