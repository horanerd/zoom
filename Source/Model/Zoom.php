<?php
namespace Source\Model;

use GuzzleHttp\Client;
use JWT;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of zoom
 *
 * @author Guilherme
 */
class Zoom {
    
    const API_URL = 'https://api.zoom.us/v2/';

    const API_OAUTH_URL = 'https://zoom.us/oauth/authorize';

    const API_OAUTH_TOKEN_URL = 'https://zoom.us/oauth/token';
    
    const API_TOKEN_EXCHANGE_URL = 'https://zoom.us/oauth/token';
    
    public function __construct() {
            
    }

    function Signature ($api_key, $api_secret, $meeting_number, $role){

        //Set the timezone to UTC
        date_default_timezone_set("UTC");

        $time = time() * 1000 - 30000;//time in milliseconds (or close enough)
	
	    $data = base64_encode($api_key . $meeting_number . $time . $role);
	
	    $hash = hash_hmac('sha256', $data, $api_secret, true);
	
	    $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
	
        //	return signature, url safe base64 encoded
	    return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
    }
    /*
    function Signature($api, $secret){
        $key = $api;
        $payload = array(
        "iss" => $secret,
        'exp' => time() + 3600,
    );
    return  JWT::encode($payload, $key);
        
    }
    */

    public function meeting($name, $meeting, $pwd, $role, $lang = "pt-PT"){
        
        $signature = $this->Signature(ZOOM_API_KEY, ZOOM_SECRET_KEY, $meeting, $role );

        return "name=".$name ."&mn=" . $meeting . "&email=&pwd=" . $pwd . "&role=" . $role . "&lang=" . $lang . "&signature=" . $signature . "&china=0&apiKey=hVIo_i2VQ1eAw5kOYKgYcw";
    }
    
    public function create(){
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.zoom.us',
        ]);
     
        $response = $client->request('POST', '/v2/users/me/meetings', [
            "headers" => [
                "Authorization" => "Bearer " . $this->getZoomAccessToken()
            ],
            'json' => [
                "topic" => "Let's Learn WordPress",
                "type" => 2,
                "start_time" => "2021-01-30T20:30:00",
                "duration" => "30", // 30 mins
                "password" => "123456"
            ],
        ]);
     
        $data = json_decode($response->getBody());
        echo "Join URL: ". $data->join_url;
        echo "<br>";
        echo "Meeting Password: ". $data->password;
    
    }

    function getZoomAccessToken() {
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
    return JWT::encode($payload, $key);    
    }
    
    
        
        
}
