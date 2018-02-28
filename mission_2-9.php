
<?php

$pdo= new PDO("データベース名",'ユーザ名','パスワード');

$stmt= $pdo->query('SET NAMES utf8'); //文字化け対策用


$stmt= $pdo->query('SHOW TABLES');

foreach($stmt as $re){
	echo $re[0];
	echo '<br>'; 
}
?>
