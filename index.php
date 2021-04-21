<?php
require_once 'vendor/autoload.php';
 

use GuzzleHttp\Client;
use Source\Zoom;
 
define('ZOOM_API_KEY', 'hVIo_i2VQ1eAw5kOYKgYcw');
define('ZOOM_SECRET_KEY', 'kRIYSdczASkqv9TiuqQagulDQrwn50b9szOL');

$novo = new Zoom();
echo $novo->Connect(ZOOM_API_KEY, ZOOM_SECRET_KEY);

echo "<br> === <br>";

function getZoomAccessToken() {
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
   return  JWT::encode($payload, $key);    
}

echo getZoomAccessToken();
//
function createZoomMeeting() {
    $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.zoom.us',
    ]);
 
    $response = $client->request('POST', '/v2/users/me/meetings', [
        "headers" => [
            "Authorization" => "Bearer " . getZoomAccessToken()
        ],
        'json' => [
            "topic" => "Teste 2",
            "type" => 2,
            "start_time" => "2021-01-30T20:30:00",
            "duration" => "30", // 30 mins
            "password" => "123456"
        ],
    ]);
 
    $data = json_decode($response->getBody());
    echo "Join URL: ". $data->id;
    echo "<br>";
    echo "Meeting Password: ". $data->encrypted_password;
    
   
}
 
createZoomMeeting();