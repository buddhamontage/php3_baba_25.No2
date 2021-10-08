<?php
//1.POSTでid,name,email,naiyouを取得
$id = $_POST["id"];
$u_name = $_POST["u_name"];
$u_id = $_POST["u_id"];
$u_pw = $_POST["u_pw"];


//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=user_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE user_table SET u_name=:u_name,u_id=:u_id,u_pw=:u_pw WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':u_name',  $u_name,  PDO::PARAM_STR);
$stmt->bindValue(':u_id',  $u_id,  PDO::PARAM_STR);
$stmt->bindValue(':u_pw',  $u_pw,  PDO::PARAM_STR);
$stmt->bindValue(':id',  $id,  PDO::PARAM_INT);    //更新したいidを渡す
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  //select.phpへリダイレクト
  header("Location: select.php");
  exit;

}



?>
