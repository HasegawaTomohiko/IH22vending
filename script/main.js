  const url = 'https://api.open-meteo.com/v1/jma?latitude=35.678&longitude=139.682&hourly=temperature_2m,weathercode&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FTokyo';

  // fetch(url).then(data => data.json()).then(json => console.log(json));

  //  function jsonread(json){
  //   const hourtemp = data.hourly.temperature_2m;
  //   console.log(hourtemp);
  //  }

//時間ごとに変数いっぱい作る

  fetch(url)
  .then(response => response.json())
  .then(data => {
    // const hourlyTemp = data.hourly.temperature_2m; // hourly配列の中からtemperature_2mを取得
    // const dailyData = data.daily; // daily配列全体を取得
    
    // document.getElemenyId('hourtemp').appendChild(hourlyTemp);

    //いいやり方が分からないからクソ変数を量産している
    //デバッグ用
    const testtemp = data.hourly.temperature_2m;
    console.log(testtemp);

    const hourlyTemperature = data.hourly.temperature_2m[0];

    const temp6 = data.hourly.temperature_2m[5];
    const temp9 = data.hourly.temperature_2m[8];
    const temp12 = data.hourly.temperature_2m[11];
    const temp15 = data.hourly.temperature_2m[14];
    const temp18 = data.hourly.temperature_2m[17];
    const temp21 = data.hourly.temperature_2m[20];
    const hourlyWeatherCode = data.hourly.weathercode;
    const dailyWeatherCode = data.daily.weathercode;
    
    const dailyMaxTemperature = data.daily.temperature_2m_max[0];
    const dailyMinTemperature = data.daily.temperature_2m_min[0];
    //console.log(hourlyTemp[0]);
    //console.log(dailyData);

    //weathercode
    const weathercode = data.hourly.weathercode;
    console.log(weathercode);

    console.log(hourlyTemperature);
    document.getElementById("hourtemp").innerHTML = hourlyTemperature + '°';

    document.getElementById("temp6").innerHTML = temp6 + '°';
    document.getElementById("temp9").innerHTML = temp9 + '°';
    document.getElementById("temp12").innerHTML = temp12 + '°';
    document.getElementById("temp15").innerHTML = temp15 + '°';
    document.getElementById("temp18").innerHTML = temp18 + '°';
    document.getElementById("temp21").innerHTML = temp21 + '°';

    //最高気温と最低気温
    document.getElementById("daymax").innerHTML = dailyMaxTemperature + '°';
    document.getElementById("daymin").innerHTML = dailyMinTemperature + '°';
    
    console.log(dailyMaxTemperature);
    console.log(dailyMinTemperature);
    console.log();
    console.log();
  });

  //現在の天気を標示するための関数



// weathercode仕分け switch文
// switch文でweatherCodeを判別し、それに対応するテキストを表示する
//https://fonts.google.com/icons?icon.query=weather
switch(weatherCode) {
  case 0:
  case 1:
  case 2:
  case 3:
    console.log("Mainly clear, partly cloudy, and overcast");//晴れ
    break;
  case 45:
  case 48:
    console.log("Fog and depositing rime fog");
    break;
  case 51:
  case 53:
  case 55:
    console.log("Drizzle: Light, moderate, and dense intensity");
    break;
  case 56:
  case 57:
    console.log("Freezing Drizzle: Light and dense intensity");
    break;
  case 61:
  case 63:
  case 65:
  case 66:
  case 67:
    console.log("Freezing Rain: Light and heavy intensity");//雨
    break;
  case 71:
  case 73:
  case 75:
    console.log("Snow fall: Slight, moderate, and heavy intensity");
    break;
  case 77:
    console.log("Snow grains");
    break;
  case 80:
  case 81:
  case 82:
    console.log("Rain showers: Slight, moderate, and violent");
    break;
  case 85:
  case 86:
    console.log("Snow showers: slight and heavy");
    break;
  case 95:
    console.log("Thunderstorm: Slight or moderate");
    break;
  case 96:
  case 99:
    console.log("Thunderstorm with slight and heavy hail");
    break;
  default:
    console.log("Invalid weather code");
}

