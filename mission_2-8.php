
<?php 

$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';

$pdo = new PDO($dsn, $user, $password);


$sql = "CREATE TABLE YAMAKI"
."("
. "`dd` INT auto_increment primary key,"
. "`y` INT,"
. "`m` INT,"
. "`d` INT,"
. "`youbi` INT,"
. "`yokin` INT,"
. "`a1` INT,"
. "`a2` INT,"
. "`a3` INT,"
. "`a4` INT,"
. "`a5` INT,"
. "`i_date` DATETIME"
.");";
$stmt = $pdo -> prepare($sql);
$stmt -> execute();
?>