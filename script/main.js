
  const url = 'https://api.open-meteo.com/v1/forecast?latitude=35.18&longitude=136.91&hourly=temperature_2m,precipitation,weathercode&timezone=Asia%2FTokyo';


  fetch(url).then(data => data.json()).then(json => console.log(json));