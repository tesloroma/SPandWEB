<?php 
error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');

include_once 'settings.php';
session_start();
$CONNECT = mysqli_connect(HOST,USER,PASS,DB);

if($_SERVER['REQUEST_URI'] == '/'){
	$page = 'index';
	$module = 'index';
}
else{
	$url_path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
	$url_parts = explode('/', trim($url_path, ' /'));
	$page = array_shift($url_parts);
	$module = array_shift($url_parts);

	if(!empty($module)){
		$param = array();
		for($i=0;$i<count($url_parts); $i++){
			$param[$url_parts[$i]] = $url_parts[++$i];
		}
	}
}


if($page == 'index') {
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	echo "Главная страница";
	echo "</div>";
	include('resource\page\main\footer.php');
}
elseif ($page == 'register') {
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\register.php');
	echo "</div>";

}
elseif ($page == 'auth'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\auth.php');
	echo "</div>";
}
else if ($page == 'profile'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\profile.php');
	echo "</div>";
} 
else if ($page == 'account'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\settings\account.php');
	echo "</div>";
} 
else if ($page == 'product'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\settings\product.php');
	echo "</div>";
} 
else if ($page == 'logout'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\logout.php');
	echo "</div>";
} 
else if ($page == 'viewprofile'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\profile\viewprofile.php');
	echo "</div>";
} 
else if ($page == 'changeprofile'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\profile\changeprofile.php');
	echo "</div>";
} 
else if ($page == 'addprofile'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\profile\addprofile.php');
	echo "</div>";
} 
else if ($page == 'deleteprofile'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\profile\deleteprofile.php');
	echo "</div>";
}
else if ($page == 'addproduct'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\shop\addproduct.php');
	echo "</div>";
}
else if ($page == 'viewproduct'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\shop\viewproduct.php');
	echo "</div>";
}
else if ($page == 'sectionproduct'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\shop\sectionproduct.php');
	echo "</div>";
}
else if ($page == 'deleteproduct'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\shop\deleteproduct.php');
	echo "</div>";
}
else if ($page == 'changeproduct'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\shop\changeproduct.php');
	echo "</div>";
}
else if ($page == 'edit'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\settings\edit.php');
	echo "</div>";
}
else if ($page == 'message'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\message\message.php');
	echo "</div>";
}
else if ($page == 'mymessage'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\settings\mymessage.php');
	echo "</div>";
}
else if ($page == 'sendmessage'){
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	include('resource\page\message\sendmessage.php');
	echo "</div>";
}
else{
	include('resource\page\main\header.php');
	echo "<div class='context-main'>";
	echo "<div class='error-code'><p>Страница не найдена!</p></div>";
	echo "</div>";
}



function Sesiya($CONNECT){
	if(empty($_SESSION['USER_LOGIN'])){
		$login = '';
	}
	else{
	$login = $_SESSION['USER_LOGIN'];
	}
	$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `login`, `email`, `date_registr`, `acces` FROM `users` WHERE `login` = '$login'"));
	$_SESSION['USER_ID'] = $row['id'];
	$_SESSION['USER_LOGIN'] = $row['login'];
	$_SESSION['USER_DATE_REGISTR'] = $row['date_registr'];
	$_SESSION['USER_EMAIL'] = $row['email'];
	$_SESSION['USER_ID'] = $row['id'];
	$_SESSION['USER_LOGIN_IN'] = $row['acces'];
}

function Ulogin($p1){
	if($p1<=0 and $_SESSION['USER_LOGIN_IN'] != $p1){
		echo "<div class='error-code'><p>Данная страница доступна только для гостей!</p></div>";
		exit();
	}
	else if($p1==1 and $_SESSION['USER_LOGIN_IN'] !=1 and $_SESSION['USER_LOGIN_IN'] !=2 ){
		echo "<div class='error-code'><p>Данная страница доступна только для пользователей!</p></div>";
		exit();
	}
	else if($p1==2 and $_SESSION['USER_LOGIN_IN'] !=2){
		echo "<div class='error-code'><p>Данная страница доступна только для администраторов!</p></div>";
		exit();
	}
}

function FormChars ($p1) {
return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}
	

function GenPass ($p1, $p2) {
return md5('MRSHIFT'.md5('321'.$p1.'123').md5('678'.$p2.'890'));
}


 ?>