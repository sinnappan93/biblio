<<<<<<< HEAD
<?php
// Inclure les fichiers nécessaires pour utiliser l'API Google Calendar
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName('Google Calendar API PHP Quickstart');
$client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
$client->setAuthConfig('credentials.json');
$client->setAccessType('offline');
$client->setPrompt('select_account consent');

// Load previously authorized token from a file, if it exists.
// The file token.json stores the user's access and refresh tokens, and is
// created automatically when the authorization flow completes for the first
// time.
$tokenPath = 'token.json';
if (file_exists($tokenPath)) {
    $accessToken = json_decode(file_get_contents($tokenPath), true);
    $client->setAccessToken($accessToken);
}

// If there is no previous token or it's expired.
if ($client->isAccessTokenExpired()) {
    // Refresh the token if possible, else fetch a new one.
    if ($client->getRefreshToken()) {
        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
    } else {
        // Request authorization from the user.
        $authUrl = $client->createAuthUrl();
        printf("Open the following link in your browser:\n%s\n", $authUrl);
        print 'Enter verification code: ';
        $authCode = trim(fgets(STDIN));

        // Exchange authorization code for an access token.
        $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
        $client->setAccessToken($accessToken);

        // Check to see if there was an error.
        if (array_key_exists('error', $accessToken)) {
            throw new Exception(join(', ', $accessToken));
        }
    }

    // Save the token to a file.
    if (!file_exists(dirname($tokenPath))) {
        mkdir(dirname($tokenPath), 0700, true);
    }
    file_put_contents($tokenPath, json_encode($client->getAccessToken()));
}

// Get the API client and construct the service object.
$service = new Google_Service_Calendar($client);

// Print the next 10 events on the user's calendar.
$calendarId = 'primary';
$events = $service->events->listEvents($calendarId);

if (empty($events->getItems())) {
    print "No upcoming events found.\n";
} else {
    print "Upcoming events:\n";
    foreach ($events->getItems() as $event) {
        $start = $event->start->dateTime;
        if (empty($start)) {
            $start = $event->start->date;
        }
        printf("%s (%s)\n", $event->getSummary(), $start);
    }
}// test

/*<iframe src="https://calendar.google.com/calendar/embed?src=biblagend%40gmail.com&ctz=Europe%2FParis" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
    <a target="_blank" href="https://calendar.google.com/calendar/event?action=TEMPLATE&amp;tmeid=MWQ1MGp1ZDZ1Z2pkbDRoM3Y5ZTg4YWlmbmcgYmlibGFnZW5kQG0&amp;tmsrc=biblagend%40gmail.com"><img border="0" src="https://www.google.com/calendar/images/ext/gc_button1_fr.gif"></a>
>>>>>>> 8ce8315d8745954c60ea7a741bba90a6b118a1b7
