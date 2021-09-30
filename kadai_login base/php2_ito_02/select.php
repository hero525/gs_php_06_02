<?php

require_once('funcs.php');


try {
  $pdo = new PDO('mysql:dbname=gs_hero_login;charset=utf8;port=8889;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();


$view="";
if ($status == false) {

  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  //「.」＝は追加で処理してくれる意味
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= h($result['date']) . '/' . h($result['name']) . '/' . h($result['email']) . '/' . h($result['password']) . '/'. h($result['comment']);
    $view .= "</p>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Complete</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/style.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">User admin</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>
