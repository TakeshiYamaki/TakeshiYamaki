
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>2-5</title>
</head>
<body>

<?php
if (isset($_POST["delete"])) { 	//�폜�̏ꍇ
	$edno = $_POST["edno"]; 	
if ($edno == $edno) { 	
	$data = file("mission_2-5.txt"); //���O�t�@�C�����J����
	$linecount = 0; //�s���J�E���g
for ($i = 0; $i < count($data); $i++) { //��������
	$list = explode("<>", $data[$i]); //��؂蕶�� <> �ŋ�؂�
if ($edno == $list[0]) { //$delno�𗊂�ɐe�L����T��
	$top = $i; //�ォ��̍s��
	$linecount++; //�s�����v���X
}
elseif ($edno == $list[1]) {
$linecount++; 		//�s�����v���X
}
}


if (isset($linecount)) {
	$string = array_splice($data, $top, $linecount);//����X���b�h�s���폜
} 
$deldata = fopen("mission_2-5.txt", "w"); //�������݃��[�h�Ńt�@�C�����J��
flock($deldata, LOCK_EX); //�t�@�C�����b�N
foreach($data as $value) { //�z�񏈗�����
fputs($deldata, $value);} //��������
flock($deldata, LOCK_UN); 
fclose($deldata); 
}
}

if ($_GET["resformno"]) { //���X�t�H�[���̏ꍇ
	$resformno = $_GET["resformno"]; //GET�œn���ꂽ�ԍ��� $resformno �ɑ��
	$resline = file ("mission_2-5.txt");	//�f�[�^���J����
for ($i = 0; $i < count($resline); $i++) {
	$list = explode("<>", $resline[$i]);
if ($resformno == $list[0]) { //�������ԐM�Ώۂ̐e�L��
	$retitle = $list[5]; //�ԐM�^�C�g����ݒ�
if ($list[0] == $list[1]) { //�e�L���Ȃ�
	print $list[5] . " ";;
	print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>�@";
}
print $list[7] . "�@[" . $list[0] . "]<br>";
print $list[6];
print "<hr>"; //�L���̍Ō�ɐ���\��
}
else { 	//�ԐM�L���Ȃ�
print "<span style='margin-left:60px;'>" . $list[5] . " ";
print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>�@";
}
print $list[7] . "�@[" . $list[0] . "]</span><br>";
print "<div style='margin-left:60px;'>" . $list[6] . "</div>";
print "<hr style='margin-left:60px;'>"; //�L���̍Ō�ɐ���\��
}
if ($resformno != $list[1]) { 	//���̐e�L��
	break;
}
}
}
print "<br>"; 	//���s
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
<td class="gray">comment�@</td>
<td><textarea name="comment" rows="6" cols="66"></textarea></td>
</tr>
</table>
<input type="submit" value="send">
</form>



