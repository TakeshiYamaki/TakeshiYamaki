<?php

$filename = 'mission_1-6.txt';

if(isset($_POST['date'], $_POST['address'], $_POST['otherwise'])) {

    $fp = fopen($filename, 'a');

    $write_str = $_POST['date']."\t".$_POST['address']."\t".$_POST['otherwise'];

    fwrite($fp, $line.$write_str . PHP_EOL);

    fclose($fp);

}

?>