<?php

if (isset($_POST["delno"])) { //�폜�i���o�[�������Ă����ꍇ
	$delno = $_POST["delno"]; //POST�̒l���󂯎���ĕϐ��Ɋ��蓖�Ă�


if ($delno == $delno) { //�p�X���[�h�����������
	$del = file("mission_2-4.txt"); //���O�t�@�C�����J����
for ($i = 0; $i < count($del); $i++) { //�P�s�Â������Ȃ���W�J����
	$delline = explode("<>", $del[$i]);
if ($delline[0] == $delno) { //$delno�𗊂�ɑΏۍs��T��
	array_splice($del, $i, 1); //�Ώۍs������������P�s�폜�i���O�t�@�C����͂܂��폜����Ȃ��j
}
}


$dellog = fopen("mission_2-4.txt", "w"); //�������݃��[�h�Ńf�[�^���J���i��ɂȂ�܂��j
flock($dellog, LOCK_EX); //�t�@�C�����b�N
foreach($del as $value) { //��i$del�j�ŏ����i�P�s�폜�j�����f�[�^��z��ɓ����
fputs($dellog, $value); //��������
}
flock($dellog, LOCK_UN); 
fclose($dellog); 
}
}






if (isset($_GET["line"])) {$line = $_GET["line"];} //GET�œn���ꂽ�ԍ��� $line �ɑ��
if (($_POST["name"] != "") or ($_POST["comment"] != "")) { //����POST�� [name] �� [comment] �������
if ((!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["url"])) && (!preg_match ("{(https?)(://[[:alnum:]\+\$\;\?\.%,!#~*/:@&=_-]+)}", $_POST["comment"]))) { //URL���ƃR�����g����URL���Ȃ����
$data = fopen ("mission_2-4.txt","r"); //�t�@�C����ǂ݂��ݐ�p�ŃI�[�v��
$bdata = fgets ($data); //�P�s�ǂݍ���
list($bno,$bname,$bemail,$burl,$btitle,$bcomment,$btime,$biphost) = explode("<>",$bdata); //�ϐ��ɕϊ�
fclose($data);
$no = $bno; //$bno�i�ǂݍ��񂾈�ԏ�̍s�̐��l�j�� $no �Ɋi�[<br>
$no++; 	//�{�P�������̂�����̋L���i���o�[�Ƃ���
if (isset($_POST["name"])) { //����POST�� [name] �������
$name = $_POST["name"]; //POST�̃f�[�^��ϐ�$name�Ɋi�[
if( get_magic_quotes_gpc() ) { $name = stripslashes("$name"); } //�N�H�[�g���G�X�P�[�v����
$name = htmlspecialchars ($name); //HTML�^�O�֎~
$name = mb_strimwidth ($name, 0, 14, "", "UTF-8"); //�����f�[�^��14�o�C�g�ŃJ�b�g
}

if (isset($_POST["comment"])) { //����POST�� [comment] �������
$comment = $_POST["comment"]; //POST�̃f�[�^��ϐ�$comment�Ɋi�[
if( get_magic_quotes_gpc() ) { $comment = stripslashes("$comment"); } 	//�N�H�[�g���G�X�P�[�v����
$comment = htmlspecialchars ($comment); //HTML�^�O�֎~
$comment = mb_strimwidth ($comment, 0, 10000, "", "UTF-8"); //�����f�[�^��10000�o�C�g�ŃJ�b�g
$comment = str_replace("\r\n", "\r", $comment); //Windows�̉��s�R�[�h��u������
$comment = str_replace("\r", "\n", $comment); 	//Machintosh�̉��s�R�[�h��u������
$mbcomment = $comment; 	//���[���p�Ɂi$mbcomment�j�Ƃ��Ċm��
$comment = str_replace("\n", "<br>", $comment); //\n��<br>�ɕϊ��i�ۑ��E�\���p�j
}
if (($bname != $name) or ($bcomment != $comment)){ //name �� comment ������Ă�����
$time = date("Y/n/j G:i"); //�����̎擾
$ip = getenv("REMOTE_ADDR"); //IP�A�h���X�擾
$host = gethostbyaddr(getenv("REMOTE_ADDR")); //HOST�擾
$iphost = ($host . "/" . $ip);

$topwrite = "$no<>$name<>$email<>$url<>$title<>$comment<>$time<>$iphost<>\n";//�V�����ǉ�����f�[�^�� <> �ŋ�؂��Đ��`
$log = file("mission_2-4.txt"); //�t�@�C���P�s�Âz��ɓ���Ȃ���ǂݍ���
$write = fopen("mission_2-4.txt","w"); //�������ݗp���[�h�Ńf�[�^���J���i�f�[�^�͋�ɂȂ�j
flock($write, LOCK_EX); //�t�@�C�����b�N�J�n
fputs($write, $topwrite); //�擪�ɂP�s��������
for($i = 0; $i < 999; $i++){ //999�s�܂ő�������������
fputs($write, $log[$i]); //���܂ł̕�����������
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
<td>comment�@</td>
<td><textarea name="comment" rows="6" cols="66"></textarea></td>
</tr>

</table>
<input type="submit" value="send">
</form>



<?php
$log = file("mission_2-4.txt"); //���O�t�@�C����ǂݍ��݂܂�
if (!$line) {
	$line = 0; //�ŏ��̃y�[�W�� 0
}

$pageline = 10; //�P�y�[�W�ɕ\��������s��
print "<hr>"; 	//�ŏ��ɐ�����{�\��
for ($i = $line; $i < $line+$pageline; $i++) { 	//�P�s�Â������Ȃ���P�y�[�W����\��
	$list = explode("<>",$log[$i]);
if($list[0] != ""){
	print $list[4] . " ";;
	print $list[1] . " ";
if ($list[3]){ 	//url�ɓ��͂��������ꍇ
	print "<a href='" . $list[3] . "' target='_blank'>url</a>�@";
}
print $list[6] . "�@[" . $list[0] . "]<br>";
print $list[5];
print "<hr>"; 	//�L���̍Ō�ɐ���\��
}
}

?>


<form action="mission_2-4.php" method="POST">
Delete Number <input size="10" name="delno">�@
�@
<input type="submit" value="Delete">

</form>
</body>
</html>
