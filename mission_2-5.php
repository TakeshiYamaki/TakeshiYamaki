
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>2-5</title>
</head>
<body>

<?php
if (isset($_POST["delete"])) { 	//削除の場合
	$edno = $_POST["edno"]; 	
if ($edno == $edno) { 	
	$data = file("mission_2-5.txt"); //ログファイルを開いて
	$linecount = 0; //行数カウント
for ($i = 0; $i < count($data); $i++) { //走査する
	$list = explode("<>", $data[$i]); //区切り文字 <> で区切る
if ($edno == $list[0]) { //$delnoを頼りに親記事を探す
	$top = $i; //上からの行数
	$linecount++; //行数をプラス
}
elseif ($edno == $list[1]) {
$linecount++; 		//行数をプラス
}
}


if (isset($linecount)) {
	$string = array_splice($data, $top, $linecount);//同一スレッド行を削除
} 
$deldata = fopen("mission_2-5.txt", "w"); //書き込みモードでファイルを開く
flock($deldata, LOCK_EX); //ファイルロック
foreach($data as $value) { //配列処理して
fputs($deldata, $value);} //書き込む
flock($deldata, LOCK_UN); 
fclose($deldata); 
}
}

if ($_GET["resformno"]) { //レスフォームの場合
	$resformno = $_GET["resformno"]; //GETで渡された番号を $resformno に代入
	$resline = file ("mission_2-5.txt");	//データを開いて
for ($i = 0; $i < count($resline); $i++) {
	$list = explode("<>", $resline[$i]);
if ($resformno == $list[0]) { //ここが返信対象の親記事
	$retitle = $list[5]; //返信タイトルを設定
if ($list[0] == $list[1]) { //親記事なら
	print $list[5] . " ";;
	print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>　";
}
print $list[7] . "　[" . $list[0] . "]<br>";
print $list[6];
print "<hr>"; //記事の最後に線を表示
}
else { 	//返信記事なら
print "<span style='margin-left:60px;'>" . $list[5] . " ";
print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>　";
}
print $list[7] . "　[" . $list[0] . "]</span><br>";
print "<div style='margin-left:60px;'>" . $list[6] . "</div>";
print "<hr style='margin-left:60px;'>"; //記事の最後に線を表示
}
if ($resformno != $list[1]) { 	//次の親記事
	break;
}
}
}
print "<br>"; 	//改行
?>



<form action="mission_2-5.php" method="POST">
<input name="bbsresno" type="hidden" value="<?php print $resformno; ?>">
<table border="0" cellspacing="0" cellpadding="2">

<tr>
<td class="gray">name</td>
<td><input size="40" name="name"></td>
</tr>
<tr>
<td class="gray">email</td>
<td><input size="68" name="email"></td>
</tr>
<tr>
<td class="gray">url</td>
<td><input size="68" name="url"></td>
</tr>
<tr>
<td class="gray">title</td>
<td><input size="68" name="title" value="<?php print "Re:" . $retitle; ?>"></td>
</tr>
<tr>
<td class="gray">comment　</td>
<td><textarea name="comment" rows="6" cols="66"></textarea></td>
</tr>
</table>
<input type="submit" value="send">
</form>



