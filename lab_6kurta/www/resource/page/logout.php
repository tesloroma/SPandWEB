<?php
Ulogin(1);
	echo "<p class='hello'>".$_SESSION['USER_LOGIN'] .", спасибо что были с нами, возвращайтесь!</p>"; 
		$_SESSION['USER_ID'] = 0;
		$_SESSION['USER_LOGIN'] = 0;
		$_SESSION['USER_DATE_REGISTR'] = 0;
		$_SESSION['USER_EMAIL'] = 0;
		$_SESSION['USER_ID'] = 0;
		$_SESSION['USER_LOGIN_IN'] = 0;

 ?>