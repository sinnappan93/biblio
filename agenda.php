<?php

// Inclure les fichiers nécessaires pour utiliser l'API Google Calendar
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('Google Calendar API PHP Quickstart');
$client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
$client->setAuthConfig('credentials.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');


$tokenPath = 'token.json';
if (file_exists($tokenPath)) {
    $accessToken = json_decode(file_get_contents($tokenPath), true);
    $client->setAccessToken($accessToken);
}

// Vérifier si le jeton d'accès a expiré
if ($client->isAccessTokenExpired()) {
    
    if ($client->getRefreshToken()) {
        // Si un jeton de rafraîchissement est disponible, renouveler le jeton d'accès
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    } else {
        // Sinon, demander à l'utilisateur de donner l'autorisation d'accéder à son calendrier
        $authUrl = $client->createAuthUrl();
        printf("Open the following link in your browser:\n%s\n", $authUrl);
        print 'Enter verification code: ';
        $authCode = trim(fgets(STDIN));

        // Échanger le code d'autorisation contre un jeton d'accès
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);

        // Vérifier s'il y a des erreurs dans le jeton d'accès
        if (array_key_exists('error', $accessToken)) {
            throw new Exception(join(', ', $accessToken));
        }
    }

    // Si le dossier du jeton n'existe pas, le créer
    if (!file_exists(dirname($tokenPath))) {
        mkdir(dirname($tokenPath), 0700, true);
    }
    // Enregistrer le jeton d'accès dans le fichier
    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
}

// Créer un service Google Calendar
$service = new Google_Service_Calendar($client);

$calendarId = 'primary';
$events = $service->events->listEvents($calendarId);

// Vérifier s'il n'y a aucun événement à venir
if (empty($events->getItems())) {
    print "No upcoming events found.\n";
} else {
    // Afficher les événements à venir
    print "Upcoming events:\n";
    foreach ($events->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}

?>


<!-- <iframe src="https://calendar.google.com/calendar/embed?src=biblagend%40gmail.com&ctz=Europe%2FParis" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    <a target="_blank" href="https://calendar.google.com/calendar/event?action=TEMPLATE&amp;tmeid=MWQ1MGp1ZDZ1Z2pkbDRoM3Y5ZTg4YWlmbmcg
