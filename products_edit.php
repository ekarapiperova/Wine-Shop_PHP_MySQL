<?php 
 
 $confirm=NULL;
 if ($_POST) 
	{
	  if ($_POST['conf']=='YES') 
	  { 
		$navigation = ' / <a href="products_edit.php">Артикули</a>'; 
		$confirm='y';
	  }
	} 	
if ($_GET) 
	{ 
		$id=$_GET['id']; 
	} else {
		$id=NULL; 
	}
require 'includes/init.inc'; 
// Конфигуриране на променливите $navigation и $page_title
	if ($confirm==NULL) { $navigation = ' / <a href="'.$_SERVER['PHP_SELF'].'">Артикули</a>'; } 
	$page_title = 'Артикули';
require 'includes/header.inc'; 
print'<h1>Артикули</h1>'; 


	if ($confirm=='y') {
	
	 $mysqli->query("DELETE FROM products WHERE product_id=".(int)$_POST['id']); 
	 $aff_rows = $mysqli->affected_rows; 
		if($aff_rows){
			
			print'<div class="infoBlock">Изтрити записи: '.$aff_rows.'</div>';
		}else{
			print'<div class="errorBlock">Няма изтрити записи</div>';
			$confirm=NULL;
		}
	}	

 if ($id!=NULL) { 
		print'<div class="errorBlock" style="background-color:red;">
			<table><tr>
			 <td style="color:black;"><b>Потвърдете изтриване на продукт:</b></td> 
			 <form method="post" name="conf" action="'.$_SERVER['PHP_SELF'].'" class="form">
			 <input type="hidden" name="id" value="'.$id.'">
			 <td><input type="submit" name="conf" value="YES"></td>
			 <td><input type="submit" name="conf" value="CANCEL"></td>	
			 </form>
			 </tr></table>
			</div>';
	} 

$result = $mysqli->query("SELECT * FROM products");

if($result->num_rows>0){

	print'<table class="table-list">
		<tr>
			<th>Номер, име и описание</th>
			<th>Снимка</th>
			
			
		</tr>'; 
	while($row = $result->fetch_assoc()){
		$small_pic = $pictires_dir.$pictires_small_prefix.$row['picture'];
		$small_pic_exists = file_exists($small_pic); // съществува ли снимка
		$name = htmlspecialchars(stripcslashes($row['name']));	
		$info = htmlspecialchars(stripcslashes($row['info']));		
		print'<tr>
		<td>'.$row['product_id'].'. '.$name.'<br> '.$info.'
		<br>
		<a href="product_edit.php?id='.$row['product_id'].'"><img src="images/icons/edit.png" alt="Редактиране" title="Редактиране">Редактиране</a>
		
		<a href="'.$_SERVER['PHP_SELF'].'?id='.$row['product_id'].'"><img src="images/icons/trash.png" alt="Изтриване" title="Изтриване">Изтриване</a>
		
		</td>
			
			<td>';
			if ($small_pic_exists) { print'<img src="'.$small_pic.'" title="'.$name.'" alt="'.$name.'">';}
		print'</td> 
			
		</tr>'; 
	}
	print'</table>';
}
require 'includes/footer.inc'; 
 ?>