<?php
}
elseif (isset($_POST["edit"])) { //修正フォーム表示
	$edno = $_POST["edno"];	
if ($edno == $edno) { 
	$ediline = file("mission_2-5.txt");
for ($i = 0; $i < count($ediline); $i++) { 
	$edit = explode("<>", $ediline[$i]);
if ($edit[0] == $edno) { //編集対象行を探す
	print "<div align='center'>\n";	//以下、編集対象行をフォーム内に表示
	print "<center>\n";
	print "No." . $edit[0] . "　" . $edit[3] . " さんの書き込みを修正できます。<br>\n<br>\n";
	print "<form action='mission_2-5.php' method='POST'>\n";
	print "<table cellspacing='4' cellpadding='0' width='600' border='0'>\n";
	print "<tr>\n<td>\n";
	print "<font style='font-size:14px;color:#808080;'>name</font><br>\n";
	print "<input size='30' name='name' value='" . $edit[2] . "'><br>\n";
	print "<font style='font-size:14px;color:#808080;'>email</font><br>\n";
	print "<input size='30' name='email' value='" . $edit[3] . "'><br>\n";
	print "<font style='font-size:14px;color:#808080;'>url</font><br>\n";
	print "<input size='30' name='url' value='" . $edit[4] . "'><br>\n";
	print "<font style='font-size:14px;color:#808080;'>title</font><br>\n";
	print "<input size='30' name='title' value='" . $edit[5] . "'><br>\n";
	print "<font style='font-size:14px;color:#808080;'>comment</font><br>\n";
	$edcomment = str_replace("<br>", "\n", $edit[6]);	//<br>を\nに変換
	print "<textarea name='comment' rows='7' cols='68'>" . $edcomment . "</textarea><br>\n";
	print "<input style='cursor:hand;' type='submit' value='修正' name='editaction'>\n<input type='hidden' name='editno' value='" . $edno . "'>\n<input type='hidden' name='reno' value='" . $edit[1] . "'>\n";
	print "</td>\n</tr>\n";
	print "</table>\n";
	print "</form>\n";
	print "</center>\n";
	print "</div>\n";
}
}
}
}
else {
//新規投稿・レス投稿共通処理
if( ($_POST["name"] != "") or ($_POST["comment"] != "") ) {
if ((!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["url"])) && (!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["comment"]))) { //URL内とコメント内にURLがなければ
if(isset($_POST["name"])) { $name = $_POST["name"]; }	//POSTの値を受け取って変数に割り当てる
$name = mb_strimwidth ($name, 0, 48, "…", "UTF-8");	//長い名前を48バイト＋…にする
if( get_magic_quotes_gpc() ) { $name = stripslashes("$name"); } //クォートをエスケープする
$name = htmlspecialchars ($name); //タグ禁止
if(isset($_POST["email"])) { $email = $_POST["email"]; }//POSTの値を受け取って変数に割り当てる
$email = mb_strimwidth ($email, 0, 100, "", "UTF-8");	//長いメールアドレスを100バイトでカット
if( get_magic_quotes_gpc() ) { $email = stripslashes("$email"); } //クォートをエスケープする
$email = htmlspecialchars ($email); 	//タグ禁止
if(isset($_POST["url"])) { $url = $_POST["url"]; }//POSTの値を受け取って変数に割り当てる
$url = mb_strimwidth ($url, 0, 100, "", "UTF-8");//長いメールアドレスを100バイトでカット
if( get_magic_quotes_gpc() ) { $url = stripslashes("$url"); } 	//クォートをエスケープする
$url = htmlspecialchars ($url); //タグ禁止
$hurl = "h" . $url; //タグ禁止
if(isset($_POST["title"])) { $title = $_POST["title"]; }//POSTの値を受け取って変数に割り当てる
$title = mb_strimwidth ($title, 0, 100, "", "UTF-8");	//長いメールアドレスを100バイトでカット
if( get_magic_quotes_gpc() ) { $title = stripslashes("$title"); } //クォートをエスケープする
$title = htmlspecialchars ($title); 	//タグ禁止
if(isset($_POST["comment"])) { $comment = $_POST["comment"]; }	//POSTの値を受け取って変数に割り当てる
$comment = mb_strimwidth ($comment, 0, 10000, "…", "UTF-8");	//長いコメントを10000バイト＋…にする
$comment = str_replace("\r\n", "\r", $comment);	//Windows
$comment = str_replace("\r", "\n", $comment);	//Machintosh
if( get_magic_quotes_gpc() ) { $comment = stripslashes("$comment"); } 	//クォートをエスケープする
$comment = htmlspecialchars ($comment); //タグ禁止
$mcomment = $comment;	//メール用
$comment = str_replace("\n", "<br>", $comment);	//\nを<br>に変換
$time = date( Y . "/" . m . "/" . d . " " . H . ":" . i );
$ip = getenv("REMOTE_ADDR");//IPアドレス取得
$host = gethostbyaddr(getenv("REMOTE_ADDR"));
$nip = ($host . "/" . $ip);
$data = file("mission_2-5.txt");//ファイルを開いて
$bno = 0;
foreach($data as $value) {
$list = explode("<>", $value);
if ($bno < $list[0]) {
$bno = $list[0];//最大の記事Ｎoを探して
}
}


$no = $bno + 1;	//＋１したものを新しい NO とする
foreach($data as $value) {
	$list = explode("<>", $value);
if ($bno == $list[0]) {
	$bname = $list[2];
	$bcomment = $list[6];
}
}
if (($bname != $name) or ($bcomment != $comment)) {
//共通処理ここまで
if (isset($_POST["bbsresno"])) {//レス投稿の場合
	$bbsresno = $_POST["bbsresno"];
	$reswrite = "$no<>$bbsresno<>$name<>$email<>$url<>$title<>$comment<>$time<>$nip<>\n"; //追加する１行
	$insert = 0;	//$bbsresno と $list[0] が同一の行（親記事）を探す
for ($i = 0; $i < count($data); $i++) {	//走査する
	$list = explode("<>", $data[$i]);
if ($insert == 0) {//まだ親記事が見つかっていない状態
if ($bbsresno == $list[0]) {//ここが親記事
	$insert = 1;//親記事を見つけた印
}
}
else {//レス記事は飛ばして
if ($bbsresno != $list[1]) {	//次の親記事まできたら
	array_splice($data, $i, 0, $reswrite); 	//新しい行をここに挿入
	$insert = 0;	//挿入が済んだ印
	break;
}
}
}
if ($insert == 1) {array_push($data, $reswrite);}//挿入が済んでいない（次の親記事がない＝最下行であるということ）の場合
$linecount = 0;	//行数カウント
for ($i = 0; $i < count($data); $i++) {
	$list = explode("<>", $data[$i]); 
if ($bbsresno == $list[0])  {	//$bbsresnoを頼りに親記事を探す
	$top = $i;//上からの行数
	$linecount++;//行数をプラス
}
elseif ($bbsresno == $list[1]) {
	$linecount++;	//行数をプラス
}
}
if (isset($linecount)) {
	$string = array_splice($data, $top, $linecount);//移動する行を削除
	$newdata = array_merge($string, $data);	//先頭に足す
}
$redata = fopen("mission_2-5.txt", "w");//書き込みモードでファイルを開く
flock($redata, LOCK_EX);//ファイルロック
foreach($newdata as $value) {//配列処理して
	fputs($redata, $value);}//書き込む
	flock($redata, LOCK_UN);
	fclose($redata);

}//レス投稿の場合、ここまで
elseif (isset($_POST["editaction"])) {	//編集の場合
	$editno = $_POST["editno"];//POSTの値を受け取って変数に割り当てる
	$reno = $_POST["reno"];	//POSTの値を受け取って変数に割り当てる
	$edit = file("mission_2-5.txt");//データを開いて
for ($i = 0; $i < count($edit); $i++) { //展開する
	$ediline = explode("<>", $edit[$i]);
if ($ediline[0] == $editno) { 	//置き換え対象行を探す
	$ediwrite = "$editno<>$reno<>$name<>$email<>$url<>$title<>$comment<>$time<>$ip<>\n"; //置き換えする１行
	array_splice($edit,$i,1,"$ediwrite");//１行置き換え
}
}
$edi = fopen('mission_2-5.txt', 'w');//書き込みモードでデータを開く
flock($edi, LOCK_EX);
foreach($edit as $value) {
	fputs($edi, $value);//１行置き換えして書き込む
}
flock($edi, LOCK_UN); 
fclose($edi);	//閉じる
}

else {	//新規投稿の場合
	$topwrite = "$no<>$no<>$name<>$email<>$url<>$title<>$comment<>$time<>$nip<>\n"; //追加する１行
	$data = file("mission_2-5.txt");//データを読み込む
	$nwrite = fopen("mission_2-5.txt","w"); //追加書き込み　空になる
	flock($nwrite, LOCK_EX);
	fputs($nwrite, $topwrite);//先頭に１行書き込む
for($i = 0; $i < count($data); $i++){
	fputs($nwrite, $data[$i]);//今までの分を書き込む
}
flock($nwrite, LOCK_UN);
fclose ($nwrite);

$thread = 0;//親記事を数える
$data = file("mission_2-5.txt");
for ($i = 0; $i < count($data); $i++) {
	$list = explode("<>", $data[$i]); 
if ($list[0] == $list[1]) {//親記事なら
	$thread++;//親記事の数
}
}

if ($thread >= 6){//親記事が6以上あれば
	$data = file("mission_2-5.txt");
	$delete = array_pop($data);//最後の行を削除
list($dno,$dresno,$dname,$demail,$durl,$dtitle,$dcomment,$dtime,$dip) = explode("<>",$delete);	//最後の行の内容
}
for ($i = 0; $i < count($data); $i++) {
	$list = explode("<>", $data[$i]); 
if ($list[1] == $dresno) {//削除した行の親記事または返信記事があれば
	array_splice($data, $i);//記事削除する
}
}
$nwrite = fopen("mission_2-5.txt", "w");
flock($nwrite, LOCK_EX);
foreach($data as $value) fputs($nwrite, $value);
flock($nwrite, LOCK_UN); 
fclose($nwrite);
}
}
}
}
//最初の表示・新規投稿後の表示・レス投稿処理後の表示
?>



