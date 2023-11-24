//Fonction pour obtenir la position du client
function getPosition() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showWeather)
    } else {
        console.error("La géolocalisation n'est pas supportée par ce navigateur.")
    }
}

//Fonction pour afficher la météo en fonction des coordonnées
function showWeather(position) {
    const latitude = position.coords.latitude
    const longitude = position.coords.longitude
    const apiKey = 'b309a6812a42f59e111950efa2e4bc0e' //Remplace avec ta clé API OpenWeatherMap

    // Construction de l'URL de requête avec les coordonnées
    const weatherApiUrl = `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${apiKey}&lang=fr`

    fetch(weatherApiUrl)
        .then(response => response.json())
        .then(data => {
            //Récupération des informations météorologiques

            const temperatureKelvin = data.main.temp
            const temperatureCelsius = Math.round(temperatureKelvin - 273.15)

            document.getElementById('temperature').innerText = `Température: ${temperatureCelsius.toFixed(2)} °C`

            const location = data.name
            const temperature = temperatureCelsius
            const description = data.weather[0].description

            // Affichage sur le site
            document.getElementById('location').innerText = `Lieu: ${location}`
            document.getElementById('temperature').innerText = `Température: ${temperature} °C`
            document.getElementById('description').innerText = `Description: ${description}`
        })
        .catch(error => console.error('Erreur lors de la requête:', error))
}

getPosition()