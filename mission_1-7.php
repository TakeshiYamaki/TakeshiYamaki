

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
  // 読み込むファイル名の指定
  $file_name = "mission_1-7.txt";
  // ファイルを全て配列に入れる
  $ret_array = file( $file_name );

  // 取得したファイルデータ(配列)を全て表示する
  for( $i = 0; $i < count($ret_array); ++$i ) {
    // 配列を順番に表示する
    echo( $ret_array[$i]. "<br /><hr/>" );
  }
?>

