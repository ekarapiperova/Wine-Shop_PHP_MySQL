<?php 
// Страница за редактиране или създаване на ново продукт
require 'includes/init.inc';
 $errorMessage = NULL;
 $infoMessage = NULL;
 
 $operation_type = 'Нов артикул';
 
  if($_REQUEST){ 
  	$id = (int)$_REQUEST['id'];
  } else { 
  	$id = NULL; 
  } 
  
  if($_POST){ 
 $operation_type = 'Редактиране на артикул';
	
	$id = $mysqli->escape_string(trim($_POST['id']));
	$name = $mysqli->escape_string(trim($_POST['name']));
	$product_kind_id = $mysqli->escape_string(($_POST['product_kind_id'])); 
	$race = $mysqli->escape_string(trim($_POST['race']));
	$price = $mysqli->escape_string((int)trim($_POST['price']));
	$info = $mysqli->escape_string(trim($_POST['info']));
	$picture = $mysqli->escape_string(trim($_POST['picture']));

    if(!$_POST['name'] || !$_POST['picture']){
    	$errorMessage = 'Попълни всичко!';
	} else {	
		$picture=$picture.'.jpg';
  		if($id){ 
  			$query = "UPDATE products SET "
					." name= ".($name?"'".$name."'":"NULL").", "
					." product_kind_id= ".($product_kind_id?"'".$product_kind_id."'":"NULL").", "
					." race= ".($race?"'".$race."'":"NULL").", "
					." price= ".($price?"'".$price."'":"NULL").", "
					." picture= ".($picture?"'".$picture."'":"NULL").", "
					." info= ".($info?"'".$info."'":"NULL")
					." WHERE product_id=".$id." AND product_id>5";
  		} else { 
			$query = "INSERT INTO products(name, product_kind_id, race, price, picture, info) VALUES ("
					.($name?"'".$name."'":"NULL").", "
					.($product_kind_id?"'".$product_kind_id."'":"NULL").", "
					.($race?"'".$race."'":"NULL").", "
					.($price?"'".$price."'":"NULL").", "
					.($picture?"'".$picture."'":"NULL").", "
					.($info?"'".$info."'":"NULL")
					.")";	
		}
		
		$mysqli->query($query);
		
		$id = $id?$id:$mysqli->insert_id;
		$infoMessage = 'Данните са записани!';
	}
  } else { 
	
  } 
  	if($id) {
	  $query = "SELECT * FROM products WHERE product_id=".$id;
	  $result = $mysqli->query($query);
	  if($row = $result->fetch_assoc()){
	  	$operation_type = 'Редактиране на артикул';
	  	$name = $row['name'];
		$product_kind_id = $row['product_kind_id'];
		$race = $row['race'];
		$price = $row['price'];
		$info = $row['info'];
		$picture = $row['picture'];
	  }
	}
// Конфигуриране на променливите $navigation и $page_title
  $navigation = ' / <a href="products_edit.php">Артикули</a>'.' / '.$operation_type;
  $page_title = $operation_type.' Wine Shop';

require 'includes/header.inc';

print' <div align="center"> <!-- Центриране в content-а -->';
	
if($id>=1){
	
} 
    
    if($errorMessage){
		print'<div class="errorBlock">'.$errorMessage.'</div>';
	} 
	if($infoMessage){
		print'<div class="infoBlock">'.$infoMessage.'</div>';
	} 	
 
	if($_POST || $_REQUEST){  
	print'<form method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="'.$id.'">
		<input type="hidden" name="picture" value="'.$picture.'">
	    <div class="form-title">'.$operation_type.'</div>'; 
	       $small_pic = $pictires_dir.$pictires_small_prefix.$picture;
		   $small_pic_exists = file_exists($small_pic); // съществува ли снимка
		   print $small_pic_exists?'<div class="form-row" style="text-align:center"><img src="'.$small_pic.'" title="" alt=""></div>':'';
	print'<div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="'.htmlspecialchars(stripslashes($name)).'">
	    </div>
	    <div class="form-row">
	        <label for="product_kind_id">Вид</label>
	        <select name="product_kind_id" id="product_kind_id">';
		          $query = 'SELECT * FROM wine_kinds ORDER BY kind';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){	
					$sel=''; 
					if($row['wine_kind_id']==$wine_kind_id){$sel=' selected';}
		             print'<option value="'.$row['wine_kind_id'].'"'.$sel.'>'.htmlspecialchars(stripslashes($row["kind"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="race">Сорт</label>
	        <input type="text" maxlength="32" name="race" id="race" value="'.htmlspecialchars(stripslashes($race)).'">
	    </div>
	    <div class="form-row">
	        <label for="price">Цена (цяло число)</label>
	        <input type="text" maxlength="4" name="price" id="price" value="'.htmlspecialchars(stripslashes($price)).'"> лв.
	    </div>';
		$picture=str_replace('.jpg','',$picture);
		print'<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value="'.htmlspecialchars(stripslashes($picture)).'"> .jpg
	    </div>		
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="info" id="info">'.htmlspecialchars(stripslashes($info)).'</textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
	</form>';
	} else {
	 
	print'<form method="post" name="new" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="">
	    <div class="form-title">'.$operation_type.'</div>
	    <div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="">
	    </div>
	    <div class="form-row">
	        <label for="product_kind_id">* Вид</label>
	        <select name="product_kind_id" id="product_kind_id">';
		          $query = 'SELECT * FROM wine_kinds ORDER BY wine_kind_id';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){
		            print'<option value="'.$row['wine_kind_id'].'">'.htmlspecialchars(stripslashes($row["kind"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="race">Сорт</label>
	        <input type="text" maxlength="32" name="race" id="race" value="">
	    </div>
	    <div class="form-row">
	        <label for="price">Цена (цяло число)</label>
	        <input type="text" maxlength="4" name="price" id="price" value=""> лв.
	    </div>
		<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value=""> .jpg
	    </div>
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="info" id="info"></textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
		</form>';
	}
print'</div>';
require 'includes/footer.inc'; 
?>