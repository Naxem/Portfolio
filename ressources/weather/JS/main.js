// Fonction pour obtenir la position du client
function getPosition() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            const latitude = position.coords.latitude
            const longitude = position.coords.longitude

            // Utilise les valeurs de latitude et longitude comme nécessaire
            console.log("Latitude:", latitude)
            console.log("Longitude:", longitude)

            // Envoie les données au serveur en utilisant AJAX
            $.ajax({
                url: 'JS/proxy.php',
                type: 'GET',
                data: {
                    latitude: latitude,
                    longitude: longitude
                },
                success: function () {
                    showWeather()
                },
                error: function (error) {
                    console.error('Erreur lors de l\'envoi des données au serveur:', error)
                }
            });
        }, function (error) {
            console.error("Erreur lors de l'obtention de la position:", error.message)
        })
    }
}

// function Kalvine to celsius
function kalvinToCelsius(temperature) {
    return Math.round(temperature - 273.15)
}

// Fonction pour afficher la météo en fonction des coordonnées
function showWeather() {
    // Crée un nouvel objet Date
    const currentDate = new Date()
    // Récupère l'heure actuelle
    const currentHour = currentDate.getHours()

    function getApi() {
        $.ajax({
            url: 'JS/proxy.php', // L'URL de la requête AJAX
            type: 'GET',
            data: { action: '1' },
            success: function (response) {
                // Affichage des informations météorologiques actuelles
                const data = JSON.parse(response)
                const temperatureCelsius = kalvinToCelsius(data.main.temp)
                const temperatureKelvinMax = kalvinToCelsius(data.main.temp_max)
                const temperatureKelvinMin = kalvinToCelsius(data.main.temp_min)
                const location = data.name
                const temperature = temperatureCelsius
                const description = data.weather[0].description
                const locationInDocument = document.querySelectorAll('.location')
                const humidite = data.main.humidity
                const pressure = data.main.pressure
                const wind = data.wind.speed
                const windDeg = data.wind.deg

                locationInDocument.forEach(element => {
                    element.innerText = `Lieu: ${location}`
                })
                document.getElementById('temperature').innerText = `Température: ${temperature} °C`
                document.getElementById('description').innerText = `Description: ${description}`
                document.getElementById("temp-min").innerText = `Température min: ${temperatureKelvinMin} °C`
                document.getElementById("temp-max").innerText = `Température max: ${temperatureKelvinMax} °C`

                document.getElementById("pression").innerText = `Pression: ${pressure} mb`
                document.getElementById("humidite").innerText = `humidité: ${humidite} %`
                document.getElementById("wind").innerText = `Vitesse du vent: ${wind} km/h`
                document.getElementById("wind-deg").style.transform = `rotate(${windDeg}deg)`

                //Changer la classe quand il y a une alert pour agrandir le header est changer la couleur
                const alertsContainer = document.getElementById('alertsContainer')
                if (data.alerts && data.alerts.length > 0) {
                    alertsContainer.innerHTML = '<strong>Alertes météorologiques :</strong>'
                    data.alerts.forEach(alert => {
                        const alertItem = document.createElement('div')

                        alertItem.innerHTML = `<strong>${alert.event}:</strong> ${alert.description}`
                        alertsContainer.appendChild(alertItem)
                    })
                } else {
                    alertsContainer.innerHTML = '<strong>Pas d\'alertes météorologiques actuellement</strong>'
                }
            }, error: function (error) {
                console.error('Erreur lors de la requête AJAX:', error);
            }
        })

        $.ajax({
            url: 'JS/proxy.php',
            type: 'GET',
            data: { action: '2' },
            success: function (response) {
                // Affichage des prévisions sur 7 jours
                const data = JSON.parse(response)
                const dailyForecast = data.daily
                const forecastContainer = document.getElementById('forecastContainer')
                let d = false

                dailyForecast.forEach(day => {
                    const date = new Date(day.dt * 1000).toLocaleDateString('fr-FR', { weekday: 'long' })
                    const temperatureMax = Math.round(day.temp.max - 273.15)
                    const temperatureMin = Math.round(day.temp.min - 273.15)
                    const description = day.weather[0].description
                    const forecastItem = document.createElement('div')

                    if (!d) {
                        forecastItem.innerHTML = `<span>Aujourd'hui:  </span><span>${temperatureMin}°C  -  ${temperatureMax}°C</span>  -  <span>${description}</span>`
                        forecastContainer.appendChild(forecastItem)
                        d = true
                    } else {
                        forecastItem.innerHTML = `<span>${date}:  </span><span>${temperatureMin}°C  -  ${temperatureMax}°C</span>  -  <span>${description}</span>`
                        forecastContainer.appendChild(forecastItem)
                    }
                })
            }, error: function (error) {
                console.error('Erreur lors de la requête AJAX:', error);
            }
        })

        $.ajax({
            url: 'JS/proxy.php',
            type: 'GET',
            data: { action: '3' },
            success: function (response) {
                // Affichage des prévisions sur 24h
                const data = JSON.parse(response)
                const todayHourlyForecast = data.list.filter(item => {
                    const forecastDate = new Date(item.dt * 1000)
                    const today = new Date()

                    return forecastDate.getDate() === today.getDate()
                })

                const todayHourlyContainer = document.getElementById('todayHourlyContainer')

                if (currentHour >= "22") {
                    const hourlyItem = document.createElement('div')
                    hourlyItem.innerHTML = `Il n'y a plus de prévisualisation à partir de 22h`
                    todayHourlyContainer.appendChild(hourlyItem)
                } else {
                    todayHourlyForecast.forEach(hourData => {
                        const hour = new Date(hourData.dt * 1000).toLocaleTimeString('fr-FR', { hour: 'numeric', minute: 'numeric' })
                        const temperature = Math.round(hourData.main.temp - 273.15)
                        const description = hourData.weather[0].description
                        const hourlyItem = document.createElement('div')

                        hourlyItem.innerHTML = `<span>${hour}  -  </span><span>${temperature}°C  -  </span><span>${description}</span>`
                        todayHourlyContainer.appendChild(hourlyItem)
                    })
                }

                const tomorrowHourlyForecast = data.list.filter(item => {
                    const forecastDate = new Date(item.dt * 1000)
                    const tomorrow = new Date()

                    tomorrow.setDate(tomorrow.getDate() + 1)
                    return forecastDate.getDate() === tomorrow.getDate()
                })

                const tomorrowHourlyContainer = document.getElementById('tomorrowHourlyContainer')

                tomorrowHourlyForecast.forEach(hourData => {
                    const hour = new Date(hourData.dt * 1000).toLocaleTimeString('fr-FR', { hour: 'numeric', minute: 'numeric' })
                    const temperature = Math.round(hourData.main.temp - 273.15)
                    const description = hourData.weather[0].description
                    const hourlyItem = document.createElement('div')

                    hourlyItem.innerHTML = `<span>${hour}:  </span><span>${temperature}°C  -  </span><span>${description}</span>`
                    tomorrowHourlyContainer.appendChild(hourlyItem)
                })
            }, error: function (error) {
                console.error('Erreur lors de la requête AJAX:', error);
            }
        })
    }
    getApi()
}
getPosition()