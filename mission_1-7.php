

<?php

$filename = 'mission_1-7.txt';

if(isset($_POST['name'], $_POST['mail'], $_POST['comment'])) {

    $fp = fopen($filename, 'a');

    $write_str = $_POST['name'].",".$_POST['mail'].",".$_POST['comment'];

    fwrite($fp, $line.$write_str . PHP_EOL);

    fclose($fp);

}

?>



<?PHP
  // �ǂݍ��ރt�@�C�����̎w��
  $file_name = "mission_1-7.txt";
  // �t�@�C����S�Ĕz��ɓ����
  $ret_array = file( $file_name );

  // �擾�����t�@�C���f�[�^(�z��)��S�ĕ\������
  for( $i = 0; $i < count($ret_array); ++$i ) {
    // �z������Ԃɕ\������
    echo( $ret_array[$i]. "<br /><hr/>" );
  }
?>

