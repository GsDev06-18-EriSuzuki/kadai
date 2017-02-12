<?php

//ログインチェック
session_start();
if(isset($_SESSION["chk_ssid"])==""){
  header("Location:login.php");
  exit();
}

$id = $_GET["id"];

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','suzuki1102');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT); //STR or INT
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  $res = $stmt->fetch(); //1レコード取得
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <?php if($_SESSION["kanri_flg"]==0) : ?>
        <a class="navbar-brand" href="bm_index.php">ブックマーク登録</a>
        <a class="navbar-brand" href="bm_list_view.php">ブックマーク表示</a>
        <a class="navbar-brand logout" href="logout.php">logout</a>
      <?php elseif($_SESSION["kanri_flg"]==1) : ?>
        <a class="navbar-brand" href="bm_index.php">ブックマーク登録</a>
        <a class="navbar-brand" href="bm_list_view.php">ブックマーク表示</a>
        <a class="navbar-brand" href="user_index.php">ユーザー登録</a>
        <a class="navbar-brand" href="user_list_view.php">ユーザー表示</a>
        <a class="navbar-brand logout" href="logout.php">logout</a>
      <?php else : ?>
      <?php endif ; ?>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="jumbotron">
<form method="post" action="bm_update.php">

   <fieldset>
    <legend>ブックマークを更新</legend>
     <label>書籍名：
     <input type="text" name="title" value="<?= $res["title"]?>"></label><br>
     <label>書籍URL：<input type="text" name="url" value="<?=$res["url"]?>"></label><br>
     <label><textArea name="text" rows="4" cols="40"><?=$res["text"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="送信">
    </fieldset>

</form>

</div>
<!-- Main[End] -->


</body>
</html>




