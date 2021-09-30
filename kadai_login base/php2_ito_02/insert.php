<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$comment = $_POST['comment'];

try {
  $pdo = new PDO('mysql:dbname=gs_hero_login;charset=utf8;port=8889;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, name, email, password, comment, date)VALUES(NULL, :name, :email, :password, :comment, sysdate())");

$stmt->bindValue(':name', $name, PDO::PARAM_STR); 
$stmt->bindValue('email', $email, PDO::PARAM_STR);
$stmt->bindValue('password', $password, PDO::PARAM_STR);
$stmt->bindValue('comment', $comment, PDO::PARAM_STR);

$status = $stmt->execute();


if($status == false){
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
  header('Location: select.php');
}
?>
