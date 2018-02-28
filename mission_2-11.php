<?php

$pdo= new PDO("データベース名",'ユーザ名','パスワード');

$stmt = $pdo -> prepare("INSERT INTO YAMAKI (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':value', 1, PDO::PARAM_INT);

$name = 'one';
$stmt->execute();

?>