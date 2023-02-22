<?php
    function db_connect(){
        try{
            $pdo = new PDO(
                'mysql:host=localhost;dbname=vending;charset=utf8',
                'root',
                ''
            );
            return $pdo;
        }catch(PDOException $e){
            exit('接続失敗'.$e -> getMessage());
        }
    }

    /**
     * IDmからユーザ情報を取得します
     */
    function getUsers($IDm,$pdo){
        $user = $pdo->prepare("SELECT * From user Where IDm = :user_id");
        $user -> bindValue(':user_id', $IDm);
        $user -> execute();
        return $user -> fetch(PDO::FETCH_ASSOC); 
    }

    /**
     * 商品IDから商品情報を取得します。
     */ 
    function getProducts($productID,$pdo){
        $product = $pdo -> prepare("SELECT * From product Where product_ID = :product_id");
        $product -> bindValue(':product_id',$productID);
        $product -> execute();
        return $product -> fetch(PDO::FETCH_ASSOC);
    }

    /**
     * ユーザーが購入時にUserlogをアップロードをする処理をします
     */
    function uploadUserlog($user,$product,$command,$pdo){
        if($command === "purchase"){
            $update_userlog = $pdo -> prepare("INSERT into user_log (IDm,command,point_balance) value (:user_id,:command,:balance)");
            $update_userlog -> bindValue(':user_id',$user['IDm']);
            $update_userlog -> bindValue(':command',$command);
            $update_userlog -> bindValue(':balance',($user['balance'] - $product['price']),PDO::PARAM_INT);
            $update_userlog -> execute();
        }
        if($command === "charge"){
            $update_userlog = $pdo -> prepare("INSERT into user_log (IDm,command,point_balance) value (:user_id,:command,:balance)");
            $update_userlog -> bindValue(':user_id',$user['IDm']);
            $update_userlog -> bindValue(':command','charge');
            $update_userlog -> bindValue(':balance',($user['balance'] + $product),PDO::PARAM_INT);
            $update_userlog -> execute();
        }
    }

    function uploadPurchaselog($product,$pdo){
        $update_purchaselog = $pdo -> prepare("INSERT into purchase (product_ID,point_stock) value (:product_id,:stock)");
        $update_purchaselog -> bindValue(':product_id',$product['product_ID']);
        $update_purchaselog -> bindValue(':stock',($product['stock'] - 1));
        $update_purchaselog -> execute();
    }

    function uploadUser($user,$product,$pdo){
        $update_user = $pdo -> prepare("UPDATE user set balance = :balance Where IDm = :user_id");
        $update_user -> bindValue(':balance',($user['balance'] - $product['price']));
        $update_user -> bindValue(':user_id',$user['IDm']);
        $update_user -> execute();
    }

    function uploadUser_charge($user,$charge,$pdo){
        echo $charge;
        echo $user['balance']+$charge;
        $update_charege = $pdo -> prepare("UPDATE user set balance = :balance Where IDm = :user_id");
        $update_charege -> bindValue(':balance',$user['balance'] + $charge,PDO::PARAM_INT);
        $update_charege -> bindValue(':user_id',$user['IDm']);
        $update_charege -> execute();
    }

    function uploadStock($product,$pdo){
        $update_product = $pdo -> prepare("UPDATE product set stock = :stock Where product_ID = :product_id");
        $update_product -> bindValue(':stock',($product['stock'] - 1),PDO::PARAM_INT);
        $update_product -> bindValue(':product_id',$product['product_ID']);
        $update_product -> execute();
    }
?>