<?php
//ログインチェック
session_start();
if(isset($_SESSION["chk_ssid"])==""){
  header("Location:login.php");
  exit();
}

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','suzuki1102');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr><td>";
    $view .=$result["date"];
    $view .= "</td><td>";
    $view .=$result["title"];
    $view .= "</td><td>";
    $view .=$result["url"];
    $view .= "</td><td>";
    $view .=$result["text"];
    $view .= "</td><td>";
    $view .= '<a href="bm_update_view.php?id='.$result["id"].'">';
    $view .= "[編集]";
    $view .= "</a>";
    $view .= "　";
    $view .= '<a href="bm_delete.php?id='.$result["id"].'">';
    $view .= "[削除]";
    $view .= "</a>";
    $view .= "</td></tr>";
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク選択画面</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
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
<div>
    <div class="container jumbotron">
    <table>
      <tr>
        <th>登録日時</th>
        <th>書籍名</th>
        <th>書籍URL</th>
        <th>コメント</th>
        <th>編集</th>
      </tr>
      <?=$view?>
    </table>
    </div>
  </div>
</div>




<!-- Main[End] -->

</body>
</html>

