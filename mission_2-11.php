<?php

$pdo= new PDO("�f�[�^�x�[�X��",'���[�U��','�p�X���[�h');

$stmt = $pdo -> prepare("INSERT INTO YAMAKI (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':value', 1, PDO::PARAM_INT);

$name = 'one';
$stmt->execute();

?>