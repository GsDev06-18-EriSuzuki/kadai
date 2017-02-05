<?php
//1. POSTデータ取得
$id =$_POST["id"];
$title   = $_POST["title"];
$url  = $_POST["url"];
$text = $_POST["text"];

//2. DB接続します(エラー処理追加)
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','suzuki1102');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//基本的にinsert.phpの処理の流れです。

 //データ登録SQL作成 

//３．データ登録SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET title=:a1 , url=:a2, text=:a3 WHERE id=:id");
$stmt->bindValue(':a1', $title);
$stmt->bindValue(':a2', $url);
$stmt->bindValue(':a3', $text);
$stmt->bindValue(':id', $id);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: bm_list_view.php");
  exit;
}
?>