
<?php

$fp = fopen('mission_2-2.txt', 'r+');

flock($fp, LOCK_EX);

$count = 0;
while (fgets($fp) !== false) {
    $count++;
}

// ���̓��e�ԍ�
$next = $count + 1;

fwrite($fp, $next . ',' ."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y-m-d"). PHP_EOL);

flock($fp, LOCK_UN);
fclose($fp);

?>



<?PHP
  // �ǂݍ��ރt�@�C�����̎w��
  $file_name = "mission_2-2.txt";
  // �t�@�C����S�Ĕz��ɓ����
  $ret_array = file( $file_name );

  // �擾�����t�@�C���f�[�^(�z��)��S�ĕ\������
  for( $i = 0; $i < count($ret_array); ++$i ) {
    // �z������Ԃɕ\������
    echo( $ret_array[$i] . "<br /><hr/>\n" );
  }
?>