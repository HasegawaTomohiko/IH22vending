<?php

include_once('common.php');

$IDm = $_POST['IDm'];
$productID = $_POST['productID'];

$pdo = db_connect();

$check_user = $pdo->prepare("Select * From user Where IDm = :user_id");
$check_user -> bindValue(':user_id', $IDm);
$check_user -> execute();
$user = $check_user -> fetch(PDO::FETCH_ASSOC); //id,name,balance(残高)

$check_product = $pdo -> prepare("Select * From product Where product_ID = :product_id");
$check_product -> bindValue(':product_id',$productID);
$check_product -> execute();
$product = $check_product -> fetch(PDO::FETCH_ASSOC); //id,name,price,stock

if($user['balance'] <= $product['price']){
    echo "購入できませんでした";
}

$update_userlog = $pdo -> prepare("insert into user_log (IDm,command,point_balance) value (:user_id,:command,:balance)");
$update_userlog -> bindValue(':user_id',$user['IDm']);
$update_userlog -> bindValue(':command','purchase');
$update_userlog -> bindValue(':balance',$user['balance'] - $product['price']);
$update_userlog -> execute();

$update_purchaselog = $pdo -> prepare("insert into purchase (product_ID,point_stock) value (:product_id,:stock)");
$update_purchaselog -> bindValue(':product_id',$product['product_ID']);
$update_purchaselog -> bindValue(':stock',$product['stock'] - 1);
$update_purchaselog -> execute();

$update_user = $pdo -> prepare("update user set balance = :balance Where IDm = :user_id");
$update_user -> bindValue(':balance',$user['balance'] - $product['price']);
$update_user -> bindValue(':user_id',$user['IDm']);
$update_user -> execute();

$stock = $product['stock'] - 1;

$update_product = $pdo -> prepare("update product set stock = :stock Where product_ID = :product_id");
$update_product -> bindValue(':stock',$stock);
$update_product -> bindValue(':product_id',$product['product_ID']);
$update_product -> execute();

?>

<!DOCTYPE html>

<html lang="ja">

  <head>

    <meta charset="utf-8">

    <title>Prototype/購入完了</title>

<link rel="stylesheet" type="text/css" href="css/reset.css">
<link rel="stylesheet" type="text/css" href="css/common.css">
<link rel="stylesheet" type="text/css" href="css/purchase_complete.css">

  </head>

  <body>

<div id="wrap">
  購入完了しました。<br><br>
  取り出し口から商品をお取りください。
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

