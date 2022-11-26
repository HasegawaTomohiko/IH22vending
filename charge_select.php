<!DOCTYPE html>

<html lang="ja">

  <head>

    <meta charset="utf-8">

    <title>Prototype/チャージ金額選択</title>

    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link rel="stylesheet" href="css/charge.css">

  </head>

  <body>

    <div id="wrap">
      <div id="ti">チャージ金額を選択してください</div>
      <form method="get" action="charge_cardRead.php">
        <div id="mo">
          <label>
            <input type="radio" name="charge" id="s1000" value="1000">
            1000円
          </label>
          <label>
            <input type="radio" name="charge" id="s2000" value="2000">
            2000円
          </label>
          <label>
            <input type="radio" name="charge" id="s3000" value="3000">
            3000円
          </label>
          <label>
            <input type="radio" name="charge" id="s5000" value="5000">
            5000円
          </label>
          <label>
            <input type="radio" name="charge" id="s10000" value="10000">
            10000円
          </label>
        </div>

        <!-- <div id="select">
          <a href="content.php">戻る</a>
          <a href="charge_cardRead.php">選択</a>
        </div> -->

        <!-- formでinputのsubmitで送信出来るようにする。 -->
        <div>
        <input id="button" type="submit" value="選択" />
        <a href="content.php">戻る</a>
        </div>
        <!-- <input type="submit" value="戻る" /> -->
      </form>
    </div>

  </body>

</html>