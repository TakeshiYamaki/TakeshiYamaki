
<?php

$pdo= new PDO("�f�[�^�x�[�X��",'���[�U��','�p�X���[�h');

$stmt= $pdo->query('SET NAMES utf8'); //���������΍��p

//show create table�𗘗p

$stmt= $pdo->query('SHOW CREATE TABLE YAMAKI');

foreach($stmt as $re){

	print_r($re); 
}
?>