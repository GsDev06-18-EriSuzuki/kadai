<?php
//ログインチェック
session_start();
if(isset($_SESSION["chk_ssid"])==""){
  header("Location:login.php");
  exit();
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>本をブックマーク</title>
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
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>本をブックマーク</legend>
     <label>書籍名：<input type="text" name="title"></label><br>
     <label>書籍URL：<input type="text" name="url"></label><br>
     <label><textArea name="text" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
