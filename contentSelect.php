<!DOCTYPE html>


<?php
  $product = $_GET['product'];
  $url = 'buy_cardRead.php?product='.$product;
?>

<html lang="ja">

  <head>

    <meta charset="utf-8">

    <title>Prototype/購入確認</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/contentSelect.css">

  </head>

  <body>

    <div id="wrap">
      <h1>この商品を購入しますか？</h1>
      <div id="select">
      <div id="back">
        <a href="content.php">戻る</a>
      </div>
      <div id="buy">
        <a href= <?= $url ?>>購入</a>
      </div>
      </div>
    </div>

  </body>

</html>