<?php 
// Променливите за име на страницата ($page_title) и за навигация ($navigation) се задават във всяка отделна страница
print'
<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8">
    	<title>'.$page_title.'</title>
    	<link href="styles/normal.css" type="text/css" rel="stylesheet">
    </head>
    <body>
    	<div align="center"> <!-- центрираме сайта в браузъра -->
    		<div id="site"> <!-- контейнер за целия сайт -->			
    			<!-- заглавна част - може и съдържание да има - не само background -->
    			<div id="header" title="Онлай Wine Shop"></div>		
    			<div id="top_menu"> <!-- Горно меню -->
    				<a href="." class="top_menu_a">Начало</a>';				
// Проверка за логнат администратор. Сесиите се генерират при логване от файла login.php
    					if(!isset($_SESSION['person_type'])){
						// Ако потребителя не е логнат извеждаме бутон ВХОД
							print '<span style="padding-left:800px;"><a href="login.php" class="top_menu_a">Вход</a></span>'; 				
						} else {
						// Aко е администратор ще има достъп за промяна на данни на животни. 
						// Извеждме бутони ЖИВОТНИ, НОВО ЖИВОТНО и ИЗХОД
						if($_SESSION['person_type']==1){	
							print '<a href="products_edit.php" class="top_menu_a">Продукти</a>
								   <a href="product_edit.php" class="top_menu_a">Нов продукт</a>';						
						}
						print' <span style="padding-left:570px;"><a href="logout.php" class="top_menu_a">Изход</a></span>';
						}		
print'   		
				</div>
    			<div id="left_menu"> <!-- Ляво меню -->';
				    // Извеждане на лявата лента с видовете животни
				    $result = $mysqli->query("SELECT * FROM wine_kinds");
				    while($row = $result->fetch_assoc()){
						print'<a href="products.php?kid='.$row['wine_kind_id'].'" 
						   class="left_menu_a">'.htmlspecialchars(stripslashes($row['kind'])).'</a>';
				    } 
print'
    			</div>
    			<div id="content"> <!-- Основна част -->
    				<div id="navigation"> <!-- Път до текущата страница-->
    					<a href=".">Начало</a>
    					 '.$navigation.'
    				</div>';
?>