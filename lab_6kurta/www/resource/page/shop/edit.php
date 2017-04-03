<?php 
echo "1";
if($module == 'changeproducte' and empty($_POST['start_change'])==false)
	if(empty($_POST['start_change'])==false){

		$img = FormChars($_POST['$img']);
		$name = FormChars($_POST['$name']);
		$diagonal = FormChars($_POST['$diagonal']);
		$price = FormChars($_POST['$price']);
		$cuntry = FormChars($_POST['$cuntry']);
		if(!$img or !$name or !$diagonal or !$price or !$cuntry){
			echo "<div class='error-code'><p>Заполните поля!</p></div>";
			exit();
		}
		else{
			$row2 = mysqli_query($CONNECT, "UPDATE `shop` SET `img` = '$img' , `name` = '$name' , `diagonal` = '$diagonal' , `price` = '$price' , `cuntry` = '$cuntry'  WHERE `id` = '$id'");
			echo "<div class='error-code'><p>Данные изменены!</p></div>";
		}
	}

 ?>