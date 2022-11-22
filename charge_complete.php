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
    location.assign("content.html");
}
</script>







  </body>

</html>