<form action="mission_2-5.php" method="POST">
<table border="0" cellspacing="0" cellpadding="2">
<tr>
<td class="gray">name</td>
<td><input size="40" name="name"></td>
</tr>
<tr>
<td class="gray">email</td>
<td><input size="68" name="email"></td>
</tr>
<tr>
<td class="gray">url</td>
<td><input size="68" name="url"></td>
</tr>
<tr>
<td class="gray">title</td>
<td><input size="68" name="title"></td>
</tr>
<tr>
<td class="gray">comment　</td>
<td><textarea name="comment" rows="6" cols="66"></textarea></td>
</tr>
</table>
<input type="submit" value="send">
</form>


<?php
if ($_GET["line"]) {$line = $_GET["line"];} //GETで渡された番号を $line に代入
else {$line = 0;} //GETがなければ $line は 0
$pagethread = 10; //１ページに表示するスレッド数
$log = file("mission_2-5.txt"); //ログファイルを開く
$data = fopen("mission_2-5.txt", "r"); //データを読み込む
$totalthread = 0; //とりあえずスレッド数を 0 に
for ($i = 0; $i < count($log); $i++) { 	//親記事の数を数えるための走査
	$list = explode("<>", $log[$i]);
if ($list[0] == $list[1]) {$totalthread++;} //親記事の数を数える
}
fclose($data);
$threadno = 0;
foreach ($log as $value) { //また走査
	$list = explode("<>", $value);
if ($list[0] == $list[1]) {$threadno++;} //親記事だったら $threadno を増やす
if ($threadno <= $line * $pagethread) { //$pagethread 分読んだら
	continue; //繰り返しを抜けて次へ
}
elseif ($threadno > ($line + 1) * $pagethread) { //終わりまできたら
	break; 	//処理を終了
}

if ($list[0] == $list[1]) { //（表示）親記事なら
	print "<hr>"; 	//最初に線を一本表示
	print $list[5] . " ";;
	print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>　";
}
print $list[7] . "　[" . $list[0] . "]　<a href='mission_2-5.php?resformno=" . $list[0] . "'>Re:</a><br>";
print $list[6];
print "<hr>"; 	//記事の最後に線を表示
}
else { //（表示）返信記事なら
	print "<span style='margin-left:60px;'>" . $list[5] . " "; //先頭に60ピクセルの空きを作る
	print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>　";
}
print $list[7] . "　[" . $list[0] . "]</span><br>";
print "<div style='margin-left:60px;'>" . $list[6] . "</div>";
print "<hr style='margin-left:60px;'>"; //記事の最後に線を表示
}
}
if ($totalthread > $pagethread) { //２ページ以上になるなら
	$lines = ceil(($totalthread/$pagethread-1)); //何ページになるか計算する
	$now=1;
	$next=0;
for ($i = 0; $lines >= 0; $i++) { //ページ番号表示のための走査
	$list = explode("<>", $log[$i]);
if ($line == $next) {
	print $now . "&nbsp;";} //表示中のページはリンクなし
else {
	print "<a href='mission_2-5.php?line=" . "$next" . "'>" . "$now" . "</a>&nbsp;";}//アンカータグで GET で渡す
	$now++;
	$next = $next + 1;
	$lines = $lines - 1;
}
}
}
?>

<?php
if ((!isset($_GET["resformno"])) && (!isset($_POST["edit"]))) {
?>

<form action="mission_2-5.php?page=20&no=2" method="POST">

Number <input size="4" name="edno">　
　<input type="submit" name="delete" value="Delete">
　<input type="submit" name="edit" value="Edit">

</form>
<?php
}
?>
</body>
</html>
