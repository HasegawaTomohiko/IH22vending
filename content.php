<?php
  include_once('common.php');
  /* ここで商品の在庫をSelectし、商品の↓の欄に表示するプログラムを作成したい。もし0だったら売り切れと表示させる */
  /* select 分を使って　在庫数を取得 PDOを使ってやれば行けるのでやってみましょう => 野本*/
  $pdo = db_connect();

  $content = $pdo -> prepare("SELECT price, stock FROM product");
  $content -> execute();
  $content_product = $content -> fetchAll(PDO::FETCH_ASSOC);

  print_r($content_product);
  print($content_product[0]['price']); //160

  /* 
  Array ( 
    [0] => Array ( コカ・コーラ
      [price] => 160 
      [stock] => 999999 
    ) 
    [1] => Array ( 三ツ矢サイダー
      [price] => 160 
      [stock] => 999999 
    ) 
    [2] => Array ( おーいお茶
      [price] => 120 
      [stock] => 999999 
    ) 
    [3] => Array ( ボスこーひー
      [price] => 110 
      [stock] => 999999 
    ) 
    [4] => Array ( いろはす
      [price] => 100 
      [stock] => 999999 
    ) 
    [5] => Array ( Zone
      [price] => 210 
      [stock] => 999999 
    ) 
  )
  */
?>


<!DOCTYPE html>

<html lang="ja">

  <head>

    <meta charset="utf-8">

    <title>Prototype/コンテンツ</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" type="text/css" href="css/content.css">

  </head>

  <body>

  <div id = "nav">
    <nav class="cp_sidebarmenu">
    <ul>
      <li><a href="#"><i class="fa fa-home fa-2x fa-fw"></i><span>Menu1</span></a></li>
      <li><a href="#"><i class="fa fa-file-text fa-2x fa-fw"></i><span>Menu2</span></a></li>
      <li><a href="#"><i class="fa fa-comment fa-2x fa-fw"></i><span>Menu3</span></a></li>
      <li><a href="#"><i class="fa fa-share-alt fa-2x fa-fw"></i><span>Menu4</span></a></li>
    </ul>

    <ul class="control">
      <li><a href="#"><i class="fa fa-cog fa-2x fa-fw"></i><span>Menu</span></a></li>
    </ul>
    </nav>
  </div>

  <div id="content">
    <ul>
      <li>
        <a href="contentSelect.php?product=1">
          <h2>Coka cola</h2>
          <img src="images/cokaCola.jpg" alt="Coka Cola">
        </a>
        <!-- phpでコカ・コーラの情報を記載。売り切れだったら売り切れって表示。 -->
        <?php 
        if( $content_product[0]['stock'] > 0 ) {
          print ($content_product[0]['price']);
        }else{
          print "売り切れ";
        }
        ?>
      </li>
      <li>
        <a href="contentSelect.php?product=2">
          <h2>三ツ矢サイダー</h2>
          <img src="images/mitsuyaSoda.jpg" alt="Mitsuya Soda">
        </a>
        <?php 
        if( $content_product[1]['stock'] > 0 ) {
          print ($content_product[1]['price']);
        }else{
          print "売り切れ";
        }
        ?>
      </li>
      <li>
        <a href="contentSelect.php?product=3">
          <h2>おーいお茶</h2>
          <img src="images/ocha.jpg" alt="Ooi ocha">
        </a>
        <?php 
        if( $content_product[2]['stock'] > 0 ) {
          print ($content_product[2]['price']);
        }else{
          print "売り切れ";
        }
        ?>
      </li>
      <li>
        <a href="contentSelect.php?product=4">
          <h2>Boss coffee Black</h2>
          <img src="images/coffee.jpg" alt="Boss coffee Black">
        </a>
        <?php 
        if( $content_product[3]['stock'] > 0 ) {
          print ($content_product[3]['price']);
        }else{
          print "売り切れ";
        }
        ?>
      </li>
      <li>
        <a href="contentSelect.php?product=5">
          <h2>いろはす</h2>
          <img src="images/irohasu.jpg" alt="Irohasu">
        </a>
        <?php 
        if( $content_product[4]['stock'] > 0 ) {
          print ($content_product[4]['price']);
        }else{
          print "売り切れ";
        }
        ?>
      </li>
      <li>
        <a href="contentSelect.php?product=6">
          <h2>Zone</h2>
          <img src="images/zone.jpg" alt="Zone">
        </a>
        <?php 
        if( $content_product[5]['stock'] > 0 ) {
          print ($content_product[5]['price']);
        }else{
          print "売り切れ";
        }
        ?>
      </li>
    </ul>
    </div>

    <div id="charge">
      <a href="charge_select.php">
        <h2>電子マネーチャージ</h2>
      </a>
    </div>

  </body>

</html>