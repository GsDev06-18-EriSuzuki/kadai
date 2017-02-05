<?php
//1. POSTデータ取得
$title=$_POST["title"];
$url=$_POST["url"];
$text=$_POST["text"];


//2. DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','suzuki1102');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}


//データ登録SQL作成 
$sql="INSERT INTO gs_bm_table ( id, title, url, text, date ) 
VALUES( NULL, :a1, :a2, :a3, sysdate() )"; 
 
$stmt = $pdo->prepare($sql); 
$stmt->bindValue(':a1', $title, PDO:: PARAM_STR);  $stmt->bindValue(':a2', $url, PDO:: PARAM_STR);  $stmt->bindValue(':a3', $text, PDO:: PARAM_STR); 
 
//SQL実行 
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit;

}
?>
