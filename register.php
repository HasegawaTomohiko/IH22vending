<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
  <?php

    include_once('common.php');

    $idm = $_POST['IDm'];
    $user = $_POST['user_name'];

    $pdo = db_connect();

    $check_IDm = $pdo -> prepare("select * from user Where IDm = :user_idm");
    $check_IDm -> bindValue(':user_idm',$idm);
    $check_IDm -> execute();

    $sll = $check_IDm -> fetch(PDO::FETCH_ASSOC);

    var_dump($sll);

    if($sll === false){
      $insert_card = $pdo -> prepare("insert into user (IDm,user_name) value (:user_idm,:user_name)");
      $insert_card -> bindValue(':user_idm',$idm);
      $insert_card -> bindValue(':user_name',$user);
      $insert_card -> execute();
      ?>
      <h2>登録が完了しました</h2>
      <?php
    }else{
      ?>
      <h2>このカードはすでに登録されています</h2>
      <?php
    }
  ?>
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

