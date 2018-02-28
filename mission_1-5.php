<?php

$filename = 'mission_1-5.txt';

if(isset($_POST['name'], $_POST['mail'], $_POST['comment'])) {

    $fp = fopen($filename, 'w');

    $write_str = $_POST['name']."\t".$_POST['mail']."\t".$_POST['comment'];

    fwrite($fp, $write_str);

    fclose($fp);

}

?>
