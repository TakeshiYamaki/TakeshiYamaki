<html>

<head>�y2-3�e�X�g�z
<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<title>�y2-3�e�X�g�z</title>
</head>

<body>

<form action="mission_2-3.php" method="post">


  ���O�F<br />
  <input type="text" name="name" size="30" value="" /><br />
 
  <input type="submit" value="�o�^����" />

</form>
</body>


</html>



<?php

$fp = fopen('mission_2-3.txt', 'a+');

flock($fp, LOCK_EX);

$count = 0;
while (fgets($fp) !== false) {
    $count++;
}

// ���̓��e�ԍ�
$next = $count + 1;

fwrite($fp, $next . ',' ."<>".$_POST['name']."<>".date("Y-m-d"). PHP_EOL);

flock($fp, LOCK_UN);
fclose($fp);

?>





<?PHP


$data = file_get_contents("mission_2-3.txt");

$data = explode("<>", $data);

$cnt = count( $data );

for( $i=0;$i<$cnt;$i++ )
{
echo($data[$i]. "<br /><hr/>");
}
?>
