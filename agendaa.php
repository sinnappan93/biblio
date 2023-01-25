<?php
// Inclure les fichiers nécessaires pour utiliser l'API Google Calendar
require_once 'vendor/autoload.php';

// Définir les paramètres de connexion à l'API
$client = new Google_Client();
$client->setAuthConfig('client_secret.json');
$client->addScope(Google_Service_Calendar::CALENDAR_READONLY);

// Obtenir un jeton d'accès
$accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
$client->setAccessToken($accessToken);

// Créer un service Calendar
$calendarService = new Google_Service_Calendar($client);

// Récupérer les événements de l'agenda pour le lundi
$events = $calendarService->events->listEvents('primary', array(
    'timeMin' => date('c', strtotime('monday this week')),
    'timeMax' => date('c', strtotime('tuesday this week')),
    'singleEvents' => true,
    'orderBy' => 'startTime'
));

// Parcourir les événements et les afficher
foreach ($events->getItems() as $event) {
    echo $event->getSummary() . '<br>';
}