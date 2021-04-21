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
    
    function Connect($api, $secret){
        $key = $api;
        $payload = array(
        "iss" => $secret,
        'exp' => time() + 3600,
    );
    return  JWT::encode($payload, $key);
        
    }
    
    public function create($api, $secret){
        $client = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'https://api.zoom.us',
    ]);
 
    $response = $client->request('POST', '/v2/users/me/meetings', [
        "headers" => [
            "Authorization" => "Bearer " . $this->Connect($api, $secret)
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
    echo "Join URL: ". $data->join_url;
    echo "<br>";
    echo "Meeting Password: ". $data->password;
    }
    
    public function conference() {
        
        https://api.zoom.us/v2/users/{userId}/meetings
        
    }
    
    function getZoomAccessToken() {
    $key = ZOOM_SECRET_KEY;
    $payload = array(
        "iss" => ZOOM_API_KEY,
        'exp' => time() + 3600,
    );
    return JWT::encode($payload, $key);    
    }
    
    public function autorizacao() {
        
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.zoom.us/v2/users?status=active&page_size=30&page_number=1",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "authorization: Bearer 39ug3j309t8unvmlmslmlkfw853u8",
            "content-type: application/json"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
        
        
//        $url = self::API_OAUTH_TOKEN_URL;
//        
//        $post = ['meetingNumer' => $meeting,
//         'role' => 1,
//         'userName' => 'guilherme',
//         'passWord' => $pwd];
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, []);
//        
//        $header = json_decode(curl_exec($ch));
//
//        var options = {
//          method: 'POST',
//          url: 'https://zoom.us/oauth/token',
//          qs: {
//           grant_type: 'authorization_code',
//           //The code below is a sample authorization code. Replace it with your actual authorization code while making requests.
//           code: 'B1234558uQ',
//            //The uri below is a sample redirect_uri. Replace it with your actual redirect_uri while making requests.
//           redirect_uri: 'https://abcd.ngrok.io'
//          },
//          headers: {
//            /**The credential below is a sample base64 encoded credential. Replace it with "Authorization: 'Basic ' + Buffer.from(your_app_client_id + ':' + your_app_client_secret).toString('base64')"
//            **/
//           Authorization: 'Basic abcdsdkjfesjfg'
//          }
//        };
//
//          request(options, function(error, response, body) {
//           if (error) throw new Error(error);
//
//           console.log(body);
//          });
            }
    
//    public function connect() {
//        
//        $url = API_URL;
//        
//        $post = ['meetingNumer' => $meeting,
//         'role' => 1,
//         'userName' => 'guilherme',
//         'passWord' => $pwd];
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, []);
//        
//        $header = json_decode(curl_exec($ch));
//        
//        echo $header->signature;
//       
//    }
    
    public function signature($api_key, $api_secret, $meeting_number, $role) {
        
        

            //Set the timezone to UTC
        date_default_timezone_set("UTC");

	$time = time() * 1000 - 30000;//time in milliseconds (or close enough)
	
	$data = base64_encode($api_key . $meeting_number . $time . $role);
	
	$hash = hash_hmac('sha256', $data, $api_secret, true);
	
	$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
	
//	return signature, url safe base64 encoded
	return rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');

        
    }
    

}
