  const url = 'https://api.open-meteo.com/v1/jma?latitude=35.678&longitude=139.682&hourly=temperature_2m,weathercode&daily=weathercode,temperature_2m_max,temperature_2m_min&timezone=Asia%2FTokyo';

  fetch(url).then(data => data.json()).then(json => console.log(json));