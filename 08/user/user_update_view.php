<?php
$id = $_GET["id"];

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','suzuki1102');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
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
  <title>ユーザー更新画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー管理画面</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー情報を更新</legend>
     <label>名前：<input type="text" name="name" value="<?= $res["name"]?>"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$res["lid"]?>"></label><br>
     <label>PW：<input type="text" name="lpw" value="<?=$res["lpw"]?>"></label><br>

<!-- radioの値を受け取って、0なら一般、1なら管理者、と表示する方法が分からない、、、、、 -->
     <label>管理者フラグ：
         <input type="radio" name="kanri_flg" value="0">一般者
         <input type="radio" name="kanri_flg" value="1">管理者</label><br>
     <label>利用フラグ：
         <input type="radio" name="life_flg" value="0">使用中
         <input type="radio" name="life_flg" value="1">使用しなくなった
    </label><br>

     <input type="hidden" name="id" value="<?=$id?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>




