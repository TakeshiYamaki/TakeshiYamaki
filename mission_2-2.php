
<?php

$fp = fopen('mission_2-2.txt', 'r+');

flock($fp, LOCK_EX);

$count = 0;
while (fgets($fp) !== false) {
    $count++;
}

// 次の投稿番号
$next = $count + 1;

fwrite($fp, $next . ',' ."<>".$_POST['name']."<>".$_POST['comment']."<>".date("Y-m-d"). PHP_EOL);

flock($fp, LOCK_UN);
fclose($fp);

?>



<?PHP
  // 読み込むファイル名の指定
  $file_name = "mission_2-2.txt";
  // ファイルを全て配列に入れる
  $ret_array = file( $file_name );

  // 取得したファイルデータ(配列)を全て表示する
  for( $i = 0; $i < count($ret_array); ++$i ) {
    // 配列を順番に表示する
    echo( $ret_array[$i] . "<br /><hr/>\n" );
  }
?>