<?php
//DBにMysql、データベース名・testを指定。
$dsn = 'データベース名';

//DBに接続するためのユーザー名・パスワードを設定
$user = 'ユーザー名';
$password = 'パスワード';


try{
//データーベースに接続
    $pdo = new PDO($dsn, $user, $password);

    //ここに処理を記載

    //接続終了
    $pdo = print('接続完了！');
}

//接続に失敗した際のエラー処理
catch (PDOException $e){
    print('エラーが発生しました。:'.$e->getMessage());
    die();
}
?>