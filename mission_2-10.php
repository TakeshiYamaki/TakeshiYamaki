
<?php

$pdo= new PDO("データベース名",'ユーザ名','パスワード');

$stmt= $pdo->query('SET NAMES utf8'); //文字化け対策用

//show create tableを利用

$stmt= $pdo->query('SHOW CREATE TABLE YAMAKI');

foreach($stmt as $re){

	print_r($re); 
}
?>