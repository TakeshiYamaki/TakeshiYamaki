<?php

$pdo= new PDO("データベース名",'ユーザ名','パスワード');

$sql= 'SELECT * FROM YAMAKI';//クエリ

$result = $pdo->query($sql);//実行・結果取得

//出力

foreach($result as $row) {
	echo $row['id'].', ';
	echo $row['text'].'<br>';
}

?>