
<?php

$pdo= new PDO("�f�[�^�x�[�X��",'���[�U��','�p�X���[�h');

$stmt= $pdo->query('SET NAMES utf8'); //���������΍��p


$stmt= $pdo->query('SHOW TABLES');

foreach($stmt as $re){
	echo $re[0];
	echo '<br>'; 
}
?>
