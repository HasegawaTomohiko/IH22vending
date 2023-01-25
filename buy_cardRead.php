<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Vending/card read</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/css/uikit.min.css" /> 
  </head>
  <body>
    <div class="uk-container">
      <button id="start" class="uk-button uk-button-large uk-button-default uk-width-1-1 uk-text-capitalize">FeliCaリーダーに接続</button>
      <div id="waiting" class="uk-margin" style="display: none;">
        <button class="uk-button uk-button-large uk-button-default uk-width-1-1" disabled>
          <span uk-spinner="" class="uk-spinner uk-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" ratio="1">
              <circle fill="none" stroke="#000" cx="15" cy="15" r="14"></circle>
            </svg>
          </span>
          FeliCaリーダーにカードをかざしてください
        </button>
      </div>
      <div id="idm" class="uk-alert uk-alert-success uk-text-center" uk-alert style="display: none;"></div>
    </div>
    <script>
let startButton = document.getElementById('start');
let idmMessage = document.getElementById('idm');
let waitingMessage = document.getElementById('waiting');

//このこ
let url = new URL(window.location.href);
let params = url.searchParams;
let product = params.get('product');
//このこ

async function sleep(msec) {
  return new Promise(resolve => setTimeout(resolve, msec));
}

async function send(device, data) {
  let uint8a = new Uint8Array(data);
  console.log(">>>>>>>>>>");
  console.log(uint8a);
  await device.transferOut(2, uint8a);
  await sleep(10);
}

async function receive(device, len) {
  console.log("<<<<<<<<<<" + len);
  let data = await device.transferIn(1, len);
  console.log(data);
  await sleep(10);
  let arr = [];
  for (let i = data.data.byteOffset; i < data.data.byteLength; i++) {
    arr.push(data.data.getUint8(i));
  }
  console.log(arr);
  return arr;
}

async function session(device) {
  await send(device, [0x00, 0x00, 0xff, 0x00, 0xff, 0x00]);
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x03, 0x00, 0xfd, 0xd6, 0x2a, 0x01, 0xff, 0x00]);
  await receive(device, 6);
  await receive(device, 13);
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x03, 0x00, 0xfd, 0xd6, 0x06, 0x00, 0x24, 0x00]);
  await receive(device, 6);
  await receive(device, 13);
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x03, 0x00, 0xfd, 0xd6, 0x06, 0x00, 0x24, 0x00]);
  await receive(device, 6);
  await receive(device, 13);
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x06, 0x00, 0xfa, 0xd6, 0x00, 0x01, 0x01, 0x0f, 0x01, 0x18, 0x00]);
  await receive(device, 6);
  await receive(device, 13);
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x28, 0x00, 0xd8, 0xd6, 0x02, 0x00, 0x18, 0x01, 0x01, 0x02, 0x01, 0x03, 0x00, 0x04, 0x00, 0x05, 0x00, 0x06, 0x00, 0x07, 0x08, 0x08, 0x00, 0x09, 0x00, 0x0a, 0x00, 0x0b, 0x00, 0x0c, 0x00, 0x0e, 0x04, 0x0f, 0x00, 0x10, 0x00, 0x11, 0x00, 0x12, 0x00, 0x13, 0x06, 0x4b, 0x00]);

  await receive(device, 6);
  // Level 9:nfc.clf.transport:<<< 0000ffffff0300fdd703002600
  await receive(device, 13);

  // Level 9:nfc.clf.rcs380:InSetProtocol 0018
  // Level 9:nfc.clf.transport:>>> 0000ffffff0400fcd60200181000
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x04, 0x00, 0xfc, 0xd6, 0x02, 0x00, 0x18, 0x10, 0x00]);
  // Level 9:nfc.clf.transport:<<< 0000ff00ff00
  await receive(device, 6);
  // Level 9:nfc.clf.transport:<<< 0000ffffff0300fdd703002600
  await receive(device, 13);
  // DEBUG:nfc.clf.rcs380:send SENSF_REQ 00ffff0100

  // Level 9:nfc.clf.rcs380:InCommRF 6e000600ffff0100
  // Level 9:nfc.clf.transport:>>> 0000ffffff0a00f6d6046e000600ffff0100b300
  await send(device, [0x00, 0x00, 0xff, 0xff, 0xff, 0x0a, 0x00, 0xf6, 0xd6, 0x04, 0x6e, 0x00, 0x06, 0x00, 0xff, 0xff, 0x01, 0x00, 0xb3, 0x00]);
  // Level 9:nfc.clf.transport:<<< 0000ff00ff00
  await receive(device, 6);
  // Level 9:nfc.clf.transport:<<< 0000ffffff1b00e5d70500000000081401000000000000000000000000000000000000f700
  let idm = (await receive(device, 37)).slice(17, 24);
  if (idm.length > 0) {
    let idmStr = '';
    for (let i = 0; i < idm.length; i++) {
      if (idm[i] < 16) {
        idmStr += '0';
      }
      idmStr += idm[i].toString(16);
    }

    /* ここからフォームを無理やり作成してpurchase.phpに無理やり突っ込んでまそ。 */
    const form = document.createElement('form');
    form.method = 'post';
    form.action = 'buy.php';
    const idm_field = document.createElement('input');
    idm_field.type = 'hidden';
    idm_field.name = 'IDm';
    idm_field.value = idmStr;
    const productid_field = document.createElement('input');
    productid_field.type = 'hidden';
    productid_field.name = 'productID';
    productid_field.value = product;

    form.appendChild(idm_field);
    form.appendChild(productid_field);
    document.body.appendChild(form);
    form.submit();
    /* ここまで */

    console.log(idmStr);
    idmMessage.innerText = "カードのIDm: " + idmStr;
    idmMessage.style.display = 'block';
    waitingMessage.style.display = 'none';
    //phpで読み込んだidmStrをpost送信させる。

    /* let id = new FormData();
    id.append('IDm',idmStr);
    id.append('productID',product);
    let alll = new XMLHttpRequest();
    alll.open('POST','purchase.php');
    alll.send(id); */

    } else {
      idmMessage.style.display = 'none';
      waitingMessage.style.display = 'block';
  }
}

startButton.addEventListener('click', async () => {
  let device;
  try {
    device = await navigator.usb.requestDevice({ filters: []});
    console.log("open");
    await device.open();
  } catch (e) {
    console.log(e);
    alert(e);
    throw e;
  }
  try {
    console.log("selectConfiguration");
    await device.selectConfiguration(1);
    console.log("claimInterface");
    await device.claimInterface(0);
    console.log(device);
    startButton.style.display = 'none';
    waitingMessage.style.display = 'block';
    do {
      await session(device);
      await sleep(500);
    } while (true);
  } catch (e) {
    console.log(e);
    alert(e);
    try {
      device.close();
    } catch (e) {
      console.log(e);
    }
    throw e;
  }
});
    </script>

  </body>
</html>