<?php 

require 'includes/init.inc'; 
$link_text = '';
$kid =  (int)$_REQUEST['kid']; 
if($kid) { 
	$query = "SELECT * FROM wine_kinds WHERE wine_kind_id=".$kid; 
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();
	$link_text = htmlspecialchars(stripcslashes($row['kind']));
}
// Конфигуриране на променливите $navigation и $page_title
$navigation = ' / <a href="'.$_SERVER['PHP_SELF'].($kid?'?kid='.$kid:'').'">'.$link_text.'</a>';
$page_title = $link_text.' - Wine Shop';

require 'includes/header.inc';

print'<h1>'.$link_text.'</h1>';

  $query = "SELECT products.*, wine_kinds.kind FROM  products "
  		." JOIN wine_kinds ON  products.product_kind_id=wine_kinds.wine_kind_id "
  		.($kid?" WHERE  products. product_kind_id=".$kid:"")." ORDER BY  product_id ASC";
  $result = $mysqli->query($query);
  $num_results = $result->num_rows;
  if($num_results>0){
	print'<table class="table-view"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		 $object_title = htmlspecialchars(stripslashes($row['name'].($row['race']?', '.$row['race']:'')));
		 $small_pic = $pictires_dir.$pictires_small_prefix.$row['picture'];
		 $small_pic_exists = file_exists($small_pic); // съществува ли снимка
        print'<a href="product.php?id='.$row['product_id'].'">
        	<img class="img-animal" src="'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
        </a>              
        <h2 class="animal-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
        if($row["race"]){
           	print'<div class="animal-race">Сорт: '.htmlspecialchars(stripslashes($row["race"])).'</div>';
        }
        if($row["price"]){
           	print'<div class="animal-price">'.$row["price"].' лв.</div>';
        }
        print'<a href="product.php?id='.$row["product_id"].'" class="more-info">Повече информация</a>
    </td>';
	$i=0;
	  if($j==2)
	  {
	    if(($i+1)<$num_results)
	      print '</tr><tr>';
		$j = 0;
	  }
	  else
	    $j++;  
	}
  print'</tr></table>';
  }
require 'includes/footer.inc'; 
?>