<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="user_list_view.php">ユーザー一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="user_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録する</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>
     <label>管理者フラグ：
         <input type="radio" name="kanri_flg" value="0">一般者
         <input type="radio" name="kanri_flg" value="1">管理者</label><br>
     <label>利用フラグ：
         <input type="radio" name="life_flg" value="0">使用中
         <input type="radio" name="life_flg" value="1">使用しなくなった
    </label><br>
     <input type="submit" value="送信">



    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
