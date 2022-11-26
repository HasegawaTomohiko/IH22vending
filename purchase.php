<?php
    include_once('common.php');

    $IDm = $_POST['IDm'];
    $productID = $_POST['productID'];

    $pdo = db_connect();

    $check_user = $pdo->prepare("Select * From user Where user_ID = :user_id");
    $check_user -> bindValue(':user_id', $IDm);
    $check_user -> execute();
    $user = $check_user -> fetchAll(); //id,name,balance(残高)

    $check_product = $pdo -> prepare("Select * From product Where product_ID = :product_id");
    $check_product -> bindValue(':product_id',$productID);
    $check_product -> execute();
    $product = $check_product -> fetchAll(); //id,name,price,stock

    var_dump($user);
    var_dump($product);

    if($user['balance'] <= $product['price']){
        echo "購入できませんでした";
        location('./content.php');
    }

    $update_userlog = $pdo -> prepare("insert into user_log (user_ID,command,point_balance) value (:user_id,:command,:balance)");
    $update_userlog -> bindValue(':user_id',$user['user_ID']);
    $update_userlog -> bindValue(':command','purchase');
    $update_userlog -> bindValue(':balance',$user['balance'] - $product['price']);
    $update_userlog -> execute();

    $update_purchaselog = $pdo -> prepare("insert into purchase_log (product_ID,point_stock) value (:product_id,:stock)");
    $update_purchaselog -> bindValue(':product_id',$product['product_ID']);
    $update_purchaselog -> bindValue(':stock',$product['stock'] - 1);
    $update_purchaselog -> execute();

    $update_user = $pdo -> prepare("update user set balance = :balance Where user_ID = :user_id");
    $update_user -> bindValue(':balance',$user['balance'] - $product['price']);
    $update_user -> bindValue(':user_id',$user['user_ID']);
    $update_user -> execute();

    $update_product = $pdo -> prepare("update product stock = :stock Where product_ID = :product_id");
    $update_product -> bindValue(':stock',$product['stock'] - 1);
    $update_product -> bindValue(':product_id',$product['product_ID']);
    $update_product -> execute();

    location('./buy.php');    

    //purchase_log ログをInsert
    //product stockをupdate 1 2147483647
?>