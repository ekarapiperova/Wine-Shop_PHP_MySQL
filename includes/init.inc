<?php 
// Може да възникнат проблеми, ако не е зададена директивата output_buffering = On 
// - за някои страници с редирект - напр., header("Location: products_edit.php")
// Задаването става само в php.ini на Apache сървъра

 // Старт на сесия
session_start();

 // Инициализация на Базата данни 
 // създаване на обект от класа mysqli
$mysqli = new mysqli('localhost', 'root', '', 'shop'); 
 // задаване на кодировка utf8
$mysqli->set_charset('utf8'); 

 // снимките се качват в директорията $animal_pictires_dir
$pictires_dir = 'images/objects/';
 // за всяко животно има основна снимка и малка снимка с максимална ширина 180px 
 // и с име като името на оновната снимка, предшествано от $animal_pictires_small_prefix.
$pictires_small_prefix = '';
?>