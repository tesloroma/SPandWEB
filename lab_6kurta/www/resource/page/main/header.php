<!DOCTYPE html>
<html>
<head>
	<title>CMS</title>
		<link rel="stylesheet" href="http://test1.ru/resource/css/style.css">
</head>
<body>
	<div class="wrapper">
		
		<div class="header">
			<div class="logo">
				<img src="http://test1.ru/resource/images/logo.png" alt="">
			</div>
			<div class="main-menu">
				<ul>
				<?php  
				Sesiya($CONNECT);
				if($_SESSION['USER_LOGIN_IN'] >= 1){
					echo '
					<li><a href="/index">Главная</a></li>
					<li><a href="/profile">Профиль</a></li>
					<li><a href="/logout">Выход</a></li>
					<li><a href="/message">Личные сообщения</a></li>
				';
				}
				else{
					echo '
					<li><a href="/index">Главная</a></li>
					<li><a href="/register">Зарегистрироваться</a></li>
					<li><a href="/auth">Войти</a></li>
				';
				}
				?>
				</ul>
			</div>
			<?php
			if($_SESSION['USER_LOGIN_IN'] >= 1){
				echo "<p class='hello'>Приветствуем тебя, Вы вошли как:  ".$_SESSION['USER_LOGIN'] ." !</p>";
			}
			  ?>
		</div>
		<div class="left-sidebar">	
			<div class="side-menu">
				<ul>
					<?php  
				if($_SESSION['USER_LOGIN_IN'] >= 1){
					echo '
					<li><a href="/index">Главная</a></li>
					<li><a href="/profile">Профиль</a></li>
					<li><a href="/logout">Выход</a></li>
				';
				}
				else{
					echo '
					<li><a href="/index">Главная</a></li>
					<li><a href="/register">Зарегистрироваться</a></li>
					<li><a href="/auth">Войти</a></li>
				';
				}
				?>
				</ul>
			</div>
			<div class="side-menu">
				<ul>
					<li><a href="/viewproduct">Все товары</a></li>
					<li><a href="/sectionproduct">Категория товаров</a></li>
				</ul>
			</div>
			<div class="side-menu">
				<ul>
					<?php  
				if($_SESSION['USER_LOGIN_IN'] == 1){
					echo '
					<li><a href="/addproduct">Добавить товар</a></li>
					<li><a href="/viewprofile">Просмотр пользователей</a></li>
				';
				}
				else if($_SESSION['USER_LOGIN_IN'] == 2)
				{
					echo '
					<li><a href="/deleteproduct">Удалить товар</a></li>
					<li><a href="/changeproduct">Изменить товар</a></li>
					<li><a href="/addproduct">Добавить товар</a></li>
					<li><a href="/addprofile">Добавить пользователя </a></li>
					<li><a href="/deleteprofile">Удалить пользователя </a></li>
					<li><a href="/changeprofile">Изменить пользователя </a></li>
					<li><a href="/viewprofile">Просмотр пользователя </a></li>
				';
				}
				else if($_SESSION['USER_LOGIN_IN'] == 0)
				{
					echo '
				Для упарвления товарами. необходимо авторизироваться!
				';
				}
				?>
				</ul>
			</div>
		</div>
