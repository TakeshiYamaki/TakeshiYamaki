<?php
//DB��Mysql�A�f�[�^�x�[�X���Etest���w��B
$dsn = '�f�[�^�x�[�X��';

//DB�ɐڑ����邽�߂̃��[�U�[���E�p�X���[�h��ݒ�
$user = '���[�U�[��';
$password = '�p�X���[�h';


try{
//�f�[�^�[�x�[�X�ɐڑ�
    $pdo = new PDO($dsn, $user, $password);

    //�����ɏ������L��

    //�ڑ��I��
    $pdo = print('�ڑ������I');
}

//�ڑ��Ɏ��s�����ۂ̃G���[����
catch (PDOException $e){
    print('�G���[���������܂����B:'.$e->getMessage());
    die();
}
?>