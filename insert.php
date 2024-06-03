<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$name     = $_POST["name"];
$title    = $_POST["title"];
$genre    = $_POST["genre"];
$date     = $_POST["date"];
$age      = $_POST["age"];
$rating   = $_POST["rating"];
$comments = $_POST["comments"];

//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=bookmark_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB_CONNECT:'.$e->getMessage());
}




//３．データ登録SQL作成
$sql = "INSERT INTO bookmark_an_table(name,title,genre,date,age,rating,comments)VALUES(:name,:title,:genre,:date,:age,:rating,:comments)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',     $name,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title',    $title,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':genre',    $genre,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':date',     $date,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':age',      $age,      PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rating',   $rating,   PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comments', $comments, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
