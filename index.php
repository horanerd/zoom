<html>
    <head>
        <title> zoom</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    
                <p>Nome: Guilherme de sousa</p>
                <p>User: Guilherme</p>
                </div>
            </div>
        </div>

    </body>
</html>


<?php
require_once 'vendor/autoload.php';
 

use GuzzleHttp\Client;
use Source\Model\Zoom;


$novo = new Zoom();
$novo->create(ZOOM_API_KEY, ZOOM_SECRET_KEY);




function getZoomAccessToken() {
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
   return  JWT::encode($payload, $key);    
}


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
            "start_time" => "2021-04-30T20:30:00",
            "duration" => "30", // 30 mins
            "password" => "123456"
        ],
    ]);
 
    $data = json_decode($response->getBody());
    echo "Join URL: ". $data->id;
    echo "<br>";
    echo "Meeting Password: ". $data->encrypted_password;
    
   
}
 