<?php
}
elseif (isset($_POST["edit"])) { //�C���t�H�[���\��
	$edno = $_POST["edno"];	
if ($edno == $edno) { 
	$ediline = file("mission_2-5.txt");
for ($i = 0; $i < count($ediline); $i++) { 
	$edit = explode("<>", $ediline[$i]);
if ($edit[0] == $edno) { //�ҏW�Ώۍs��T��
	print "<div align='center'>\n";	//�ȉ��A�ҏW�Ώۍs���t�H�[�����ɕ\��
	print "<center>\n";
	print "No." . $edit[0] . "�@" . $edit[3] . " ����̏������݂��C���ł��܂��B<br>\n<br>\n";
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
	$edcomment = str_replace("<br>", "\n", $edit[6]);	//<br>��\n�ɕϊ�
	print "<textarea name='comment' rows='7' cols='68'>" . $edcomment . "</textarea><br>\n";
	print "<input style='cursor:hand;' type='submit' value='�C��' name='editaction'>\n<input type='hidden' name='editno' value='" . $edno . "'>\n<input type='hidden' name='reno' value='" . $edit[1] . "'>\n";
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
//�V�K���e�E���X���e���ʏ���
if( ($_POST["name"] != "") or ($_POST["comment"] != "") ) {
if ((!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["url"])) && (!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["comment"]))) { //URL���ƃR�����g����URL���Ȃ����
if(isset($_POST["name"])) { $name = $_POST["name"]; }	//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
$name = mb_strimwidth ($name, 0, 48, "�c", "UTF-8");	//�������O��48�o�C�g�{�c�ɂ���
if( get_magic_quotes_gpc() ) { $name = stripslashes("$name"); } //�N�H�[�g���G�X�P�[�v����
$name = htmlspecialchars ($name); //�^�O�֎~
if(isset($_POST["email"])) { $email = $_POST["email"]; }//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
$email = mb_strimwidth ($email, 0, 100, "", "UTF-8");	//�������[���A�h���X��100�o�C�g�ŃJ�b�g
if( get_magic_quotes_gpc() ) { $email = stripslashes("$email"); } //�N�H�[�g���G�X�P�[�v����
$email = htmlspecialchars ($email); 	//�^�O�֎~
if(isset($_POST["url"])) { $url = $_POST["url"]; }//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
$url = mb_strimwidth ($url, 0, 100, "", "UTF-8");//�������[���A�h���X��100�o�C�g�ŃJ�b�g
if( get_magic_quotes_gpc() ) { $url = stripslashes("$url"); } 	//�N�H�[�g���G�X�P�[�v����
$url = htmlspecialchars ($url); //�^�O�֎~
$hurl = "h" . $url; //�^�O�֎~
if(isset($_POST["title"])) { $title = $_POST["title"]; }//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
$title = mb_strimwidth ($title, 0, 100, "", "UTF-8");	//�������[���A�h���X��100�o�C�g�ŃJ�b�g
if( get_magic_quotes_gpc() ) { $title = stripslashes("$title"); } //�N�H�[�g���G�X�P�[�v����
$title = htmlspecialchars ($title); 	//�^�O�֎~
if(isset($_POST["comment"])) { $comment = $_POST["comment"]; }	//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
$comment = mb_strimwidth ($comment, 0, 10000, "�c", "UTF-8");	//�����R�����g��10000�o�C�g�{�c�ɂ���
$comment = str_replace("\r\n", "\r", $comment);	//Windows
$comment = str_replace("\r", "\n", $comment);	//Machintosh
if( get_magic_quotes_gpc() ) { $comment = stripslashes("$comment"); } 	//�N�H�[�g���G�X�P�[�v����
$comment = htmlspecialchars ($comment); //�^�O�֎~
$mcomment = $comment;	//���[���p
$comment = str_replace("\n", "<br>", $comment);	//\n��<br>�ɕϊ�
$time = date( Y . "/" . m . "/" . d . " " . H . ":" . i );
$ip = getenv("REMOTE_ADDR");//IP�A�h���X�擾
$host = gethostbyaddr(getenv("REMOTE_ADDR"));
$nip = ($host . "/" . $ip);
$data = file("mission_2-5.txt");//�t�@�C�����J����
$bno = 0;
foreach($data as $value) {
$list = explode("<>", $value);
if ($bno < $list[0]) {
$bno = $list[0];//�ő�̋L���mo��T����
}
}


$no = $bno + 1;	//�{�P�������̂�V���� NO �Ƃ���
foreach($data as $value) {
	$list = explode("<>", $value);
if ($bno == $list[0]) {
	$bname = $list[2];
	$bcomment = $list[6];
}
}
if (($bname != $name) or ($bcomment != $comment)) {
//���ʏ��������܂�
if (isset($_POST["bbsresno"])) {//���X���e�̏ꍇ
	$bbsresno = $_POST["bbsresno"];
	$reswrite = "$no<>$bbsresno<>$name<>$email<>$url<>$title<>$comment<>$time<>$nip<>\n"; //�ǉ�����P�s
	$insert = 0;	//$bbsresno �� $list[0] ������̍s�i�e�L���j��T��
for ($i = 0; $i < count($data); $i++) {	//��������
	$list = explode("<>", $data[$i]);
if ($insert == 0) {//�܂��e�L�����������Ă��Ȃ����
if ($bbsresno == $list[0]) {//�������e�L��
	$insert = 1;//�e�L������������
}
}
else {//���X�L���͔�΂���
if ($bbsresno != $list[1]) {	//���̐e�L���܂ł�����
	array_splice($data, $i, 0, $reswrite); 	//�V�����s�������ɑ}��
	$insert = 0;	//�}�����ς񂾈�
	break;
}
}
}
if ($insert == 1) {array_push($data, $reswrite);}//�}�����ς�ł��Ȃ��i���̐e�L�����Ȃ����ŉ��s�ł���Ƃ������Ɓj�̏ꍇ
$linecount = 0;	//�s���J�E���g
for ($i = 0; $i < count($data); $i++) {
	$list = explode("<>", $data[$i]); 
if ($bbsresno == $list[0])  {	//$bbsresno�𗊂�ɐe�L����T��
	$top = $i;//�ォ��̍s��
	$linecount++;//�s�����v���X
}
elseif ($bbsresno == $list[1]) {
	$linecount++;	//�s�����v���X
}
}
if (isset($linecount)) {
	$string = array_splice($data, $top, $linecount);//�ړ�����s���폜
	$newdata = array_merge($string, $data);	//�擪�ɑ���
}
$redata = fopen("mission_2-5.txt", "w");//�������݃��[�h�Ńt�@�C�����J��
flock($redata, LOCK_EX);//�t�@�C�����b�N
foreach($newdata as $value) {//�z�񏈗�����
	fputs($redata, $value);}//��������
	flock($redata, LOCK_UN);
	fclose($redata);

}//���X���e�̏ꍇ�A�����܂�
elseif (isset($_POST["editaction"])) {	//�ҏW�̏ꍇ
	$editno = $_POST["editno"];//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
	$reno = $_POST["reno"];	//POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�
	$edit = file("mission_2-5.txt");//�f�[�^���J����
for ($i = 0; $i < count($edit); $i++) { //�W�J����
	$ediline = explode("<>", $edit[$i]);
if ($ediline[0] == $editno) { 	//�u�������Ώۍs��T��
	$ediwrite = "$editno<>$reno<>$name<>$email<>$url<>$title<>$comment<>$time<>$ip<>\n"; //�u����������P�s
	array_splice($edit,$i,1,"$ediwrite");//�P�s�u������
}
}
$edi = fopen('mission_2-5.txt', 'w');//�������݃��[�h�Ńf�[�^���J��
flock($edi, LOCK_EX);
foreach($edit as $value) {
	fputs($edi, $value);//�P�s�u���������ď�������
}
flock($edi, LOCK_UN); 
fclose($edi);	//����
}

else {	//�V�K���e�̏ꍇ
	$topwrite = "$no<>$no<>$name<>$email<>$url<>$title<>$comment<>$time<>$nip<>\n"; //�ǉ�����P�s
	$data = file("mission_2-5.txt");//�f�[�^��ǂݍ���
	$nwrite = fopen("mission_2-5.txt","w"); //�ǉ��������݁@��ɂȂ�
	flock($nwrite, LOCK_EX);
	fputs($nwrite, $topwrite);//�擪�ɂP�s��������
for($i = 0; $i < count($data); $i++){
	fputs($nwrite, $data[$i]);//���܂ł̕�����������
}
flock($nwrite, LOCK_UN);
fclose ($nwrite);

$thread = 0;//�e�L���𐔂���
$data = file("mission_2-5.txt");
for ($i = 0; $i < count($data); $i++) {
	$list = explode("<>", $data[$i]); 
if ($list[0] == $list[1]) {//�e�L���Ȃ�
	$thread++;//�e�L���̐�
}
}

if ($thread >= 6){//�e�L����6�ȏ゠���
	$data = file("mission_2-5.txt");
	$delete = array_pop($data);//�Ō�̍s���폜
list($dno,$dresno,$dname,$demail,$durl,$dtitle,$dcomment,$dtime,$dip) = explode("<>",$delete);	//�Ō�̍s�̓��e
}
for ($i = 0; $i < count($data); $i++) {
	$list = explode("<>", $data[$i]); 
if ($list[1] == $dresno) {//�폜�����s�̐e�L���܂��͕ԐM�L���������
	array_splice($data, $i);//�L���폜����
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
//�ŏ��̕\���E�V�K���e��̕\���E���X���e������̕\��
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
<td class="gray">comment�@</td>
<td><textarea name="comment" rows="6" cols="66"></textarea></td>
</tr>
</table>
<input type="submit" value="send">
</form>


<?php
if ($_GET["line"]) {$line = $_GET["line"];} //GET�œn���ꂽ�ԍ��� $line �ɑ��
else {$line = 0;} //GET���Ȃ���� $line �� 0
$pagethread = 10; //�P�y�[�W�ɕ\������X���b�h��
$log = file("mission_2-5.txt"); //���O�t�@�C�����J��
$data = fopen("mission_2-5.txt", "r"); //�f�[�^��ǂݍ���
$totalthread = 0; //�Ƃ肠�����X���b�h���� 0 ��
for ($i = 0; $i < count($log); $i++) { 	//�e�L���̐��𐔂��邽�߂̑���
	$list = explode("<>", $log[$i]);
if ($list[0] == $list[1]) {$totalthread++;} //�e�L���̐��𐔂���
}
fclose($data);
$threadno = 0;
foreach ($log as $value) { //�܂�����
	$list = explode("<>", $value);
if ($list[0] == $list[1]) {$threadno++;} //�e�L���������� $threadno �𑝂₷
if ($threadno <= $line * $pagethread) { //$pagethread ���ǂ񂾂�
	continue; //�J��Ԃ��𔲂��Ď���
}
elseif ($threadno > ($line + 1) * $pagethread) { //�I���܂ł�����
	break; 	//�������I��
}

if ($list[0] == $list[1]) { //�i�\���j�e�L���Ȃ�
	print "<hr>"; 	//�ŏ��ɐ�����{�\��
	print $list[5] . " ";;
	print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>�@";
}
print $list[7] . "�@[" . $list[0] . "]�@<a href='mission_2-5.php?resformno=" . $list[0] . "'>Re:</a><br>";
print $list[6];
print "<hr>"; 	//�L���̍Ō�ɐ���\��
}
else { //�i�\���j�ԐM�L���Ȃ�
	print "<span style='margin-left:60px;'>" . $list[5] . " "; //�擪��60�s�N�Z���̋󂫂����
	print $list[2] . " ";
if ($list[4]){
	print "<a href='h" . $list[4] . "' target='_blank'>url</a>�@";
}
print $list[7] . "�@[" . $list[0] . "]</span><br>";
print "<div style='margin-left:60px;'>" . $list[6] . "</div>";
print "<hr style='margin-left:60px;'>"; //�L���̍Ō�ɐ���\��
}
}
if ($totalthread > $pagethread) { //�Q�y�[�W�ȏ�ɂȂ�Ȃ�
	$lines = ceil(($totalthread/$pagethread-1)); //���y�[�W�ɂȂ邩�v�Z����
	$now=1;
	$next=0;
for ($i = 0; $lines >= 0; $i++) { //�y�[�W�ԍ��\���̂��߂̑���
	$list = explode("<>", $log[$i]);
if ($line == $next) {
	print $now . "&nbsp;";} //�\�����̃y�[�W�̓����N�Ȃ�
else {
	print "<a href='mission_2-5.php?line=" . "$next" . "'>" . "$now" . "</a>&nbsp;";}//�A���J�[�^�O�� GET �œn��
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

Number <input size="4" name="edno">�@
�@<input type="submit" name="delete" value="Delete">
�@<input type="submit" name="edit" value="Edit">

</form>
<?php
}
?>
</body>
</html>
