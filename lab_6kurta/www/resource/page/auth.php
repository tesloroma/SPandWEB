	<?php 
Ulogin(0);
	 ?>
	<div class="form-auth">
		<form action="/account/login" method="POST">
			<input type="text" placeholder="Введите логин" title='Поддерживаются только латинские буквы и цифры' name="login"><br><br>
			<input type="password" placeholder="Введите пароль" title='Введенный пароль не должен содержать пробелов, и должен состоять минимум из 6 символов' name="password"><br><br>
			<input type="submit" name="start_login">
		</form>
	</div>