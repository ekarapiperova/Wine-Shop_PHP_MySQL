<?php 
require 'includes/init.inc';

$id = (int)$_REQUEST['id'];
if($id) { 

	$query = "SELECT products.*, wine_kinds.kind, DATE_FORMAT(registration_date,'%d.%m.%Y г.') AS date_formated "
	." FROM products JOIN wine_kinds ON products.product_kind_id=wine_kinds.wine_kind_id WHERE product_id=".$id;
    $result = $mysqli->query($query);
	$row_product = $result->fetch_assoc();
// Конфигуриране на променливите $navigation и $page_title
	$navigation = ' / <a href="products.php'.($row_product['product_kind_id']?'?kid='.$row_product['product_kind_id']:'').'">'.htmlspecialchars(stripcslashes($row_product['kind'])).'</a>'
			.' / <a href="'.$_SERVER['PHP_SELF'].($id?'?id='.$id:'').'">'.htmlspecialchars(stripcslashes($row_product['name'])).'</a>';
	$page_title = 'Wine Shop- '.htmlspecialchars(stripcslashes($row_product['name']));
}

require 'includes/header.inc'; 


print' <div style="text-align: left">	
<table class="animal-info-table">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			<h1>'.htmlspecialchars(stripslashes($row_product['name'])).'</h1>';
			if($row_product["kind"]){
           		print'<div>Вид: '.htmlspecialchars(stripslashes($row_product["kind"])).'</div>';
           	}
			if($row_product["race"]){
           		print'<div>Сорт: '.htmlspecialchars(stripslashes($row_product["race"])).'</div>';
           	}
        	if($row_product["price"]){
           		print'<div>Цена: '.$row_product["price"].' лв.</div>';
        	}
        	if($row_product["info"]){
           		print'<div>Описание: '.htmlspecialchars(stripslashes($row_product["info"])).'</div>';
        	}     
        	print'<div>Дата на регистрация: '.$row_product["date_formated"].'</div>		
		</td>
		<td>';
			   $object_title = htmlspecialchars(stripslashes($row_product['name'].($row_product['race']?', '.$row_product['race']:'')));
			   $pic = $pictires_dir.$row_product['picture'];
			   $pic_exists = file_exists($pic); // съществува ли снимка
			print'<img class="img-animal" src="'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'">			
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		
	</tr>
</table>             
</div>';
require 'includes/footer.inc'; 
 ?>