<?php

$pdo= new PDO("�f�[�^�x�[�X��",'���[�U��','�p�X���[�h');

$sql= 'SELECT * FROM YAMAKI';//�N�G��

$result = $pdo->query($sql);//���s�E���ʎ擾

//�o��

foreach($result as $row) {
	echo $row['id'].', ';
	echo $row['text'].'<br>';
}

?>