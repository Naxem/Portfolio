<?php
// Configurer CORS
session_start();
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, DELETE");
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

if ((isset($_GET["latitude"])) && (isset($_GET["longitude"]))) {
    $_SESSION["cleApi"] = "Key-API";
    geolocation();
}

if (isset($_GET["action"])) {
    requete($_GET["action"], $_SESSION["cleApi"], $_SESSION["latitude"], $_SESSION["longitude"]);
}

function geolocation()
{
    $_SESSION["latitude"]  = $_GET['latitude'];
    $_SESSION["longitude"] = $_GET['longitude'];
    // Renvoie une réponse au client si nécessaire
    echo "Données de géolocalisation reçues avec succès.";
}

function requete($nbAction, $cleApi, $latitude, $longitude)
{
    // Vérifier la méthode de requête
    if ($nbAction == '1') {
        // Construire l'URL de l'API OpenWeatherMap avec la clé
        $urlApiOpenWeatherMap = "https://api.openweathermap.org/data/2.5/weather?lat={$latitude}&lon={$longitude}&appid={$cleApi}&lang=fr";
        // Faire la requête vers l'API OpenWeatherMap
        $reponseApiOpenWeatherMap = file_get_contents($urlApiOpenWeatherMap);
    } elseif ($nbAction == '2') {
        // Construction de l'URL de requête pour la prévision sur 7 jours
        $forecastApiUrl = "https://api.openweathermap.org/data/2.5/onecall?lat={$latitude}&lon={$longitude}&exclude=current,minutely,hourly&appid={$cleApi}&lang=fr";
        $reponseApiOpenWeatherMap = file_get_contents($forecastApiUrl);
    } elseif ($nbAction == '3') {
        // Affichage de la météo par heure pour aujourd'hui et demain
        $dailyWeatherApiUrl = "https://api.openweathermap.org/data/2.5/forecast?lat={$latitude}&lon={$longitude}&appid={$cleApi}&lang=fr";
        $reponseApiOpenWeatherMap = file_get_contents($dailyWeatherApiUrl);
    } else {
        http_response_code(405);
        echo "Méthode non autorisée";
        return;
    }
    echo $reponseApiOpenWeatherMap;
}
