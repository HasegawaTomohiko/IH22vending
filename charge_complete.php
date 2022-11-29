<?php

include_once('common.php');

//宮　->  受け取ったデータをデータベースにアップロード
//C #include
//java import
$idm= $_POST['IDm'];
$charge= $_POST['charge'];


/* 
print($idm);
print($charge); 
insert into テーブル名 (カラム１,カラム２...) value (１の値,２の値...);
update テーブル名 set カラム１ = １の値 , ... Where 対応する値とか;

*/

$pdo = db_connect();

$check_user = $pdo -> prepare("select * from user Where IDm = :user_id");
$check_user -> bindValue(':user_id',$idm);
$check_user -> execute();
$user = $check_user -> fetch(PDO::FETCH_ASSOC);

$charged_balance = $user['balance'] + $charge;

$insert_userlog = $pdo -> prepare("insert into user_log (IDm,command,point_balance) value (:user_id,:command,:balance)");
$insert_userlog -> bindValue(':user_id',$idm);
$insert_userlog -> bindValue(':command','charge');
$insert_userlog -> bindValue(':balance',$charged_balance);
$insert_userlog -> execute();

$update_charege = $pdo -> prepare("update user set balance = :balance Where IDm = :user_id");
$update_charege -> bindValue(':balance',$charged_balance);
$update_charege -> bindValue(':user_id',$idm);
$update_charege -> execute();



?>


<!DOCTYPE html>

<html lang="ja">

  <head>

    <meta charset="utf-8">

    <title>Prototype/チャージ完了</title>

<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/charge_complete.css">

  </head>

  <body>
<div>
    チャージが完了しました。<br><br>
</div>


<script type="text/javascript">
// setTimeout(jumpabe,10000);

let objCountDown=document.getElementById("divCountDown");
let nCnt=10;
setInterval(CountDown,1000);
function CountDown(){
   nCnt--;
   if(nCnt<=0){
        setTimeout(jumpabe,1000);
   }
}

function jumpabe(){
    location.assign("content.php");
}
</script>







  </body>

</html>