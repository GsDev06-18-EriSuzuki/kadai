<?php

//管理人かどうかチェック
session_start();
$kanri_flg=$_SESSION["kanri_flg"];
if($kanri_flg!=1){
  print 'ユーザー管理画面へのアクセス権限がありません<br>';
  print'<a href="login.php">ログイン画面へ</a>';
  exit();
}

//1.POSTでParamを取得
$id = $_GET["id"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','suzuki1102');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: user_list_view.php");
  exit;
}



?>
