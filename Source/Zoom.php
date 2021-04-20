<?php
namespace Source;

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
    
    public function connection(){
        
    }
    
    public function conference() {
        
        https://api.zoom.us/v2/users/{userId}/meetings
        
    }
    
    public function connect($meeting, $pwd) {
        
        $url = "https://horanerd-zoom.herokuapp.com";
        
        $post = ['meetingNumer' => $meeting,
         'role' => 1,
         'userName' => 'guilherme',
         'passWord' => $pwd];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, []);
        
        $header = json_decode(curl_exec($ch));
        
        echo $header->signature;
       
    }
    
    public function signature($api_key, $api_secret, $meeting_number, $role) {
        
        

            //Set the timezone to UTC
        date_default_timezone_set("UTC");

	$time = time() * 1000 - 30000;//time in milliseconds (or close enough)
	
	$data = base64_encode($api_key . $meeting_number . $time . $role);
	
	$hash = hash_hmac('sha256', $data, $api_secret, true);
	
	$_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
	
//	return signature, url safe base64 encoded
	echo rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');

        
    }
    

}
