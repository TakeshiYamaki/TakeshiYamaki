<?php

if (isset($_POST["delno"])) { //削除ナンバーが送られてきた場合
	$delno = $_POST["delno"]; //POSTの値を受け取って変数に割り当てる


if ($delno == $delno) { //パスワードが正しければ
	$del = file("mission_2-4.txt"); //ログファイルを開いて
for ($i = 0; $i < count($del); $i++) { //１行づつ走査しながら展開する
	$delline = explode("<>", $del[$i]);
if ($delline[0] == $delno) { //$delnoを頼りに対象行を探す
	array_splice($del, $i, 1); //対象行が見つかったら１行削除（ログファイル上はまだ削除されない）
}
}


$dellog = fopen("mission_2-4.txt", "w"); //書き込みモードでデータを開く（空になります）
flock($dellog, LOCK_EX); //ファイルロック
foreach($del as $value) { //上（$del）で処理（１行削除）したデータを配列に入れて
fputs($dellog, $value); //書き込む
}
flock($dellog, LOCK_UN); 
fclose($dellog); 
}
}






if (isset($_GET["line"])) {$line = $_GET["line"];} //GETで渡された番号を $line に代入
if (($_POST["name"] != "") or ($_POST["comment"] != "")) { //もしPOSTに [name] か [comment] があれば
if ((!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["url"])) && (!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["comment"]))) { //URL内とコメント内にURLがなければ
$data = fopen ("mission_2-4.txt","r"); //ファイルを読みこみ専用でオープン
$bdata = fgets ($data); //１行読み込む
list($bno,$bname,$bemail,$burl,$btitle,$bcomment,$btime,$biphost) = explode("<>",$bdata); //変数に変換
fclose($data);
$no = $bno; //$bno（読み込んだ一番上の行の数値）を $no に格納<br>
$no++; 	//＋１したものを今回の記事ナンバーとする
if (isset($_POST["name"])) { //もしPOSTに [name] があれば
$name = $_POST["name"]; //POSTのデータを変数$nameに格納
if( get_magic_quotes_gpc() ) { $name = stripslashes("$name"); } //クォートをエスケープする
$name = htmlspecialchars ($name); //HTMLタグ禁止
$name = mb_strimwidth ($name, 0, 14, "", "UTF-8"); //長いデータを14バイトでカット
}

if (isset($_POST["comment"])) { //もしPOSTに [comment] があれば
$comment = $_POST["comment"]; //POSTのデータを変数$commentに格納
if( get_magic_quotes_gpc() ) { $comment = stripslashes("$comment"); } 	//クォートをエスケープする
$comment = htmlspecialchars ($comment); //HTMLタグ禁止
$comment = mb_strimwidth ($comment, 0, 10000, "", "UTF-8"); //長いデータを10000バイトでカット
$comment = str_replace("\r\n", "\r", $comment); //Windowsの改行コードを置き換え
$comment = str_replace("\r", "\n", $comment); 	//Machintoshの改行コードを置き換え
$mbcomment = $comment; 	//メール用に（$mbcomment）として確保
$comment = str_replace("\n", "<br>", $comment); //\nを<br>に変換（保存・表示用）
}
if (($bname != $name) or ($bcomment != $comment)){ //name か comment が違っていたら
$time = date("Y/n/j G:i"); //日時の取得
$ip = getenv("REMOTE_ADDR"); //IPアドレス取得
$host = gethostbyaddr(getenv("REMOTE_ADDR")); //HOST取得
$iphost = ($host . "/" . $ip);

$topwrite = "$no<>$name<>$email<>$url<>$title<>$comment<>$time<>$iphost<>\n";//新しく追加するデータを <> で区切って整形
$log = file("mission_2-4.txt"); //ファイル１行づつ配列に入れながら読み込む
$write = fopen("mission_2-4.txt","w"); //書き込み用モードでデータを開く（データは空になる）
flock($write, LOCK_EX); //ファイルロック開始
fputs($write, $topwrite); //先頭に１行書き込む
for($i = 0; $i < 999; $i++){ //999行まで走査処理をする
fputs($write, $log[$i]); //今までの分を書き込む
}
flock ($write, LOCK_UN);
fclose ($write); 
}
}
}
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>2-4</title>
</head>
<body>
<form action="mission_2-4.php" method="POST">
<table border="0" cellspacing="0" cellpadding="2">

<tr>
<td>name</td>
<td><input size="40" name="name"></td>
</tr>

<tr>
<td>comment　</td>
<td><textarea name="comment" rows="6" cols="66"></textarea></td>
</tr>

</table>
<input type="submit" value="send">
</form>



<?php
$log = file("mission_2-4.txt"); //ログファイルを読み込みます
if (!$line) {
	$line = 0; //最初のページは 0
}

$pageline = 10; //１ページに表示させる行数
print "<hr>"; 	//最初に線を一本表示
for ($i = $line; $i < $line+$pageline; $i++) { 	//１行づつ走査しながら１ページ分を表示
	$list = explode("<>",$log[$i]);
if($list[0] != ""){
	print $list[4] . " ";;
	print $list[1] . " ";
if ($list[3]){ 	//urlに入力があった場合
	print "<a href='" . $list[3] . "' target='_blank'>url</a>　";
}
print $list[6] . "　[" . $list[0] . "]<br>";
print $list[5];
print "<hr>"; 	//記事の最後に線を表示
}
}

?>


<form action="mission_2-4.php" method="POST">
Delete Number <input size="10" name="delno">　
　
<input type="submit" value="Delete">

</form>
</body>
</html>
